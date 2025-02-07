<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCategoryImage extends Model
{
    use HasFactory;

    protected $table = 'story_category_image';

    protected $fillable = [
        'story_category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(StoryCategory::class, 'story_category_id');
    }
}
