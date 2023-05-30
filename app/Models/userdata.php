<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'name',
        'email',
        'fecha_nacimiento',
        'celular',
        'user_type',
        'direccion',
    ]; 
}
