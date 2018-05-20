<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the form for uploading a new photo.
     *
     * @param  int $categoryId
     * @param  int $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId, $subcategoryId)
    {
        return view('photos.create')->with(['categoryId' => $categoryId, 'subcategoryId' => $subcategoryId]);
    }

    /**
     * Store a newly uploaded photo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $categoryId
     * @param  int $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $categoryId, $subcategoryId)
    {
        $path = 'categories/' . $categoryId . '/subcategories/' . $subcategoryId;
        $request->file('photo')->store($path, 'photos/sources');
        $request->file('photo')->store($path, 'photos/thumbnails');
        $photoName = $request->file('photo')->hashName();
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

        $photo = new Photo();
        $photo->path = $path . '/' . $request->file('photo')->hashName();
        $photo->description = $request->input('description');
        $photo->subcategory_id = $subcategoryId;
        $photo->save();
        return redirect()->route('categories.subcategories.show', [$categoryId, $subcategoryId]);
    }

    /**
     * Display the specified photo.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId = null, $subcategoryId = null, $photoId)
    {
        $photo = Photo::FindOrFail($photoId);
        return view('photos.show')->with('photo', $photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
