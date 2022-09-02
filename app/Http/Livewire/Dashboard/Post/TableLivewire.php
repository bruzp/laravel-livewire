<?php

namespace App\Http\Livewire\Dashboard\Post;

use Livewire\Component;
use App\Models\Post;
use Auth;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TableLivewire extends Component
{
    use WithPagination, Actions, AuthorizesRequests;

    public $perPage = 10;
    public $sortBy = 'updated_at';
    public $orderBy = 'DESC';
    public $search = '';
    public $checked = [];
    public $is_checked_all = false;
    public $action = '';

    protected $listeners = ['executeAction'];

    // called eachtime an event happens
    public function render()
    {
        return view('livewire.dashboard.post.table-livewire',  [
            'posts' => $this->posts,
        ]);
    }

    // https://laravel-livewire.com/docs/2.x/lifecycle-hooks#class-hooks
    public function updating($name, $value)
    {
        switch ($name) {
            case 'search':
            case 'perPage':
                $this->resetPage();
                break;
        }
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->orderBy = $this->orderBy === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->orderBy = 'ASC';
        }

        $this->sortBy = $field;
    }

    public function checkAll()
    {
        if ($this->is_checked_all) {
            $this->checked = $this->posts->pluck('id')->all();
        } else {
            $this->checked = [];
        }
    }

    public function executeAction()
    {
        switch ($this->action) {
            case 'Delete':
                $this->confirmBulkDestroy();
                break;
        }
    }

    // Computed property definition, can be accessed also in view
    // $this->posts
    // https://laravel-livewire.com/docs/2.x/properties#computed-properties
    public function getPostsProperty()
    {
        return Post::query()
            ->select('posts.*', 'users.name as username')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->when(!Auth::user()->hasRole('admin'), function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->when(!empty($this->search), function ($query) {
                $query->where(function ($query) {
                    $query->search('title', $this->search) // macros defined
                        ->orSearch('description', $this->search) // @ AppServiceProvider
                        ->orSearch('users.name', $this->search);
                });
            })
            ->orderBy($this->sortBy, $this->orderBy)
            ->paginate($this->perPage);
    }

    // Dialog confirmation, triggered after clicking delete button in the table.
    public function confirmDestroy(Post $post)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete ' . $post->title . '?',
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'destroy',
            'params'      => $post,
        ]);
    }

    // Delete the post if user clicks "Yes, delete it" on the dialog.
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $this->is_checked_all = false;

        $this->dialog()->success('Delete Post', 'Successfully deleted post.');
    }

    // Dialog confirmation for bulk delete, triggered after selecting from Bulk actions "delete".
    public function confirmBulkDestroy()
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete selected items?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'bulkDestroy',
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancelBulkDestroy',
            ],
        ]);
    }

    // Reset action select to default value if bulk delete is cancelled.
    public function cancelBulkDestroy()
    {
        $this->action = '';
    }

    // Execute bulk delete action when "Yes, delete it" is clicked.
    public function bulkDestroy()
    {
        Post::whereIntegerInRaw('id', $this->checked)->delete();

        // resetting form values to default
        $this->action = '';
        $this->is_checked_all = false;

        //reset pagination to page1 
        // https://laravel-livewire.com/docs/2.x/pagination#resetting-pagination
        $this->resetPage();
    }
}
