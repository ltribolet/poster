<?php

namespace App\Services\Api;

use Illuminate\Foundation\Application;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\User;

class LoginProxy
{
    const REFRESH_TOKEN = 'refreshToken';

    protected $response;

    protected $app;

    private $auth;

    private $cookie;

    private $db;

    private $request;

    public function __construct(Application $app)
    {
        $this->auth = $app->make('auth');
        $this->cookie = $app->make('cookie');
        $this->db = $app->make('DB');
        $this->request = $app->make('Request');
        $this->app = $app;
    }

    /**
     * Attempt to create an access token using user credentials
     *
     * @param string $email
     * @param string $password
     *
     * @return array
     */
    public function attemptLogin(string $email, string $password) : array
    {
        $user = User::where('email', $email)->first();

        if (!is_null($user)) {
            return $this->proxy(
                'password',
                [
                    'username' => $email,
                    'password' => $password,
                ]
            );
        }

        throw new UnauthorizedHttpException('');
    }

    /**
     * Attempt to refresh the access token used a refresh token that
     * has been saved in a cookie
     *
     * @param string $refreshToken
     *
     * @return array
     */
    public function attemptRefresh(string $refreshToken) : array
    {
        return $this->proxy(
            'refresh_token',
            [
                'refresh_token' => $refreshToken,
            ]
        );
    }

    /**
     * Proxy a request to the OAuth server.
     *
     * @param string $grantType what type of grant type should be proxied
     * @param array  $data      the data to send to the server
     *
     * @return array
     */
    public function proxy(string $grantType, array $data = []) : array
    {
        $data = array_merge(
            $data,
            [
                'client_id' => env('PASSWORD_CLIENT_ID'),
                'client_secret' => env('PASSWORD_CLIENT_SECRET'),
                'grant_type' => $grantType,
            ]
        );

        $request = Request::create('/oauth/token', 'POST', $data);
        $response = $this->app->handle($request);

        if ($response->getStatusCode() >= Response::HTTP_BAD_REQUEST) {
            throw new HttpResponseException($response);
        }

        $data = json_decode($response->getContent());

        return [
            'access_token' => $data->access_token,
            'expires_in' => $data->expires_in,
            'refresh_token' => $data->refresh_token,
        ];
    }

    /**
     * Logs out the user. We revoke access token and refresh token.
     */
    public function logout() : void
    {
        $accessToken = $this->auth->user()->token();

        $this->db
            ->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(
                [
                    'revoked' => true,
                ]
            )
        ;

        $accessToken->revoke();
    }
}
