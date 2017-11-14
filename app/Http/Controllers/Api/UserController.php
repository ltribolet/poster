<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() : JsonResponse
    {
        return response()->json(Auth::user());
    }

    public function get(User $user) : JsonResponse
    {
        return response()->json($user);
    }
}
