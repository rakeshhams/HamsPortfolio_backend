<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplianceCsrInfo extends Model
{
    use HasFactory;

    protected $table = 'compliance_csr_info';

    protected $fillable = [
        'title',
        'description_one',
        'description_two',
    ];
}
