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
        schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->constrained('category')->cascadeOnDelete(); // Chave estrangeira para a tabela de categorias
            $table->unsignedInteger('quantity')->default(0); // unsignedInteger para não ter quantidade negativa de produtos
            $table->unsignedInteger('minimum_stock')->default(0); // Estoque mínimo do produto
            $table->string('image')->nullable(); // Campo para armazenar o caminho da imagem do produto

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Remover a tabela de produtos
    }
};
