<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->restrictOnDelete();
            $table->foreignId('direccion_id')->constrained('direcciones')->restrictOnDelete();
            $table->string('numero_orden', 30)->unique(); // ORD-2026-000001
            $table->enum('estado', [
                'pendiente',
                'pagado',
                'preparando',
                'enviado',
                'entregado',
                'cancelado',
                'reembolsado',
            ])->default('pendiente');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('impuesto', 10, 2)->default(0);
            $table->decimal('envio', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->string('codigo_seguimiento', 100)->nullable();
            $table->text('notas')->nullable();
            $table->timestamp('pagado_en')->nullable();
            $table->timestamp('enviado_en')->nullable();
            $table->timestamp('entregado_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
