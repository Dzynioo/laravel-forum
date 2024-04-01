<?php

namespace TeamTeaTime\Forum\Http\Controllers\Blade\Bulk;

use Illuminate\Http\JsonResponse;
use TeamTeaTime\Forum\Http\Requests\Bulk\UpdateCategoryTree;

class CategoryController
{
    public function manage(UpdateCategoryTree $request): JsonResponse
    {
        $request->fulfill();

        return new JsonResponse(['success' => true], 200);
    }
}
