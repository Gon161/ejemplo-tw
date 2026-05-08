<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->string('sesion_id', 100)->nullable(); // para invitados sin cuenta
            $table->enum('estado', ['activo', 'abandonado', 'convertido'])->default('activo');
            $table->timestamps();

            $table->unique('usuario_id'); // un carrito activo por usuario
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
