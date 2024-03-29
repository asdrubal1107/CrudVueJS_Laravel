<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratistas extends Model
{
    use HasFactory;
    protected $filiable = ['nombre', 'apellido', 'tipodocumento', 'documento', 'estado']; //
}
