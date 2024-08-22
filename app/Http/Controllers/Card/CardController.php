<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\CardStoreRequest;
use App\Http\Requests\Card\CardUpdateRequest;
use App\Http\Resources\Card\CardResource;
use App\Http\Resources\Card\CardWithCommentResource;
use App\Models\Card\Card;
use App\Services\AI\Contracts\AIServiceContract;
use App\Services\Card\CardService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    protected string $prefix = 'Card';

    public function __construct(private CardService $service, private AIServiceContract $aiService)
    {
        parent::__construct();
    }

    public function index()
    {
        $pagination = $this->service->pagination();
        $pagination->transform(fn($item) => new CardResource($item));
        return $this->buildView(
            view  : 'Index',
            params: [
                'pagination' => $pagination,
            ],
        );
    }

    public function create()
    {
        return $this->buildView(
            view  : 'Store',
            params: [
                'presets' => $this->aiService->presets(),
            ],
        );
    }

    public function show(Card $card)
    {
        return $this->buildView(
            view  : 'Show',
            params: [
                'card' => new CardWithCommentResource($card),
            ],
        );
    }

    public function edit(Card $card)
    {
        Gate::authorize('update', $card);
        return $this->buildView(
            view  : 'Edit',
            params: [
                'card' => new CardResource($card),
            ],
        );
    }

    public function update(CardUpdateRequest $request, Card $card)
    {
        $validated = $request->validated();
        $this->service->update(
            card      : $card,
            attributes: $validated,
        );
        return Redirect::route('cards.show', $card);
    }

    public function store(CardStoreRequest $request)
    {
        $validated = $request->validated();
        $this->service->store(
            image  : $validated['image'],
            user   : $this->getCurrentUser(),
            message: $validated['message'],
        );
        return Redirect::route('cards.index');
    }

    public function destroy(Card $card)
    {
        $this->service->delete($card);
        return Redirect::route('cards.index');
    }

    protected function setMiddleware(): void
    {
        $this->middleware('auth:web')->except(['index', 'store', 'show']);
    }
}
