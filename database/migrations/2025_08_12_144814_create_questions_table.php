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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_question_id')->nullable()->constrained('category_questions');
            $table->foreignId('form_section_id')->constrained('form_sections');
            $table->string('type_control');
            $table->longText('name');
            $table->text('message_error')->nullable();
            $table->integer('order');
            $table->boolean('is_required')->default(false);
            $table->text('description')->nullable();
            $table->decimal('weight', 8, 2);
            $table->bigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
