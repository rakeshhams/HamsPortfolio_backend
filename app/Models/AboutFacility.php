<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutFacility extends Model
{
    use HasFactory;

    protected $table = 'about_facilities';

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'image_one',
        'image_two',
        'link',
    ];
}
