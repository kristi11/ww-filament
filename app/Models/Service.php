<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static simplePaginate(int $int)
 * @method static count()
 * @property mixed $price
 * @property mixed $estimated_hours
 * @property mixed $estimated_minutes
 */
class Service extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function getDisplayPriceAttribute()
    {
        $flexibility = $this->user->flexibility;

        if ($flexibility && $flexibility->flexible_pricing) {
            return 'Price starting at $'.$this->price;
        } else {
            return $this->price;
        }
    }
}
