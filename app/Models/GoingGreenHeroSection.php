<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoingGreenHeroSection extends Model
{
    use HasFactory;

    protected $table = 'going_green_hero_sections';

    protected $fillable = [
        'hero_image',
        'title',
        'subtitle',
        'description',
    ];
}
