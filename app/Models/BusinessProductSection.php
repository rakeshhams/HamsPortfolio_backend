<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProductSection extends Model {
    use HasFactory;

    protected $fillable = ['main_title', 'description'];

    // Explicitly define the table name
    protected $table = 'business_product_section';
}
