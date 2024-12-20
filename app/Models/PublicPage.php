<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, true $true)
 */
class PublicPage extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'guestHero',
        'credentials',
        'services',
        'shop',
        'hours',
        'gallery',
        'email',
        'footer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
