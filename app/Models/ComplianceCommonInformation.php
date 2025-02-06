<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceCommonInformation extends Model
{
    use HasFactory;

    protected $table = 'compliance_common_information';

    protected $fillable = [
        'title',
        'description',
        'hero_image',
    ];
}
