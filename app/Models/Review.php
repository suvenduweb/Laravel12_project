<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     protected $fillable = [
        'name', // 👈 Add this
        'position',
        'message',
        'image',
        // ... any other fields you want to allow
    ];
}
