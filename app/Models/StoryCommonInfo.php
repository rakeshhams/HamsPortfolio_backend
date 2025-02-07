<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCommonInfo extends Model
{
    use HasFactory;

    protected $table = 'story_common_info';

    protected $fillable = [
        'meta_title',
        'meta_description',
        'hero_image',
    ];
}
