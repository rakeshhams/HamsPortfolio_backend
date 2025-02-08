<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeVirtualTourCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'background_image'];

    public function subcategories()
    {
        return $this->hasMany(HomeVirtualTourSubcategory::class, 'category_id');
    }
}
