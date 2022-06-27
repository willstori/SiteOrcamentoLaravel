<?php

namespace App\Services;

class UploadService implements IUploadService
{
    private const BASE_UPLOAD_FOLDER = "uploads/";

    public function loadFromRequest($request, $name, $directory)
    {
        if ($request->hasFile($name) && $request->file($name)->isValid()) {

            return UploadService::BASE_UPLOAD_FOLDER . $request->file($name)->store($directory);
        }

        return null;
    }

    public function loadFromRequestMultiple($request, $name, $directory)
    {
        if ($request->hasFile($name)) {

            $files = [];

            foreach ($request->file($name) as $file) {

                if($file->isValid()){

                    array_push($files, UploadService::BASE_UPLOAD_FOLDER . $file->store($directory));

                }

            }

            return $files;
        }

        return null;
    }
}
