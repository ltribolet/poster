<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class InjectPasswordGrantCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  Request     $request
     * @param  \Closure    $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next, $guard = null)
    {
        if (in_array($request->grant_type, ['password', 'refresh_token'])) {
            $client =  \Laravel\Passport\Client::where('id', env('PASSWORD_CLIENT_ID'))->first();

            $request->request->add(
                [
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                ]
            );
        }

        return $next($request);
    }
}
