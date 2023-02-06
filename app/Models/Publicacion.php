<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'public.publicacions';

    /**
     * The primary key associated with the table.
     * @var string
     */
    //protected $primaryKey = 'idimag';

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    //public $timestamps = false;

    /**
     * The model's default values for attributes.
     * @var array
     */
    //protected $attributes = [];

    /**
     * informacion que debe procesar antes de ser almacenada
    */
    protected $fillable = [
        'titulo',
        'descripcion',
        'user_id',
        'image',
        'created_at',
        'updated_at',
    ];

    /**
     * relacion con la tabla users
     * obtener usuario al que pertenece la publicación
    */
    public function user()
    {
        //return $this->belongsTo(User::class,'user_id');// colocar asi sino quiero adaptarme a las convenciones de laravel
        return $this->belongsTo(User::class)->select('name','username');
    }

    /**
     * relacion con la tabla imagen
     * obtiene las imagenes asociadas a la publicacion
    */
    /*public function img()
    {
        return $this->hasMany(Imagen::class,'publicacion_id');
    }*/

    /**
     * COMENTARIOS
    */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    /**
     * like de las publicaciones
    */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * CHEQUEO DE LIKE
    */
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id',$user->id);// en los registro se encuentra registrado en el campo user_id tal dato.
    }
}
