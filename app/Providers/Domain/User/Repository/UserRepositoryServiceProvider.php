<?php


namespace App\Providers\Domain\User\Repository;


use Illuminate\Support\ServiceProvider;
use Dailymotion\domain\User\Repository\UserRepository;
use Dailymotion\domain\User\Repository\UserRepositoryInterface;
use MongoDB\Client;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, function ($app) {
            $mongoClient = new Client(
                env('DB_MONGODB_URI')
            );
            $collection = $mongoClient->selectCollection('dailymotion', 'users');
            return new UserRepository(
                $collection
            );
        });
    }
}
