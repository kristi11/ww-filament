<?php

namespace App\Models;

use App\Models\Concerns\HasObservers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property mixed $image
 */
class Gallery extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasObservers;

    protected $casts = [
        'id' => 'integer',
        'service_id' => 'integer',
        'image' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
