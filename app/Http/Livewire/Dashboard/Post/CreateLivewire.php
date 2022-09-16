<?php

namespace App\Http\Livewire\Dashboard\Post;

use Auth;
use App\Models\Post;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;

class CreateLivewire extends Component
{
    use Actions;

    public $title;
    public $description;
    public $slug;
    public $is_active = 0;

    public function render()
    {
        return view('livewire.dashboard.post.create-livewire');
    }

    public function store()
    {
        Auth::user()->posts()->create($this->validate());

        $this->reset();

        $this->dialog()->success('Create Post', 'Successfully saved post.');
    }

    // listen for change event for slug
    public function updatedSlug()
    {
        $this->slug = Str::slug($this->slug, '-');
    }

    public function updatedIsActive()
    {
        $this->is_active = $this->is_active ?: 0;
    }

    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'is_active' => ['nullable', 'integer', 'in:' . implode(',', Post::STATUS)],
        ];
    }
}
