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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_option_id')->constrained('question_options');
            $table->foreignId('client_id')->constrained('clients');
            $table->bigInteger('user_id_qualifier')->nullable(); // Usuario que califica
            $table->float('qualified_score')->nullable(); // Puntaje calificado manualmente
            $table->float('score_auto')->nullable(); // Puntaje automático
            $table->ipAddress('ip_client')->nullable(); // IP del cliente
            $table->longText('answer_value')->nullable(); // respuesta en caso sea texto
            $table->longText('observation')->nullable(); // Observaciones
            $table->integer('tried')->nullable(); // intento de respuestas
            $table->bigInteger('user_id')->nullable(); // Usuario que crea la respuesta
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
