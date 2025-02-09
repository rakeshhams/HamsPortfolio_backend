<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderFeatureInfo extends Model
{
    use HasFactory;

    protected $table = 'slider_feature_info';

    protected $fillable = [
        'title',
        'image',
        'description',
    ];
}
