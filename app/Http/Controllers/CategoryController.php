<?php

namespace Journey\Http\Controllers;

use Illuminate\Http\Request;

use Journey\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->validate(Category::$validationRules));

        if (!$category) {
            return response()->json("Failed to create a new category, please try again.", 500);
        }

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (!$category) {
            return response()->json("Categoy does not exist.", 404);
        }
        
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $categoryUpdated = $category->update($request->validate(Category::$validationRules));
    
        if (!$categoryUpdated) {
            return response()->json("Failed to update specified category. Please try again.", 500);
        }

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!$category->delete()) {
            return response()->json("Failed to delete specified category. Please try again.", 500);
        }

        return response()->json([], 204);
    }
}
