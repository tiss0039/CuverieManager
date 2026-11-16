<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute la colonne role_id à la table employes
     * (utilisée par le formulaire, la liste des employés et le seeder).
     */
    public function up(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('email')
                ->constrained('roles')->nullOnDelete();
        });
    }

    /**
     * Supprime la colonne role_id de la table employes.
     */
    public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
        });
    }
};
