<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * @param  array<int, string>  $includes
     */
    public function list(array $includes = []): Collection
    {
        return Category::with($includes)->get();
    }

    /**
     * @param  array<int, string>  $includes
     */
    public function find(int $id, array $includes = []): ?Category
    {
        return Category::with($includes)->find($id);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
