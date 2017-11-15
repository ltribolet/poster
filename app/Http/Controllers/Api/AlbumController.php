<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlbumCollection;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    public function get(Album $album) : JsonResponse
    {
        return response()->json($album);
    }

    public function all()
    {
        return new AlbumCollection(Auth::user()->albums()->paginate());
    }

    public function create(Request $request) : JsonResponse
    {
        $album = new Album;

        try {
            $user = Auth::user();

            $album->name = $request->get('name');
            $album->description = $request->get('description', '');
            $album->isDownload = $request->get(true);
            $album->visibility = $request->get('public');
            $album->sort = $request->get('created_at');

            $user->albums()->save($album);

            $httpCode = Response::HTTP_CREATED;
            $message = 'Success';
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return JsonResponse::create($message, $httpCode);
    }
}
