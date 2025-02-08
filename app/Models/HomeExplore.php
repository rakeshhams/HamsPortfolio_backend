<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeExplore extends Model
{
    use HasFactory;

    protected $table = 'home_explore';

    protected $fillable = [
        'name',
        'title',
        'description',
        'image',
    ];
}
