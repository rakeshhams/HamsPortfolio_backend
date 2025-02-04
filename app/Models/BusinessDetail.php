<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model {
    use HasFactory;

    protected $table = 'business_overviews'; // ✅ Use the correct table name

    protected $fillable = ['section', 'title', 'content', 'image'];
}
