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
        Schema::create('score_norms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_question_id')->constrained('category_questions');
            $table->foreignId('category_form_id')->constrained('category_forms');
            $table->string('name', 150);
            $table->longText('description')->nullable();
            $table->integer('min_score')->default(0);
            $table->integer('max_score')->default(0);
            $table->string('html_color',20)->nullable();
            $table->integer('invalidation_score')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_norms');
    }
};
