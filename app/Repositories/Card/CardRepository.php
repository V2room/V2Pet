<?php

namespace App\Repositories\Card;

use App\Models\Card\Card;
use App\Models\User\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use LaravelSupports\Database\Repositories\BaseRepository;

class CardRepository extends BaseRepository
{

    public function store(?User $user, string $message): Card|Model
    {
        return $this->model->create([
            'user_id' => $user?->getKey(),
            'message' => $message,
        ]);
    }

    public function pagination(int $page, int $size): LengthAwarePaginator
    {
        return $this->model->orderBy('id', 'desc')->paginate($size, ['*'], 'page', $page);
    }

}
