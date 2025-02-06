<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenCommunity extends Model
{
    use HasFactory;

    protected $table = 'green_community';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
