<?php

namespace App\Repositories\User;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use LaravelSupports\Auth\Contracts\AuthRepositoryContract;
use LaravelSupports\Database\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements AuthRepositoryContract
{
    public function findOrFail(int $id): Authenticatable|Model
    {
        return $this->model::findOrFail($id);
    }

}
