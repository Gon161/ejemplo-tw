<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_id')->constrained('ordenes')->cascadeOnDelete();
            $table->enum('metodo', ['tarjeta', 'paypal', 'transferencia', 'efectivo', 'criptomoneda']);
            $table->enum('estado', ['pendiente', 'completado', 'fallido', 'reembolsado'])->default('pendiente');
            $table->decimal('monto', 10, 2);
            $table->string('moneda', 3)->default('MXN');
            $table->string('referencia_externa', 150)->nullable(); // ID de Stripe, PayPal, etc.
            $table->json('metadata')->nullable(); // respuesta cruda del gateway
            $table->timestamp('procesado_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
