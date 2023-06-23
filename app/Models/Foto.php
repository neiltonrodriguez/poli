<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;
    protected $table = "foto";
    protected $fillable = [
        'alt',
        'img',
        'description',
        'id_categoria',
        'ativo',
    ];
}
