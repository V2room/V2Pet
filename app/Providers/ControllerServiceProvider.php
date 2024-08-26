<?php

namespace App\Providers;

use App\Models\Card\Card;
use App\Models\Card\CardComment;
use App\Models\User\User;
use App\Repositories\Card\CardCommentRepository;
use App\Repositories\Card\CardRepository;
use App\Repositories\User\UserRepository;
use App\Services\AI\AIService;
use App\Services\AI\Contracts\AIServiceContract;
use App\Services\AI\TestService;
use App\Services\Card\CardCommentService;
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
        $this->registerAI();
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
        $this->app->singleton(CardCommentRepository::class, fn() => new CardCommentRepository(CardComment::class));

        $this->app->singleton(CardService::class, fn($app) => new CardService($app->make(CardRepository::class)));
        $this->app->singleton(CardCommentService::class, fn($app) => new CardCommentService($app->make(CardCommentRepository::class)));
    }

    private function registerAI(): void
    {
        $this->app->singleton(AIService::class, fn() => new AIService(config('ai.api_url')));
        $this->app->singleton(TestService::class, fn() => new TestService());

        if (config('app.env') === 'local') {
            $this->app->bind(AIServiceContract::class, fn($app) => $app->make(TestService::class));
        } else {
            $this->app->bind(AIServiceContract::class, fn($app) => $app->make(AIService::class));
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
