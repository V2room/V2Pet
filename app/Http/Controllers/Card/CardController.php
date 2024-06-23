<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\Card\CardStoreRequest;
use App\Http\Resources\Card\CardResource;
use App\Services\Card\CardService;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    protected string $prefix = 'Card';

    public function __construct(private CardService $service)
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
            title : 'Card 목록',
        );
    }

    public function create()
    {
        return $this->buildView(
            view : 'Store',
            title: 'Card 등록',
        );
    }

    public function store(CardStoreRequest $request)
    {
        $validated = $request->validated();
        $this->service->store(
            user   : $this->getCurrentUser(),
            image  : $validated['image'],
            message: $validated['message'],
        );
        return Redirect::route('card.index');
    }

    protected function setMiddleware(): void
    {
        $this->middleware('auth:web');
    }
}
