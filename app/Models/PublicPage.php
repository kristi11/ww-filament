<?php

namespace App\Models;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, true $true)
 */
class PublicPage extends Model implements Htmlable
{
    use HasFactory;

    /**
     * Get content as HTML string
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->content ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
