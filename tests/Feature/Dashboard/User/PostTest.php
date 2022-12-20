<?php

namespace Tests\Feature\Dashboard\User;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_post_index_page_is_displayed()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this
            ->actingAs($user)
            ->get(route('posts.index'));

        $response->assertOk();
    }

    public function test_user_post_create_page_is_displayed()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this
            ->actingAs($user)
            ->get(route('posts.create'));

        $response->assertOk();
    }

    public function test_user_post_edit_page_is_displayed()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('posts.edit', $post));

        $response->assertOk();
    }
}
