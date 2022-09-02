<?php

namespace App\Http\Livewire\Dashboard\Post;

use Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class CreateLivewire extends Component
{
    use Actions;

    public $title;
    public $description;

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

    protected function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}
