<?php

namespace Tests\Feature;

use App\Models\Cuve;
use App\Models\Employe;
use App\Models\Historique;
use App\Models\Mout;
use App\Models\Parcelle;
use App\Models\Proprietaire;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * Vérifie que le DatabaseSeeder s'exécute sans erreur (contraintes de clés
 * étrangères actives) et crée les données de démonstration attendues.
 */
class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_demo_data(): void
    {
        $this->seed();

        // Les trois rôles ne sont créés qu'une seule fois
        $this->assertSame(
            ['Administrateur', 'Caviste', 'Manager'],
            Role::orderBy('nom_role')->pluck('nom_role')->all()
        );

        // Comptes de démonstration, chacun avec son rôle
        $this->assertSame(3, User::count());
        foreach ([
            'admin@example.com' => 'Administrateur',
            'manager@example.com' => 'Manager',
            'caviste@example.com' => 'Caviste',
        ] as $email => $roleName) {
            $user = User::where('email', $email)->firstOrFail();
            $this->assertSame($roleName, $user->role->nom_role);
            $this->assertTrue(Hash::check('password123', $user->password));
        }

        $this->assertSame(2, Proprietaire::count());
        $this->assertSame(3, Parcelle::count());
        $this->assertSame(3, Cuve::count());
        $this->assertSame(2, Mout::count());
        $this->assertSame(2, Employe::count());
        $this->assertSame(2, Historique::count());
        $this->assertSame(0, Employe::whereNull('role_id')->count());
    }
}
