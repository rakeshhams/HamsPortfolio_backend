<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessGarmentUnit extends Model
{
    use HasFactory;

    protected $table = 'business_garment_units';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
