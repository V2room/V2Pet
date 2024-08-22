<?php

namespace App\Models\Card;

use App\Models\BaseMediaModel;
use App\Models\Traits\HasUserTraits;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends BaseMediaModel
{
    use SoftDeletes, HasUserTraits;

    protected $table = 'cards';

    public function comments(): HasMany
    {
        return $this->hasMany(CardComment::class);
    }

}
