<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categorias')->restrictOnDelete();
            $table->string('nombre', 200);
            $table->string('slug', 220)->unique();
            $table->string('sku', 60)->unique();
            $table->text('descripcion')->nullable();
            $table->text('descripcion_corta')->nullable();
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_oferta', 10, 2)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->decimal('peso_kg', 8, 3)->nullable();
            $table->string('marca', 100)->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('destacado')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
