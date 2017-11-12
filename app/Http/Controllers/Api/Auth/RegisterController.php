<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
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
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $modifiedInput = $request->all();
        $modifiedInput['password'] = bcrypt($input['password']);
        $user = User::create($modifiedInput);

        $request = Request::create('/api/login', 'POST', $input);
        $response = App::handle($request);

        if ($response->getStatusCode() >= 400) {

            throw new HttpResponseException($response);

        }

        return $response;
    }
}
