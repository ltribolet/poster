<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    const API_LOGIN_URI = '/api/login';

    /**
     * Register api
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) : \Illuminate\Http\Response
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }

        $input = $modifiedInput = $request->all();
        $modifiedInput['password'] = bcrypt($input['password']);
        $user = User::create($modifiedInput);

        $request = Request::create(self::API_LOGIN_URI, 'POST', $input);
        $response = App::handle($request);

        if ($response->getStatusCode() >= Response::HTTP_BAD_REQUEST) {
            throw new HttpResponseException($response);
        }

        return $response;
    }
}
