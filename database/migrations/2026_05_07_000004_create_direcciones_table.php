<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->foreignId('pais_id')->constrained('paises')->restrictOnDelete();
            $table->string('nombre_contacto', 100);
            $table->string('telefono_contacto', 20)->nullable();
            $table->string('calle', 200);
            $table->string('colonia', 100)->nullable();
            $table->string('ciudad', 100);
            $table->string('estado_provincia', 100);
            $table->string('codigo_postal', 20);
            $table->string('referencias', 255)->nullable();
            $table->boolean('es_predeterminada')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
