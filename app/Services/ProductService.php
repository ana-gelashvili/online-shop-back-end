<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    /**
     * @param  array<int, string>  $includes
     */
    public function list(array $includes = []): Collection
    {
        return Product::with($includes)->get();
    }

    /**
     * @param  array<int, string>  $includes
     */
    public function find(int $id, array $includes = []): ?Product
    {
        return Product::with($includes)->find($id);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Product $product, array $data): Product
    {
        $product->update($data);

        return $product;
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
