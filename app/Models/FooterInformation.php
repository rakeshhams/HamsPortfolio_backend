<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterInformation extends Model
{
    use HasFactory;

    protected $table = 'footer_information';

    protected $fillable = [
        'address',
        'factory_address',
        'gmail',
        'social_link_one',
        'social_link_two',
        'social_link_three',
    ];
}
