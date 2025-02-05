<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHeroSection extends Model {
    use HasFactory;

    protected $fillable = ['title', 'description', 'hero_image', 'additional_image'];
}

