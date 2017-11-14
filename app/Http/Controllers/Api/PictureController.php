<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{

    public function get(Picture $picture) : JsonResponse
    {
        return response()->json($picture);
    }
}
