<?php

namespace App\Providers;

use App\Models\Card\Card;
use App\Models\User\User;
use App\Repositories\Card\CardRepository;
use App\Repositories\User\UserRepository;
use App\Services\Card\CardService;
use Illuminate\Support\ServiceProvider;
use LaravelSupports\Auth\Contracts\AuthRepositoryContract;

class ControllerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerAuth();
        $this->registerUser();
        $this->registerCard();
    }

    private function registerAuth(): void
    {
        $this->app->bind(AuthRepositoryContract::class, UserRepository::class);
    }

    private function registerUser(): void
    {
        $this->app->singleton(UserRepository::class, fn() => new UserRepository(User::class));

    }

    private function registerCard(): void
    {
        $this->app->singleton(CardRepository::class, fn() => new CardRepository(Card::class));
        $this->app->singleton(CardService::class, fn() => new CardService(app(CardRepository::class)));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
