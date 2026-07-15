<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class Controller
{
    /**
     * Parse the `include` query parameter into a whitelisted list of relations.
     *
     * @param  array<int, string>  $allowed
     * @return array<int, string>
     */
    protected function parseIncludes(Request $request, array $allowed): array
    {
        $requested = array_filter(explode(',', (string) $request->query('include', '')));

        return array_values(array_intersect($requested, $allowed));
    }

    protected function notFound(string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 404);
    }
}
