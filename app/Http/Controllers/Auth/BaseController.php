<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    protected function setMiddleware(): void {}

}
