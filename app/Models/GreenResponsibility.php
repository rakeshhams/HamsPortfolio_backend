<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenResponsibility extends Model
{
    use HasFactory;

    protected $table = 'green_responsibility';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
