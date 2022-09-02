<?php

namespace App\Http\Livewire\Dashboard\Post;

use Livewire\Component;
use WireUi\Traits\Actions;
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

    protected function rules()
    {
        return [
            'post.title' => ['required', 'string'],
            'post.description' => ['required', 'string'],
        ];
    }
}
