<?php

namespace App\Http\Controllers;

class MainController extends Controller
{

    public function index()
    {
        return $this->buildView(
            view : 'Dashboard',
            title: 'Dashboard',
        );
    }

    protected function setMiddleware(): void
    {
        $this->middleware('auth:web');
    }

}
