<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Photo extends Model
{
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * Check the width and height of the photo and resize of the larger side to 800px, keeping the proportions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $path, path to storage directory
     */
    public function createThumbnail($request, $path)
    {
        $photoName = $request->file('photo')->hashName();

        //Saving source photo and thumbnail
        $request->file('photo')->store($path, 'photos/sources');
        $request->file('photo')->store($path, 'photos/thumbnails');

        $thumbnail = Image::make(storage_path('app/public/photos/thumbnails/') . $path . '/' . $photoName);

        if ($thumbnail->width() > $thumbnail->height()) {
            $thumbnail->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } elseif ($thumbnail->width() < $thumbnail->height()) {
            $thumbnail->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $thumbnail->resize(800, 800);
        }

        $thumbnail->save(base_path('storage/app/public/photos/thumbnails/' . $path . '/' . $photoName));
    }

    /**
     * Delete photo (source and thumbnail) from storage directory
     *
     * @param $path, path to photo.
     */
    public function deletePhotoFromStorage($path)
    {
        $sourcePath = storage_path('app/public/photos/sources/') . $path;
        $thumbnailPath = storage_path('app/public/photos/thumbnails/') . $path;
        if (file_exists($sourcePath)) {
            unlink($thumbnailPath);
            unlink($sourcePath);
        }
    }
}
