<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function get(Album $album) : JsonResponse
    {
        return response()->json($album);
    }
}
