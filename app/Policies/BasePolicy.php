<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class BasePolicy
{
    protected function canAccess(User $user, Model $model): Response
    {
        return $this->isCorrectUser($user, $model) ? Response::allow() : Response::deny("You can't access");
    }

    protected function isCorrectUser(User $user, Model $model): bool
    {
        return $user->getKey() === $model->user_id;
    }

}
