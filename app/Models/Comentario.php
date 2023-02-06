<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'public.comentarios';

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
        'user_id',
        'publicacion_id',
        'comentario',
        'created_at',
        'updated_at',
    ];

    /**
     * USUARIO CREADOR
     * RELACION UNO A UNO
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
