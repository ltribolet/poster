<?php

namespace App\Service;

use App\Models\Album;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PictureService
{
    public function savePicture(int $albumId, string $title, string $description, UploadedFile $file)
    {
        $album = Album::find($albumId);

        // store file
        $path = $file->store('public/img/'.md5($albumId).'/original');

        $url = Storage::url($path);
        $content = Storage::get($path);
        $checksum = sha1($content);

        $fullPathFile = storage_path('app/'.$path);

        // get exif data
        $exifData = $this->getExiData($fullPathFile);
        // make a thumbnail

        // create entity

        $data = [
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'thumbUrl' => '',
            'checksum' => $checksum,
            'note' => '',
            'fav' => '',
        ];
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

        if (array_key_exists('FocalLength', $exifData) && !empty($exifData['FocalLength'])) {
            $focalLength = $exifData['FocalLength'].$suffixFocal;
        }

        // match values like 12/1 or other crop multiplier.
        if (preg_match('/(\d{2,3})\/(\d{1,2})/', $exifData['FocalLength'], $match)) {
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
            'size' => ($exifData['FileSize'] ?? 0) / 1024,
            'exif' => json_encode($exifData),
        ];
    }
}
