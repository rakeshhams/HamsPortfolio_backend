<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAboutUs extends Model
{
    use HasFactory;

    protected $table = 'home_about_us';

    protected $fillable = [
        'name',
        'title',
        'subtitle',
        'meta_title',
        'meta_description',
        'description',
        'youtube_link',
        'link',
        'image',
        'experience_count',
    ];
}
