<?php

namespace App\Service;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class PictureService
{
    public function savePicture(int $albumId, string $title, string $description, UploadedFile $file) : Picture
    {
        $album = Album::find($albumId);

        // store file
        $albumSignature = md5($albumId);
        $path = $file->store('public/img/'.$albumSignature.'/original');
        
        $url = env('APP_URL').'/img/'.$albumSignature.'/original/'.basename($path);
        $content = Storage::get($path);
        $checksum = sha1($content);

        $fullPathFile = storage_path('app/'.$path);

        // get exif data
        $exifData = $this->getExiData($fullPathFile);
        // optimize file for web and strip metadata
        ImageOptimizer::optimize($fullPathFile);

        // create entity
        $data = [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'checksum' => $checksum,
            'note' => null,
            'fav' => null,
            'isDownload' => false,
            'size' => Storage::size($path),
        ] + $exifData;

        $picture = new Picture();
        $picture->fill($data);
        $album->pictures()->save($picture);

        return $picture;
    }

    /**
     * @param $fullPathFile
     *
     * @return array
     */
    protected function getExiData($fullPathFile): array
    {
        $exifData = exif_read_data($fullPathFile);
        
        $suffixFocal = ' mm';
        $focalLength = '';

        if (array_key_exists('FocalLength', $exifData)) {
            $focalLength = $exifData['FocalLength'];
        }

        if (!empty($focalLength)) {
            $focalLength .= $suffixFocal;
        }

        // match values like 12/1 or other crop multiplier.
        if (preg_match('/(\d{2,3})\/(\d{1,2})/', $focalLength, $match)) {
            $focalLength = round($match[1] / $match[2], 1).$suffixFocal;
        }

        return [
            'iso' => $exifData['ISOSpeedRatings'] ?? '',
            'shutter' => $exifData['ExposureTime'] ?? '',
            'aperture' => $exifData['COMPUTED']['ApertureFNumber'] ?? '',
            'focal' => $focalLength,
            'make' => $exifData['Make'] ?? '',
            'model' => $exifData['Model'] ?? '',
            'shoot_at' => $exifData['DateTimeOriginal'] ?? null,
            'width' => $exifData['COMPUTED']['Width'] ?? '',
            'height' => $exifData['COMPUTED']['Height'] ?? '',
            'type' => $exifData['MimeType'] ?? '',
            'exif' => json_encode($exifData),
        ];
    }
}
