<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCommonInfo extends Model
{
    use HasFactory;

    protected $table = 'product_common_info';

    protected $fillable = [
        'hero_image',
        'title',
        'description',
        'meta_title',
        'meta_description',
        'product',
        'export',
        'destination',
        'human_impact',
    ];
}
