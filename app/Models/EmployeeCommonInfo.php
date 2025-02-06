<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCommonInfo extends Model
{
    use HasFactory;

    protected $table = 'employee_common_info';

    protected $fillable = [
        'title',
        'description_one',
        'description_two',
        'hero_image',
    ];
}
