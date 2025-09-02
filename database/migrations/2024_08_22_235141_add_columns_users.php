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
        Schema::table('users', function (Blueprint $table) {
            $table->string('DNI',15)->default('')->after('id')->unique();
            $table->unsignedBigInteger('category_users_id')->nullable()->after('DNI');
            $table->foreign('category_users_id')->references('id')->on('category_users');
            $table->string('last_name')->default('')->after('name');
            $table->string('address')->default('');
            $table->string('city')->default('');
            $table->string('postal_code',6)->default('');
            $table->string('phone',15)->default('');
            $table->longText('image')->after('password')->nullable();
            $table->boolean('status')->default(true)->after('image');
            $table->boolean('is_admin')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
