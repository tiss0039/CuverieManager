<?php

namespace Tests\Feature;

use App\Models\Employe;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests de non-régression : création et modification d'un employé
 * (champs nom, prenom, email et role_id du formulaire).
 */
class EmployeTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $role = Role::create(['nom_role' => 'Administrateur']);

        return User::factory()->create(['role_id' => $role->id]);
    }

    public function test_admin_can_create_an_employee_with_a_role(): void
    {
        $admin = $this->admin();
        $caviste = Role::create(['nom_role' => 'Caviste']);

        $response = $this->actingAs($admin)->post(route('employes.store'), [
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'role_id' => $caviste->id,
        ]);

        $response->assertRedirect(route('employes.index'));
        $this->assertDatabaseHas('employes', [
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'role_id' => $caviste->id,
        ]);
    }

    public function test_admin_can_update_an_employee(): void
    {
        $admin = $this->admin();
        $manager = Role::create(['nom_role' => 'Manager']);
        $employe = Employe::create([
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'role_id' => $admin->role_id,
        ]);

        $response = $this->actingAs($admin)->put(route('employes.update', $employe), [
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'role_id' => $manager->id,
        ]);

        $response->assertRedirect(route('employes.index'));
        $this->assertSame($manager->id, $employe->fresh()->role_id);
    }

    public function test_employee_list_shows_role_names(): void
    {
        $admin = $this->admin();
        Employe::create([
            'nom' => 'Martin',
            'prenom' => 'Claire',
            'email' => 'claire.martin@example.com',
            'role_id' => $admin->role_id,
        ]);

        $this->actingAs($admin)
            ->get(route('employes.index'))
            ->assertOk()
            ->assertSee('Claire')
            ->assertSee('Administrateur');
    }
}
