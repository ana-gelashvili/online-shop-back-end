<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index(Request $request)
    {
        $includes = $this->parseIncludes($request, ['products']);

        return CategoryResource::collection($this->service->list($includes));
    }

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource($this->service->create($request->validated()));
    }

    public function show(Request $request, int $id)
    {
        $includes = $this->parseIncludes($request, ['products']);
        $category = $this->service->find($id, $includes);

        if (! $category) {
            return $this->notFound('Category not found.');
        }

        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = $this->service->find($id, []);

        if (! $category) {
            return $this->notFound('Category not found.');
        }

        return new CategoryResource($this->service->update($category, $request->validated()));
    }

    public function destroy(int $id)
    {
        $category = $this->service->find($id, []);

        if (! $category) {
            return $this->notFound('Category not found.');
        }

        $this->service->delete($category);

        return response()->json([
            'meta' => ['message' => 'Category deleted successfully.'],
        ]);
    }
}
