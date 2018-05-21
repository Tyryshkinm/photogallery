<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

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
        $photo = new Photo();
        $path = 'categories/' . $categoryId . '/subcategories/' . $subcategoryId;
        $photo->createThumbnail($request, $path);
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
     * Show the form for editing the specified photo.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId, $subcategoryId = null, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        return view('photos.edit')
            ->with(['photo' => $photo,
                    'categoryId' => $categoryId]);
    }

    /**
     * Update the specified photo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId, $subcategoryId, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        $photo->deletePhotoFromStorage($photo->path);
        $path = 'categories/' . $categoryId . '/subcategories/' . $subcategoryId;
        $photo->createThumbnail($request, $path);
        $photo->path = $path . '/' . $request->file('photo')->hashName();
        $photo->description = $request->input('description');
        $photo->subcategory_id = $subcategoryId;
        $photo->save();
        return redirect()->route('categories.subcategories.show', [$categoryId, $subcategoryId]);
    }

    /**
     * Remove the specified photo from storage.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @param  int  $photoId
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId, $subcategoryId, $photoId)
    {
        $photo = Photo::findOrFail($photoId);
        $photo->deletePhotoFromStorage($photo->path);
        $photo->delete();
        return redirect()->route('categories.subcategories.show', [$categoryId, $subcategoryId]);
    }
}
