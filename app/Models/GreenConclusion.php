<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenConclusion extends Model
{
    use HasFactory;

    protected $table = 'green_conclusion';

    protected $fillable = [
        'title',
        'description',
        'file',
    ];
}
