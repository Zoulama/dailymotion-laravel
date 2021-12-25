<?php


namespace App\Providers\Infrastructure\Storage\Database\MongoDB;

use Illuminate\Support\ServiceProvider;
use MongoDB\Client;
use Dailymotion\infrastructure\Storage\Database\MongoDB\MongoClientInterface;


class MongoDBClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(MongoClientInterface::class, function ($app) {

            return $mongoClient = new Client(
                //app(SecretManagerInterface::class)->get("DB_MONGODB_URI")
                env("DB_MONGODB_URI")
            );
        });
    }
}
