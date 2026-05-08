<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->string('codigo_iso', 3)->unique(); // MX, US, AR...
            $table->string('prefijo_telefono', 10)->nullable(); // +52, +1...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paises');
    }
};
