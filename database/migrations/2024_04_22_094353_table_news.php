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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('titre');
            $table->text('contenu');
            $table->foreignId('categorie_id')->references('id')->on('categories');
            $table->dateTime('date_debut');
            $table->dateTime('date_expiration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['categorie_id']);
        });
        Schema::dropIfExists('news');
    }
};
