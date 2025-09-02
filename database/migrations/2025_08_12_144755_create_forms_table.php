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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_form_id')->constrained('category_forms');
            $table->string('name',255);
            $table->string('description',255)->nullable();
            $table->boolean('status')->default(true); // Possible values: draft, published, archived
            $table->dateTime('published_at')->nullable();//fecha de publicación
            $table->dateTime('archived_at')->nullable();//fecha de archivo o finalizacion del formulario
            $table->integer('trieds')->nullable()->default(1);//intentos permitidos
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
        Schema::dropIfExists('forms');
    }
};
