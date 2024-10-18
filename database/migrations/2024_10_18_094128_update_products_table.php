<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Supprimer les anciennes colonnes

            // Supprimer les anciennes colonnes
            $table->dropColumn(['name', 'description', 'price', 'stock_quantity']);

            // Ajouter les nouvelles colonnes
            $table->string('title');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('stock');
            $table->string('sku')->unique()->nullable(false); // Assurez-vous que sku ne soit pas nul
            $table->string('image')->nullable(); // Ajoute la colonne image
            // $table->unsignedBigInteger('user_id')->nullable()->after('id'); // Ajoute la colonne user_id
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Rétablir les anciennes colonnes
            $table->string('name')->notNull();
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->dropColumn(['title', 'regular_price', 'sale_price', 'stock', 'sku', 'image']); // Supprimer les nouvelles colonnes
        });
    }
}
