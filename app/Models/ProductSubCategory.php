<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected  $fillable = [
        'product_category_id',
        'image',
        'description',
        'title',
       
    ];
    protected $casts = [
        'is_active' => 'boolean',

    ];
}
