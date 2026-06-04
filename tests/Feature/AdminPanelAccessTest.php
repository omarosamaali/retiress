<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'عضو']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/');
        $response->assertSessionHas('error');
    }

    public function test_manager_can_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'مدير']);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertOk();
    }

    public function test_guest_cannot_access_admin_messages(): void
    {
        $response = $this->get('/admin/messages');

        $response->assertRedirect(route('login'));
    }
}
