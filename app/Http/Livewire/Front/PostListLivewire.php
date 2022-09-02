<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Post;

class PostListLivewire extends Component
{
    public $perPage = 10;

    public $offset = 0;

    public $limit = 10;

    public $post_ctr = 0;

    public function render()
    {
        return view('livewire.front.post-list-livewire', [
            'posts' => Post::query()
                ->offset($this->offset)
                ->limit($this->limit)
                ->get()
        ]);
    }

    public function loadMore()
    {
        $this->offset += $this->perPage;
        $this->limit += $this->perPage;
    }
}
