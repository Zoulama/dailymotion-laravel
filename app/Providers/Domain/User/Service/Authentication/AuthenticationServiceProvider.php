<?php


namespace App\Providers\Domain\User\Service\Authentication;


use Illuminate\Support\ServiceProvider;
//use Nbk\infrastructure\Secrets\SecretManagerInterface;
use Nbk\domain\User\Service\Authentication\AuthenticationService;
use Nbk\domain\User\Service\Authentication\AuthenticationServiceInterface;


class AuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthenticationServiceInterface::class, function ($app) {

            return new AuthenticationService(
                $app->make('Aws::Cognito::IdentityProvider'),
                env('AWS_USER_POOL_CLIENT_ID'),//$app->make(SecretManagerInterface::class)->get('AWS_USER_POOL_CLIENT_ID'),
                env('AWS_USER_POOL_ID') //$app->make(SecretManagerInterface::class)->get('AWS_USER_POOL_ID')
            );
        });
    }
}
