<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    protected string $prefix = 'Main';

    public function index()
    {
        return $this->buildView('Dashboard');
    }

    protected function setMiddleware(): void {}

}
