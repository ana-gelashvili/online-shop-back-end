<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    /**
     * @param  array<int, string>  $includes
     */
    public function list(
        array $includes = [],
        ?string $search = null,
        ?string $categorySlug = null,
        int $perPage = 12
    ): LengthAwarePaginator {
        return Product::with($includes)
            ->when($categorySlug, fn ($query, $slug) => $query->whereHas(
                'category',
                fn ($category) => $category->where('slug', $slug)
            ))
            ->when($search, fn ($query, $search) => $query->where(
                fn ($inner) => $inner
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
            ))
            ->paginate($perPage)
            ->withQueryString();
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
