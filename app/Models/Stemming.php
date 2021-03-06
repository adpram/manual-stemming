<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stemming extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'result_stemming',
        'token_tidak_lolos',
        'token_lolos'
    ];

}
