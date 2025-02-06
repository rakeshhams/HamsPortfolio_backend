<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStory extends Model
{
    use HasFactory;

    protected $table = 'employee_story';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
