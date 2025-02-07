<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutDirector extends Model
{
    use HasFactory;

    protected $table = 'about_directors';

    protected $fillable = [
        'name',
        'designation',
        'image',
        'facebook_link',
        'linkedin_link',
        'twitter_link',
    ];
}
