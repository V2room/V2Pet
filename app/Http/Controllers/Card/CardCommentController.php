<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\CardCommentStoreRequest;
use App\Http\Requests\Card\CardCommentUpdateRequest;
use App\Models\Card\Card;
use App\Models\Card\CardComment;
use App\Services\Card\CardCommentService;
use Illuminate\Support\Facades\Redirect;

class CardCommentController extends Controller
{
    protected string $prefix = 'Card';

    public function __construct(private CardCommentService $service)
    {
        parent::__construct();
    }

    public function update(CardCommentUpdateRequest $request, Card $card, CardComment $comment)
    {
        $validated = $request->validated();
        $this->service->update(
            comment   : $comment,
            attributes: $validated,
        );
        return Redirect::route('cards.show', $card);
    }

    public function store(CardCommentStoreRequest $request, Card $card)
    {
        $validated = $request->validated();
        $this->service->store(
            user   : $this->getCurrentUser(),
            card   : $card,
            content: $validated['message'],
        );
        return Redirect::route('cards.show', $card);
    }

    public function destroy(Card $card, CardComment $comment)
    {
        $this->service->delete($comment);
        return Redirect::route('cards.show', $card);
    }

}
