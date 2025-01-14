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
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('qte'); // Quantity column
            $table->unsignedBigInteger('product_id'); // Foreign key for product
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade'); // Foreign key constraint for product
            $table->unsignedBigInteger('commande_id'); // Foreign key for commande
            $table->foreign('commande_id')
                  ->references('id')
                  ->on('commandes')
                  ->onDelete('cascade'); // Foreign key constraint for commande
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ligne_commandes');
    }
};
