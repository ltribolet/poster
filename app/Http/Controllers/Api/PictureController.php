<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Picture as PictureResource;
use App\Http\Resources\PictureCollection;
use App\Models\Album;
use App\Models\Picture;
use App\Service\PictureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PictureController extends Controller
{
    /**
     * @var PictureService
     */
    private $pictureService;

    /**
     * PictureController constructor.
     *
     * @param PictureService $pictureService
     */
    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }

    public function get(Picture $picture)
    {
        return new PictureResource($picture);
    }

    public function update(Request $request, Picture $picture)
    {
        $validator = validator(
            $request->only('name', 'description', 'isDownload', 'visibility', 'sort'),
            [
                'title' => 'required|string|max:100',
                'description' => 'required|string|nullable|max:1000',
                'file' => 'required|file',
            ]
        );

        if ($validator->fails()) {
            return JsonResponse::create($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        }

        $picture->fill($request->only(['title', 'description']));
        $picture->save();

        return (new PictureResource($picture))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     *
     */
    public function create(Request $request)
    {
        try {
            $validator = validator(
                $request->only('title', 'description', 'albumId'),
                [
                    'title' => 'required|string|max:100',
                    'description' => 'required|string|nullable|max:1000',
                    'albumId' => 'required|integer',
                ]
            );

            if ($validator->fails()) {
                return JsonResponse::create($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
            }

            if (!$request->file('picture')->isValid()) {
                return JsonResponse::create(
                    ['error' => $request->file('picture')->getErrorMessage()],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $picture = $this->pictureService->savePicture(
                (int) $request->get('albumId'),
                $request->get('title'),
                $request->get('description'),
                $request->file('picture')
            );

            return (new PictureResource($picture))->response()->setStatusCode(Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR;

            return JsonResponse::create($message, $httpCode);
        }
    }

    public function all(Album $album): PictureCollection
    {
        return new PictureCollection($album->pictures()->paginate());
    }
}
