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
        Schema::create('marcacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('oficina_id')->constrained()->onDelete('cascade');
            $table->dateTime('data');
            $table->enum('estado', ['pendente', 'em_execucao', 'concluido'])->default('pendente');
            $table->foreignId('mecanico_id')->nullable()->constrained('mecanicos')->onDelete('set null');
            $table->text('comentario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcacoes');
    }
};
