<?php

namespace Tests\Feature;

use App\Models\Employe;
use App\Models\Historique;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests de non-régression : page de détail d'une entrée d'historique.
 */
class HistoriqueTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_view_history_entry_details(): void
    {
        $role = Role::create(['nom_role' => 'Manager']);
        $manager = User::factory()->create(['role_id' => $role->id]);
        $employe = Employe::create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'role_id' => $role->id,
        ]);
        $historique = Historique::create([
            'type_action' => 'Ajout d’une cuve',
            'date_action' => '2024-12-20 10:30:00',
            'employe_id' => $employe->id,
        ]);

        $this->actingAs($manager)
            ->get(route('historiques.show', $historique))
            ->assertOk()
            ->assertSee('Ajout d’une cuve')
            ->assertSee('2024-12-20 10:30:00')
            ->assertSee('Dupont');
    }

    public function test_unknown_history_entry_returns_404(): void
    {
        $role = Role::create(['nom_role' => 'Manager']);
        $manager = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($manager)
            ->get(route('historiques.show', 999))
            ->assertNotFound();
    }
}
