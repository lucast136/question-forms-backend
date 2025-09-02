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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('main_id');
            $table->unsignedBigInteger('category_user_id');
            $table->foreign('main_id')->references('id')->on('mains');
            $table->foreign('category_user_id')->references('id')->on('category_users');
            $table->boolean('access')->default(true);
            $table->string('permissions',800)->default('[]')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
