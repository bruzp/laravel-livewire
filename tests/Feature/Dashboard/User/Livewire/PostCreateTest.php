<?php

namespace Tests\Feature\Dashboard\User\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\Dashboard\Post\CreateLivewire;

class PostCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_post()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user);

        Livewire::test(CreateLivewire::class)
            ->set('title', 'test')
            ->set('description', 'test')
            ->set('slug', 'test')
            ->set('is_active', 1)
            ->call('store');

        $this->assertTrue(Post::whereTitle('test')->exists());
    }
}
