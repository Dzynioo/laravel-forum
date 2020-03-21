<?php

namespace TeamTeaTime\Forum\Http\Requests\Bulk;

use Illuminate\Foundation\Http\FormRequest;
use TeamTeaTime\Forum\Http\Requests\Traits\AuthorizesAfterValidation;
use TeamTeaTime\Forum\Interfaces\FulfillableRequest;
use TeamTeaTime\Forum\Models\Post;

class DestroyPosts extends FormRequest implements FulfillableRequest
{
    use AuthorizesAfterValidation;

    public function rules(): array
    {
        return [
            'posts' => ['required', 'array'],
            'permadelete' => ['boolean']
        ];
    }

    public function authorizeValidated(): bool
    {
        $posts = $this->posts()->get();
        foreach ($posts as $post)
        {
            if (! $this->user()->can('delete', $post)) return false;
        }

        return true;
    }

    public function fulfill()
    {
        $posts = $this->posts();

        if (config('forum.general.soft_deletes') && $this->validated()['permadelete'] && method_exists(Post::class, 'forceDelete'))
        {
            $post->forceDelete();
        }
        else
        {
            $post->delete();
        }

        return $posts->get();
    }

    private function posts(): Builder
    {
        $query = $this->user()->can('viewTrashedPosts') ? Post::withTrashed() : Post::query();
        return $query->whereIn('id', $this->validated()['posts']);
    }
}
