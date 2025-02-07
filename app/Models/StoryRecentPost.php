<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryRecentPost extends Model
{
    use HasFactory;

    protected $table = 'story_recent_post';

    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'post_date',
    ];

    // Ensure post_date is formatted correctly
    protected $casts = [
        'post_date' => 'date:Y-m-d', // Format for API response
    ];
    
}
