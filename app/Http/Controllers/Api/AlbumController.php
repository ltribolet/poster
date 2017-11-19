<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\AlbumCollection;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AlbumController extends Controller
{
    public function get(Album $album)
    {
        return new AlbumResource($album);
    }

    public function all()
    {
        return new AlbumCollection(Auth::user()->albums()->paginate());
    }

    public function update(Request $request, Album $album)
    {
        $validator = validator($request->only('name', 'description', 'isDownload', 'visibility', 'sort'), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|nullable|max:1000',
            'isDownload' => 'required|boolean',
            'visibility' => 'required|in:private,hidden,public',
            'sort' => 'required|in:created_at,name',
        ]);

        if ($validator->fails()) {
            return JsonResponse::create($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $album->fill($request->all());
        $album->save();

        return new AlbumResource($album);
    }

    /**
     * Delete an album.
     */
    public function delete(Album $album)
    {
        try {
            $album->delete();

            $message = ['message' => 'success'];
            $httpCode = Response::HTTP_OK;
        } catch (\Exception $e) {
            // @todo use Logger instead and send a very nice message
            $message = ['error' => $e->getMessage()];
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return JsonResponse::create($message, $httpCode);
    }

    public function create(Request $request)
    {
        $album = new Album;

        // @todo move to a service
        try {
            $user = Auth::user();

            $album->name = $request->get('name');
            $album->description = $request->get('description', '');
            $album->isDownload = $request->get('isDownload');
            $album->visibility = $request->get('visibility');
            $album->sort = 'created_at';

            $album = $user->albums()->save($album);

            return new AlbumResource($album);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;

            return JsonResponse::create($message, $httpCode);
        }
    }
}
