<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSustainabilityUnit extends Model
{
    use HasFactory;

    protected $table = 'business_sustainability_units';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
