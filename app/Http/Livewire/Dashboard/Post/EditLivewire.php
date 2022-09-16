<?php

namespace App\Http\Livewire\Dashboard\Post;

use App\Models\Post;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditLivewire extends Component
{
    use Actions, AuthorizesRequests;

    // Binding To Model Properties
    // https://laravel-livewire.com/docs/2.x/properties#binding-models
    public $post;

    public function render()
    {
        return view('livewire.dashboard.post.edit-livewire');
    }

    public function update()
    {
        $this->authorize('update', $this->post);

        $this->post->update($this->validate());

        $this->dialog()->success('Update Post', 'Successfully updated post.');
    }

    // listen for change event for slug
    public function updatedPostSlug()
    {
        $this->post->slug = Str::slug($this->post->slug, '-');
    }

    public function updatedPostIsActive()
    {
        $this->post->is_active = $this->post->is_active ?: 0;
    }

    protected function rules()
    {
        return [
            'post.title' => ['required', 'string'],
            'post.description' => ['required', 'string'],
            'post.slug' => ['required', 'string'],
            'post.is_active' => ['sometimes', 'integer', 'in:' . implode(',', Post::STATUS)],
        ];
    }
}
