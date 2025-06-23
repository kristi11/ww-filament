<?php

namespace App\Models;

use App\Models\Concerns\HasObservers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static first()
 * @method static exists()
 */
class Hero extends Model
{
    use HasFactory, HasObservers;

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'waves' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
