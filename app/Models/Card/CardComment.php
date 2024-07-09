<?php

namespace App\Models\Card;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelSupports\Models\Common\BaseModel;

class CardComment extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'card_comments';

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

}
