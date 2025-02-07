<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryVideo extends Model
{
    use HasFactory;

    protected $table = 'story_video';

    protected $fillable = [
        'title',
        'link',
    ];
}
