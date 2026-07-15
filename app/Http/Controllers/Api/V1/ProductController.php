<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index(Request $request)
    {
        $includes = $this->parseIncludes($request, ['category']);

        return ProductResource::collection($this->service->list($includes));
    }

    public function store(StoreProductRequest $request)
    {
        return new ProductResource($this->service->create($request->validated()));
    }

    public function show(Request $request, int $id)
    {
        $includes = $this->parseIncludes($request, ['category']);
        $product = $this->service->find($id, $includes);

        if (! $product) {
            return $this->notFound('Product not found.');
        }

        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->service->find($id, []);

        if (! $product) {
            return $this->notFound('Product not found.');
        }

        return new ProductResource($this->service->update($product, $request->validated()));
    }

    public function destroy(int $id)
    {
        $product = $this->service->find($id, []);

        if (! $product) {
            return $this->notFound('Product not found.');
        }

        $this->service->delete($product);

        return response()->json([
            'meta' => ['message' => 'Product deleted successfully.'],
        ]);
    }
}
