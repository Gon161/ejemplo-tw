<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_padre_id')
                  ->nullable()
                  ->constrained('categorias')
                  ->nullOnDelete();
            $table->string('nombre', 100);
            $table->string('slug', 120)->unique();
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('activo')->default(true);
            $table->unsignedTinyInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
