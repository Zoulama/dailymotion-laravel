<?php


namespace App\Providers\Domain\User\Service;


use Illuminate\Support\ServiceProvider;
use Dailymotion\domain\User\Repository\UserRepositoryInterface;
use Dailymotion\domain\User\Service\UserService;
use Dailymotion\domain\User\Service\UserServiceInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserServiceInterface::class, function ($app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class)
            );
        });
    }
}
