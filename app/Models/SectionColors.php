<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static first()
 */
class SectionColors extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
