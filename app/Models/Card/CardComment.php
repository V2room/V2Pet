<?php

namespace App\Models\Card;

use App\Models\Traits\HasUserTraits;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelSupports\Models\Common\BaseModel;

class CardComment extends BaseModel
{
    use SoftDeletes, HasUserTraits;

    protected $table = 'card_comments';

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

}
