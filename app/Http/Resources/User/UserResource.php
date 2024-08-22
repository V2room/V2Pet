<?php

namespace App\Http\Resources\User;

use LaravelSupports\Resources\BaseIdResources;

class UserResource extends BaseIdResources
{
    protected array $field = ['name', 'nickname', 'email', 'birth', 'contact', 'address', 'gender'];

}
