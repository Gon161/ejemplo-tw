<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resenias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->unsignedTinyInteger('calificacion'); // 1 a 5 estrellas
            $table->string('titulo', 150)->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('verificado')->default(false); // compra verificada
            $table->boolean('visible')->default(true);
            $table->timestamps();

            $table->unique(['producto_id', 'usuario_id']); // una resenia por usuario por producto
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resenias');
    }
};
