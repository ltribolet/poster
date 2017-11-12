<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\Api\LoginProxy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginProxy;

    public function __construct(LoginProxy $loginProxy)
    {
        $this->loginProxy = $loginProxy;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return response()->json($this->loginProxy->attemptLogin($email, $password));
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->get('refresh_token');

        return new JsonResponse($this->loginProxy->attemptRefresh($refreshToken));
    }

    public function logout()
    {
        $this->loginProxy->logout();

        return new JsonResponse(null, 204);
    }
}
