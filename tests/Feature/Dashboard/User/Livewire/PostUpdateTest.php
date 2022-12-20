<?php

namespace Tests\Feature\Dashboard\User\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\Dashboard\Post\EditLivewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_post()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $post = $user->posts()->create([
            'title' => 'test',
            'description' => 'test',
            'slug' => 'test',
            'is_active' => 1,
        ]);

        $this->actingAs($user);

        Livewire::test(EditLivewire::class)
            ->set('post', $post)
            ->set('post.title', 'test edited')
            ->set('post.description', 'test edited')
            ->set('post.slug', 'test_edited')
            ->set('post.is_active', 0)
            ->call('update');

        $this->assertTrue(Post::whereTitle('test edited')->exists());
    }
}
