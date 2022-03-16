<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tfidf extends Model
{
    use HasFactory;
    protected $fillable = [
        'artikel1',
        'artikel2',
        'artikel3',
        'artikel4',
        'stop_words'
    ];
}
