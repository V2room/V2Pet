<?php

namespace App\Services\Card;

use App\Models\Card\Card;
use App\Models\Card\CardComment;
use App\Models\User\User;
use App\Repositories\Card\CardCommentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class CardCommentService
{

    public function __construct(protected CardCommentRepository $repository) {}

    public function store(User $user, Card $card, string $content): Model
    {
        return $this->repository->store($user, $card, $content);
    }

    public function pagination(int $page = 1, int $size = 10): LengthAwarePaginator
    {
        return $this->repository->pagination($page, $size);
    }

    public function update(CardComment $comment, array $attributes): bool
    {
        return $this->repository->update($comment, $attributes);
    }

    public function delete(CardComment $comment): bool
    {
        return $this->repository->delete($comment);
    }
}