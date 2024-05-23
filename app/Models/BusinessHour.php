<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessHour extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'status' => 'boolean',
        'always_open' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Get the original attribute state
    public function getOriginal($key = null, $default = null)
    {
        return parent::getOriginal($key, $default);
    }

    public function setStatusAttribute($value): void
    {
        // Debug/Help output added
        error_log('setting status: '.$value);
        error_log('original status: '.$this->getOriginal('status'));

        if (! $value && $this->getOriginal('status')) {
            $this->attributes['open'] = null;
            $this->attributes['closed'] = null;
        }
        $this->attributes['status'] = $value;
    }

    public function getDisplayOpenAttribute()
    {
        $flexibility = $this->user->flexibility;

        if ($flexibility->always_open) {
            return 'We are always open';
        }

        $dayHour = $this->user->businessHours->firstWhere('day', $this->day);

        return $dayHour?->open;
    }

    public function getDisplayCloseAttribute()
    {
        $flexibility = $this->user->flexibility;

        if ($flexibility->always_open) {
            return 'We are always open';
        }

        $dayHour = $this->user->businessHours->firstWhere('day', $this->day);

        return $dayHour?->close;
    }
}
