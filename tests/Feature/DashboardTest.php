<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    public function test_admin_dashboard_page_is_displayed()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole($role_admin);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
    }

    public function test_user_dashboard_page_is_displayed()
    {
        // generic permissions
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);

        $role_user = Role::create(['name' => 'user']);
        $role_user->givePermissionTo([
            'create posts',
        ]);

        $user = User::factory()->create();
        $user->assignRole($role_user);

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response->assertOk();
    }
}
