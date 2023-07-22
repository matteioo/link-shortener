<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'url',
        'duration',
    ];
    protected int $identifierLength = 6;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($link) {
            $link->identifier = $link->generateUniqueIdentifier();
            $link->expires_at = now()->addDays($link->duration);
        });
    }

    /**
     * Generate a unique identifier for the link.
     */
    protected function generateUniqueIdentifier(): string
    {
        do {
            $identifier = Str::random($this->identifierLength);
        } while (static::where('identifier', $identifier)->exists());

        return $identifier;
    }

    /**
     * Set the link's identifier.
     */
    public function setIdentifierLength($length): void
    {
        $this->identifierLength = $length;
    }

    /**
     * Get the user that owns the link.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
