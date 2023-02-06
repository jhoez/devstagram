<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Imagen;
use App\Models\Publicacion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        /**
         * al construir el objeto ejecuta el metodo middleware
         * para que anters de mostrar alguna vista el usuario debe estar autenticado.
         * @method except es utilizado para sacar de la regla de autenticacion a N acciones
        */
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        //metodo latest() ordena de forma descendente los registros
        $publicacion = Publicacion::where('user_id',$user->id)->latest()->paginate(4);
        //dd($publicacion[10]->imagen()->get()[0]->ruta);

        return view('dashboard',[
            'user' => $user,
            'publicacion' => $publicacion 
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * Almacenar publicaciones con imagenes o una imagen.
    */
    public function store(Request $request)
    {
        $campos = [
            'titulo'=>'required|max:255',
            'image'=>'required|mimes:jpg,jpeg,png',
            'descripcion'=>'required',
        ];
        $msj = [
            'titulo.required'=>'El titulo es requerido!!',
            'image.required'=>'La imagen es requerida!!',
            'descripcion.required'=>'La Descripcion es requerida',
        ];
        
        $this->validate($request,$campos,$msj);        
        
        $imgform = $request->image;
        //dd($imgform->getClientOriginalName(), $request->imagen->hashName());
        
        if($request->hasFile('image')){
            $publicacion = new Publicacion;
            $publicacion->titulo        = $request->titulo;
            $publicacion->descripcion   = $request->descripcion;
            $publicacion->image        = $imgform->getClientOriginalName();
            $publicacion->user_id       = auth()->user()->id;
            $publicacion->created_at    = date('Y-m-d h:i:s',time());
            
            if ( $publicacion->save() ) {
                $imagen = new Imagen;
                $imagen->nombfile = $imgform->getClientOriginalName();
                //$imagen->nombfile = Str::uuid().'.'.$imgform->extension();// imagen con nombre alfanumerico aleatorio
                $imagen->extension = $imgform->extension();
                //$imagen->ruta = $imgform->storeAs('fotos',$imgform->getClientOriginalName());
                //$imagen->ruta = $imgform->storeAs('fotos',$imgform->hashName());
                $imagen->publicacion_id = $publicacion->id;
                $imagen->created_at = date('Y-m-d h:i:s',time());

                /**
                 * subir imagen con
                 * Intervention\Image\Facades\Image
                */
                //$nombreImagen = Str::uuid() . "." . $imgform->extension();
                $imagenServidor = Image::make($imgform);
                $imagenServidor->fit(1000,1000);

                // ruta de imagen
                $imagen->ruta = $imagenPath = public_path('fotos').'/'.$imagen->nombfile;
                
                if ( $imagenServidor->save($imagenPath) ) {
                    if ( $imagen->save() ) {
                        return redirect()->route('posts.index',auth()->user()->username)->with('mensaje','Se ha registrado la publicación!!');
                    }
                }
            }
        }else{
            return redirect()->route('posts.create');
        }

    }

    /**
     * VISTA DE DETALLE
    */
    public function show(User $user, Publicacion $publicacion)
    {
        return view('posts.show',[
            'publicacion' => $publicacion,
            'user'=>$user
        ]);
    }

    public function destroy(Publicacion $publicacion)
    {
        if ( $this->authorize('delete',$publicacion)->allowed() ) {
            $publicacion->delete();
            $imagen_path = public_path('fotos/'.$publicacion->image);

            if ( File::exists($imagen_path) ) {
                unlink($imagen_path);
            }

            return redirect()->route('posts.index',auth()->user()->username)->with('deletesuccess','Se elimino la publicacion!!');
        }else {
            return back()->with('msjd','No se elimino la publicacion!!');
        }
    }
}
