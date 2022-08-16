<?php

namespace App\Models;

use App\Enums\AuthMethodType;
use App\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthMethod extends Model
{
    use HasFactory, HasUuidKey;

    protected $fillable = [
        'type', 'identifier', 'secret',
    ];

    protected $casts = [
        'type' => AuthMethodType::class,
        'secret' => 'encrypted',
    ];

    protected $hidden = [
        'secret',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
