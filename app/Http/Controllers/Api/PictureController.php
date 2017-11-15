<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PictureCollection;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PictureController extends Controller
{

    public function get(Picture $picture) : JsonResponse
    {
        return response()->json($picture);
    }

    /**
     * @todo : this will probably not gonna make it. Just prototyping for now. It will make more sense in a service.
     *
     * @param Album $album
     *
     * @return JsonResponse
     */
    public function create(Album $album) : JsonResponse
    {
        $picture = new Picture();

        try {
            $picture->name = request()->get('name');
            $picture->description = request()->get('description', '');
            $picture->isDownload = request()->get(true);
            $picture->visibility = request()->get('public');
            $picture->sort = request()->get('created_at');

            $album->pictures()->save($picture);

            $httpCode = Response::HTTP_CREATED;
            $message = 'Success';
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return JsonResponse::create($message, $httpCode);
    }

    public function all(Album $album) : PictureCollection
    {
        return new PictureCollection($album->pictures()->paginate());
    }
}
