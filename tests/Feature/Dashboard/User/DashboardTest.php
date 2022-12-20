<?php

namespace Tests\Feature\Dashboard\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_dashboard_page_is_displayed()
    {
        $user = User::factory()->create();
        $user->assignRole('user');

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
    }
}
