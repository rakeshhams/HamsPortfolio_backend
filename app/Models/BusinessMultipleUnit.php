<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessMultipleUnit extends Model
{
    use HasFactory;

    protected $table = 'business_multiple_units';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
