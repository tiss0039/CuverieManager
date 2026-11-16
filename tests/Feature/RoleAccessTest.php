<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests de non-régression : redirection selon le rôle et gestion
 * des utilisateurs sans rôle attribué (réponse 403 au lieu d'une erreur 500).
 */
class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_without_role_gets_403_on_dashboard(): void
    {
        $user = User::factory()->create(['role_id' => null]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertForbidden();
        $response->assertSee('Aucun rôle ne vous a été attribué');
    }

    public function test_user_without_role_can_log_in_and_is_sent_to_dashboard(): void
    {
        $user = User::factory()->create(['role_id' => null]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_dashboard_redirects_each_role_to_its_own_dashboard(): void
    {
        $expected = [
            'Administrateur' => 'admin.dashboard',
            'Manager' => 'manager.dashboard',
            'Caviste' => 'caviste.dashboard',
        ];

        foreach ($expected as $roleName => $routeName) {
            $role = Role::create(['nom_role' => $roleName]);
            $user = User::factory()->create(['role_id' => $role->id]);

            $this->actingAs($user)
                ->get('/dashboard')
                ->assertRedirect(route($routeName));
        }
    }

    public function test_login_redirects_each_role_to_its_own_dashboard(): void
    {
        $expected = [
            'Administrateur' => 'admin.dashboard',
            'Manager' => 'manager.dashboard',
            'Caviste' => 'caviste.dashboard',
        ];

        foreach ($expected as $roleName => $routeName) {
            $role = Role::create(['nom_role' => $roleName]);
            $user = User::factory()->create(['role_id' => $role->id]);

            $this->post('/login', [
                'email' => $user->email,
                'password' => 'password',
            ])->assertRedirect(route($routeName));

            $this->post('/logout');
        }
    }
}
