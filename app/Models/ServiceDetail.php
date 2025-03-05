<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    protected $table = 'service_details';

    protected $fillable = [
        'service_category_id',
        'main_title',
        'main_description',
        'subtitle_one',
        'subdescription_one',
        'subtitle_two',
        'subdescription_two',
        'subtitle_three',
        'subdescription_three',
        'subtitle_four',
        'subdescription_four',
        'subtitle_five',
        'subdescription_five',
        'subtitle_six',
        'subdescription_six',
        'subtitle_seven',
        'subdescription_seven',
        'description',
        'name',
        'image_one',
        'image_two',
        'image_three',
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }
}
