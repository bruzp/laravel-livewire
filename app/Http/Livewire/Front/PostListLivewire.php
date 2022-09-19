<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Pagination\Cursor;
use Illuminate\Support\Collection;

class PostListLivewire extends Component
{
    public $posts; // holds are list of posts.
    public $nextCursor; // holds our current page position.
    public $hasMorePages; // Tells us if we have more pages to paginate.

    /**
     * Initialize data
     * @return void
     */
    public function mount()
    {
        $this->posts = new Collection(); // initialize the data
        $this->loadPosts(); // load the data
    }

    /**
     * Render our component
     *
     */
    public function render()
    {
        return view('livewire.front.post-list-livewire');
    }

    /**
     * Load data and maintain cursor state
     *
     */
    public function loadPosts()
    {
        if ($this->hasMorePages !== null  && !$this->hasMorePages) {
            return;
        }

        $posts = Post::cursorPaginate(
            15,
            ['*'],
            'cursor',
            Cursor::fromEncoded($this->nextCursor)
        );

        $this->posts->push(...$posts->items());

        $this->hasMorePages = $posts->hasMorePages();

        if ($this->hasMorePages === true) {
            $this->nextCursor = $posts->nextCursor()->encode();
        }
    }
}
