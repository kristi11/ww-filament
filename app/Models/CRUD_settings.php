<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CRUD_settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'can_add_content',
        'can_edit_content',
        'can_delete_content',
    ];

    protected $casts = [
        'can_add_content' => 'boolean',
        'can_edit_content' => 'boolean',
        'can_delete_content' => 'boolean',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
