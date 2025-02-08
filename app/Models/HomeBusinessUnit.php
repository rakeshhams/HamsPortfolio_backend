<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeBusinessUnit extends Model
{
    use HasFactory;

    protected $table = 'home_business_units';

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image_one',
        'image_two',
        'link',
    ];
}
