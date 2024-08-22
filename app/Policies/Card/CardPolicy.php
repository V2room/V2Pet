<?php

namespace App\Policies\Card;

use App\Models\Card\Card;
use App\Models\User\User;
use App\Policies\BasePolicy;
use Illuminate\Auth\Access\Response;

class CardPolicy extends BasePolicy
{

    public function update(User $user, Card $card): Response
    {
        return $this->canAccess($user, $card);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Card $card): Response
    {
        return $this->canAccess($user, $card);
    }


}
