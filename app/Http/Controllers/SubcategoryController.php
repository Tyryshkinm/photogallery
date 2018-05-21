<?php

namespace App\Http\Controllers;

use App\Category;
use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Show the form for creating a new subcategory.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId)
    {
        return view('subcategories.create')->with('categoryId', $categoryId);
    }

    /**
     * Store a newly created subcategory in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $categoryId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $categoryId)
    {
        $subcategory = new Subcategory();
        $subcategory->name = $request->input('name');
        $subcategory->category_id = $categoryId;
        $subcategory->save();
        return redirect()->route('categories.show', $categoryId);
    }

    /**
     * Display the specified subcategory.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId = null, $subcategoryId)
    {
        $subcategory = Subcategory::FindOrFail($subcategoryId);
        return view('subcategories.show')->with('subcategory', $subcategory);
    }

    /**
     * Show the form for editing the specified subcategory.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function edit($categoryId, $subcategoryId)
    {
        $categories = Category::select()->where('id', '!=', $categoryId)->get();
        $subcategory = Subcategory::findOrFail($subcategoryId);
        return view ('subcategories.edit')
            ->with(['categories' => $categories,
                    'subcategory' => $subcategory]);
    }

    /**
     * Update the specified subcategory in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId, $subcategoryId)
    {
        $category = $request->input('category');
        $subcategory = Subcategory::findOrFail($subcategoryId);
        $subcategory->name = $request->input('name');
        $subcategory->category_id = Category::select('id')->where('name', '=', $category)->first()->id;
        $subcategory->save();
        return redirect()->route('categories.show', $categoryId);
    }

    /**
     * Remove the specified subcategory from storage.
     *
     * @param  int  $categoryId
     * @param  int  $subcategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoryId = null, $subcategoryId)
    {
        $subcategory = Subcategory::findOrFail($subcategoryId);
        $subcategory->delete();
        return redirect()->route('categories.show', $subcategory->category_id);
    }
}
