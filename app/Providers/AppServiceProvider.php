<?php

namespace App\Providers;

use App\Contracts\IBookService;
use App\Contracts\IUserService;
use App\Models\Book;
use App\Models\User;
use App\Services\BookService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserService::class, function ($app) {
            return new UserService($app->make(User::class));
        });

        $this->app->bind(IBookService::class, function ($app) {
            return new BookService($app->make(Book::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
