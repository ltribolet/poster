<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Api\LoginProxy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return response()->json($this->loginProxy->attemptLogin($email, $password));
    }

    public function refresh(Request $request) : JsonResponse
    {
        $refreshToken = $request->get('refresh_token');

        return new JsonResponse($this->loginProxy->attemptRefresh($refreshToken));
    }

    public function logout() : JsonResponse
    {
        $this->loginProxy->logout();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
