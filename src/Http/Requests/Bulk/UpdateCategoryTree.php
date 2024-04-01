<?php

namespace TeamTeaTime\Forum\Http\Requests\Bulk;

use Illuminate\Foundation\Http\FormRequest;
use TeamTeaTime\Forum\{
    Actions\Bulk\UpdateCategoryTree as Action,
    Events\UserUpdatedCategoryTree,
    Http\Requests\FulfillableRequestInterface,
    Support\Authorization\CategoryAuthorization,
    Support\Validation\CategoryRules,
};

class UpdateCategoryTree extends FormRequest implements FulfillableRequestInterface
{
    public function rules(): array
    {
        return CategoryRules::bulk();
    }

    public function authorizeValidated(): bool
    {
        return CategoryAuthorization::manage($this->user());
    }

    public function fulfill()
    {
        $categoryData = $this->validated()['categories'];
        $action = new Action($categoryData);
        $categoriesAffected = $action->execute();

        UserUpdatedCategoryTree::dispatch($this->user(), $categoriesAffected, $categoryData);

        return $categoriesAffected;
    }
}
