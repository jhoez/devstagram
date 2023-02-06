<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'public.likes';

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

    protected $fillable = [
        'user_id',
        'publicacion_id',
    ];
}
