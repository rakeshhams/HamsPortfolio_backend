<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsMain extends Model
{
    use HasFactory;

    protected $table = 'about_us_main';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_one',
        'image_two',
        'meta_title',
        'meta_description',
    ];
}
