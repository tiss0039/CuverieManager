<?php

namespace Tests\Feature;

use App\Models\Cuve;
use App\Models\Mout;
use App\Models\Parcelle;
use App\Models\Proprietaire;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Tests de non-régression : association facultative d'un moût à une parcelle,
 * qui doit appartenir au propriétaire sélectionné.
 */
class MoutParcelleTest extends TestCase
{
    use RefreshDatabase;

    private User $caviste;
    private Proprietaire $domaineA;
    private Proprietaire $domaineB;
    private Parcelle $parcelleA;
    private Parcelle $parcelleB;
    private Cuve $cuve;

    protected function setUp(): void
    {
        parent::setUp();

        $role = Role::create(['nom_role' => 'Caviste']);
        $this->caviste = User::factory()->create(['role_id' => $role->id]);
        $this->domaineA = Proprietaire::create(['nom_proprietaire' => 'Domaine A']);
        $this->domaineB = Proprietaire::create(['nom_proprietaire' => 'Domaine B']);
        $this->parcelleA = Parcelle::create([
            'nom_parcelle' => 'Parcelle Nord',
            'localisation_parcelle' => 'Nord',
            'proprietaire_id' => $this->domaineA->id,
        ]);
        $this->parcelleB = Parcelle::create([
            'nom_parcelle' => 'Parcelle Sud',
            'localisation_parcelle' => 'Sud',
            'proprietaire_id' => $this->domaineB->id,
        ]);
        $this->cuve = Cuve::create(['nom' => 'Cuve 1', 'volume_maximum' => 1000]);
    }

    private function moutData(array $overrides = []): array
    {
        return array_merge([
            'volume' => 500,
            'type' => 'Chardonnay',
            'proprietaire_id' => $this->domaineA->id,
            'cuve_id' => $this->cuve->id,
        ], $overrides);
    }

    public function test_must_can_be_created_with_a_parcel_of_the_selected_owner(): void
    {
        $response = $this->actingAs($this->caviste)->post(route('mouts.store'), $this->moutData([
            'parcelle_id' => $this->parcelleA->id,
        ]));

        $response->assertRedirect(route('mouts.index'));
        $mout = Mout::sole();
        $this->assertSame($this->parcelleA->id, $mout->parcelle_id);
        $this->assertTrue($mout->parcelle->is($this->parcelleA));
        $this->assertTrue($this->parcelleA->mouts->first()->is($mout));
    }

    public function test_must_cannot_be_created_with_a_parcel_of_another_owner(): void
    {
        $response = $this->actingAs($this->caviste)->post(route('mouts.store'), $this->moutData([
            'parcelle_id' => $this->parcelleB->id,
        ]));

        $response->assertSessionHasErrors('parcelle_id');
        $this->assertDatabaseCount('mouts', 0);
    }

    public function test_must_cannot_be_updated_with_a_parcel_of_another_owner(): void
    {
        $mout = Mout::create($this->moutData(['parcelle_id' => $this->parcelleA->id]));

        $response = $this->actingAs($this->caviste)->put(route('mouts.update', $mout), $this->moutData([
            'parcelle_id' => $this->parcelleB->id,
        ]));

        $response->assertSessionHasErrors('parcelle_id');
        $this->assertSame($this->parcelleA->id, $mout->fresh()->parcelle_id);
    }

    public function test_unknown_parcel_is_rejected(): void
    {
        $response = $this->actingAs($this->caviste)->post(route('mouts.store'), $this->moutData([
            'parcelle_id' => 999,
        ]));

        $response->assertSessionHasErrors('parcelle_id');
        $this->assertDatabaseCount('mouts', 0);
    }

    public function test_must_can_be_created_without_a_parcel(): void
    {
        $response = $this->actingAs($this->caviste)->post(route('mouts.store'), $this->moutData([
            'parcelle_id' => '',
        ]));

        $response->assertRedirect(route('mouts.index'));
        $this->assertNull(Mout::sole()->parcelle_id);
    }

    public function test_parcel_can_be_removed_from_a_must(): void
    {
        $mout = Mout::create($this->moutData(['parcelle_id' => $this->parcelleA->id]));

        $this->actingAs($this->caviste)
            ->put(route('mouts.update', $mout), $this->moutData(['parcelle_id' => '']))
            ->assertRedirect(route('mouts.index'));

        $this->assertNull($mout->fresh()->parcelle_id);
    }

    public function test_existing_must_without_parcel_still_displays_and_updates(): void
    {
        // Enregistrement antérieur sans parcelle (compatibilité)
        $mout = Mout::create($this->moutData());

        $this->actingAs($this->caviste)
            ->get(route('mouts.index'))
            ->assertOk()
            ->assertSee('Chardonnay');

        $this->actingAs($this->caviste)
            ->get(route('mouts.edit', $mout))
            ->assertOk();

        $this->actingAs($this->caviste)
            ->put(route('mouts.update', $mout), $this->moutData(['type' => 'Pinot Noir']))
            ->assertRedirect(route('mouts.index'));

        $this->assertSame('Pinot Noir', $mout->fresh()->type);
        $this->assertNull($mout->fresh()->parcelle_id);
    }

    public function test_list_shows_the_parcel_of_each_must(): void
    {
        Mout::create($this->moutData(['type' => 'Chardonnay', 'parcelle_id' => $this->parcelleA->id]));
        Mout::create($this->moutData(['type' => 'Merlot']));

        $this->actingAs($this->caviste)
            ->get(route('mouts.index'))
            ->assertOk()
            ->assertSeeInOrder(['Parcelle', 'Chardonnay', 'Parcelle Nord', 'Merlot', 'Aucune']);
    }

    public function test_details_page_shows_the_parcel_or_none(): void
    {
        $avecParcelle = Mout::create($this->moutData(['parcelle_id' => $this->parcelleA->id]));
        $sansParcelle = Mout::create($this->moutData());

        $this->actingAs($this->caviste)
            ->get(route('mouts.show', $avecParcelle))
            ->assertOk()
            ->assertSee('Parcelle :')
            ->assertSee('Parcelle Nord');

        $this->actingAs($this->caviste)
            ->get(route('mouts.show', $sansParcelle))
            ->assertOk()
            ->assertSeeInOrder(['Parcelle :', 'Aucune']);
    }

    public function test_forms_list_parcels_with_their_owner(): void
    {
        $this->actingAs($this->caviste)
            ->get(route('mouts.create'))
            ->assertOk()
            ->assertSee('Parcelle Nord (Domaine A)')
            ->assertSee('Parcelle Sud (Domaine B)');

        $mout = Mout::create($this->moutData(['parcelle_id' => $this->parcelleA->id]));

        $this->actingAs($this->caviste)
            ->get(route('mouts.edit', $mout))
            ->assertOk()
            ->assertSee('Parcelle Nord (Domaine A)');
    }
}
