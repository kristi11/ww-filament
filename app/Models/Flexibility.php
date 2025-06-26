<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, true $true)
 */
class Flexibility extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
