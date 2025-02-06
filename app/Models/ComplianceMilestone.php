<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceMilestone extends Model
{
    use HasFactory;

    protected $table = 'compliance_milestone';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
