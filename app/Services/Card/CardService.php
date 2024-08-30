<?php

namespace App\Services\Card;

use App\Models\Card\Card;
use App\Models\User\User;
use App\Repositories\Card\CardRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class CardService
{

    public function __construct(protected CardRepository $repository) {}

    public function store(UploadedFile|string $image, ?User $user, string $message): Model
    {
        $model = $this->repository->store($user, $message);
        if (is_string($image)) {
            $model->addMediaFromUrl($image)->toMediaCollection('card');
        } else {
            $model->addMedia($image)->toMediaCollection('card');
        }
        return $model;
    }

    public function pagination(int $page = 1, int $size = 10): LengthAwarePaginator
    {
        return $this->repository->pagination($page, $size);
    }

    public function update(Card $card, array $attributes): bool
    {
        return $this->repository->update($card, $attributes);
    }

    public function delete(Card $card): bool
    {
        return $this->repository->delete($card);
    }
}