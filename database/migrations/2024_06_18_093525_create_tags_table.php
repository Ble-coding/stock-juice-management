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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNull();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Assurez-vous que la colonne user_id est correctement définie
            $table->timestamps(); // Ajoute created_at et updated_at
            $table->softDeletes(); // Ajoute deleted_at pour les suppressions douces
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
