<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreenOurMessage extends Model
{
    use HasFactory;

    protected $table = 'green_our_messages';

    protected $fillable = [
        'title',
        'description',
    ];
}
