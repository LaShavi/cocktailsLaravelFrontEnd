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
        Schema::create('cocktails', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->unique(); // ID de la API TheCocktailDB
            $table->string('name'); // Nombre del cóctel
            $table->string('category')->nullable(); // Categoría
            $table->string('glass')->nullable(); // Tipo de vaso
            $table->text('instructions'); // Instrucciones
            $table->string('image_url')->nullable(); // URL de la imagen
            $table->json('ingredients')->nullable(); // Ingredientes en JSON
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuario
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocktails');
    }
};
