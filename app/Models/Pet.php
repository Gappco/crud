<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{    

    public $fillable = [

        'nombre',
        'signature',
        'avatar',
        'date_of_birth'

    ];


    use HasFactory;

}
