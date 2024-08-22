<?php

namespace App\Models\Traits;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserTraits
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}