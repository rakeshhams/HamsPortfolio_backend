<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryFeaturePost extends Model
{
    use HasFactory;

    protected $table = 'story_feature_post';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
