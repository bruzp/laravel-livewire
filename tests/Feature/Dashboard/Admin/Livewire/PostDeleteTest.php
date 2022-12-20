<?php

namespace Tests\Feature\Dashboard\Admin\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\Dashboard\Post\TableLivewire;

class PostDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_post()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $post = $user->posts()->create([
            'title' => 'test delete',
            'description' => 'test',
            'slug' => 'test',
            'is_active' => 1,
        ]);

        $this->actingAs($user);

        Livewire::test(TableLivewire::class)
            ->call('destroy', $post);

        $this->assertTrue(!Post::whereTitle('test delete')->exists());
    }
}
