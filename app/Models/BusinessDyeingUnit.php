<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDyeingUnit extends Model
{
    use HasFactory;

    protected $table = 'business_dyeing_units';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
