<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsAccordion extends Model
{
    use HasFactory;

    protected $table = 'about_us_accordions';

    protected $fillable = [
        'title',
        'description',
    ];
}
