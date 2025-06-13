<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionPosition extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'position',
        'user_id',
        'is_visible',
    ];

    /**
     * Get the user that owns the section position.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
