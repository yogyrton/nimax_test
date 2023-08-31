<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::query()->create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        $product->categories()->attach($data['categories']);

        return new ProductResource($product);
    }

    public function show($id)
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Продукт не найден'
            ]);
        }

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Продукт не найден'
            ]);
        }

        $data = $request->validated();

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        $product->categories()->sync($data['categories']);

        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Продукт не найден'
            ]);
        }

        $product->delete();

        return response()->json([
            'message' => 'Продукт был удален'
        ]);
    }
}
