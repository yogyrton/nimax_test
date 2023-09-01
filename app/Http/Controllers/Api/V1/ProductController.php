<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->category_id || $request->category_name) {
            $products
                ->categoryId($request->category_id)
                ->categoryName($request->category_name);

            return ProductResource::collection($products->get());
        }

        $products
            ->when($request->has('name'), fn(Builder $query) => $query->where('name', 'LIKE', "%$request->name%"))
            ->when($request->has('is_published'), fn(Builder $query) => $query->where('is_published', $request->is_published))
            ->when($request->has('min_price'), fn(Builder $query) => $query->where('price', '>=', $request->min_price))
            ->when($request->has('max_price'), fn(Builder $query) => $query->where('price', '<=', $request->max_price));

        return ProductResource::collection($products->get());
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
