<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenEnvironmentalImpact extends Model
{
    use HasFactory;

    protected $table = 'green_environmental_impact';

    protected $fillable = [
        'title',
        'description',
        'sub_description',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
    ];
}
