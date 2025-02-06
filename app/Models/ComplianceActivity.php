<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceActivity extends Model
{
    use HasFactory;

    protected $table = 'compliance_activities';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
