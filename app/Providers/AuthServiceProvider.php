<?php

namespace App\Providers;

use Carbon\Carbon;
use Route;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Route::post('oauth/token', [
            'middleware' => 'password-grant',
            'uses' => '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken'
        ]);
        Route::post('oauth/token/refresh', [
            'middleware' => ['web', 'auth', 'password-grant'],
            'uses' => '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh'
        ]);

        $tokenLifeTime = env('APP_ENV') === 'local' ? Carbon::now()->addYear() : Carbon::now()->addMinute(10);
        Passport::tokensExpireIn($tokenLifeTime);
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
