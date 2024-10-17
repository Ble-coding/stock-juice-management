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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('kyc_status')->nullable(); // Ajout du statut KYC
            $table->timestamp('last_login')->nullable(); // Ajout de la date de dernière connexion
            $table->timestamp('registered_at')->nullable(); // Ajout de la date d'enregistrement
            $table->string('code_customer')->unique(); // Ajout du code client unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('kyc_status'); // Suppression du statut KYC
            $table->dropColumn('last_login'); // Suppression de la date de dernière connexion
            $table->dropColumn('registered_at'); // Suppression de la date d'enregistrement
            $table->dropColumn('code_customer'); // Suppression du code client
        });
    }
};
