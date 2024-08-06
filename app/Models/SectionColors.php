<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionColors extends Model
{
    use HasFactory;

    protected $fillable = [
        'loginBackgroundColor',
        'servicesBackgroundColor',
        'hoursBackgroundColor',
        'galleryBackgroundColor',
        'ctaBackgroundColor',
        'footerBackgroundColor',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
