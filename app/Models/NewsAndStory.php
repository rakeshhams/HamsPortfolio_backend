<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAndStory extends Model
{
    use HasFactory;

    protected $table = 'news_and_stories';

    protected $fillable = [
        'news_category_id',
        'title',
        'short_description',
        'description',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
