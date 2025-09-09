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
        Schema::create('category_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->string('description',255)->nullable();
            $table->boolean('is_total_categories')->default(false);
            $table->boolean('is_scored')->default(true);
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
        Schema::dropIfExists('category_questions');
    }
};
