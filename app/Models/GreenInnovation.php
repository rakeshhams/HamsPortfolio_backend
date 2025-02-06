<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenInnovation extends Model
{
    use HasFactory;

    protected $table = 'green_innovation';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
