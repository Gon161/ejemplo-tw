<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 80);
            $table->string('apellido', 80);
            $table->string('correo', 100)->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->string('avatar')->nullable();
            $table->enum('rol', ['cliente', 'vendedor', 'admin'])->default('cliente');
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])->default('activo');
            $table->timestamp('correo_verificado_en')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
