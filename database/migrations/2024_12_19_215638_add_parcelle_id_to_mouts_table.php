<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mouts', function (Blueprint $table) {
            $table->unsignedBigInteger('parcelle_id')->nullable()->after('proprietaire_id');
            $table->foreign('parcelle_id')->references('id')->on('parcelles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mouts', function (Blueprint $table) {
            $table->dropForeign(['parcelle_id']);
            $table->dropColumn('parcelle_id');
        });
    }
};
