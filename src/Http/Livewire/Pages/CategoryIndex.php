<?php

namespace TeamTeaTime\Forum\Http\Livewire\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as ViewFactory;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use TeamTeaTime\Forum\Events\UserViewingIndex;
use TeamTeaTime\Forum\Support\Access\CategoryAccess;

class CategoryIndex extends Component
{
    public $categories = [];

    public function mount(Request $request)
    {
        $categories = CategoryAccess::getFilteredTreeFor($request->user())->toTree();

        // TODO: This is a workaround for a serialisation issue. See: https://github.com/lazychaser/laravel-nestedset/issues/487
        //       Once the issue is fixed, this can be removed.
        $this->categories = CategoryAccess::removeParentRelationships($categories);
    }

    #[On('echo:Forum,.user-edited-category')]
    public function onUserEditedCategory($event)
    {
        $test = '';
    }

    public function render(Request $request): View
    {
        if ($request->user() !== null) {
            broadcast(new UserViewingIndex($request->user()))->toOthers();
        }

        return ViewFactory::make('forum::pages.category.index')
            ->layout('forum::layouts.main');
    }
}
