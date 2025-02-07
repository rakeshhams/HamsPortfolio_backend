<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryCategory extends Model
{
    use HasFactory;

    protected $table = 'story_category';

    protected $fillable = [
        'name',
    ];

    public function images()
    {
        return $this->hasMany(StoryCategoryImage::class, 'story_category_id');
    }
}
