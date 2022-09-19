<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddNot extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'des', 'status', 'image'
    ];
}
