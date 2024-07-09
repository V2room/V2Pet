<?php

namespace App\Models\Card;

use App\Models\BaseMediaModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends BaseMediaModel
{
    use SoftDeletes;

    protected $table = 'cards';

    public function comments(): HasMany
    {
        return $this->hasMany(CardComment::class);
    }
}
