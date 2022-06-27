<?php

namespace App\Services;

class ImageService implements IImageService
{
    private const DEFAULT_WIDTH = 800;
    private const DEFAULT_HEIGHT = 600;

    public function resizeFit($file, $width, $height)
    {
        if (empty($file)) {

            return null;
        }

        $img = \Intervention\Image\Facades\Image::make($file);

        $img->fit($width, $height);

        $img->save($file);

        return $file;
    }

    public function resize($file, $width = ImageService::DEFAULT_WIDTH, $height = ImageService::DEFAULT_HEIGHT)
    {
        if (empty($file)) {

            return null;
        }

        $img = \Intervention\Image\Facades\Image::make($file);

        $img->resize($width, $height);

        $img->save($file);

        return $file;
    }
}
