<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'has_new_reply',
    ];

    /**
     * Get the replies for the lead.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(LeadReply::class);
    }
}
