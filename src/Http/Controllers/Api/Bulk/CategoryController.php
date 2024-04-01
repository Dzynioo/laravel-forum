<?php

namespace TeamTeaTime\Forum\Http\Controllers\Api\Bulk;

use Illuminate\Http\Response;
use TeamTeaTime\Forum\Http\Requests\Bulk\UpdateCategoryTree;

class CategoryController
{
    public function manage(UpdateCategoryTree $request): Response
    {
        $request->fulfill();

        return new Response(['success' => true], 200);
    }
}
