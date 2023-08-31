<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $category = Category::query()->create($data);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
        } catch (\Exception) {
            return response()->json([
                'message' => 'Категория не может быть удалена, в ней есть товары'
            ]);
        }

        return response()->json([
            'message' => 'Категория была удалена'
        ]);
    }
}
