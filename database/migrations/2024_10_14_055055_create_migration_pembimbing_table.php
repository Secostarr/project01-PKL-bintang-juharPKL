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
        Schema::create('migration_pembimbing', function (Blueprint $table) {
            $table->integer('id_pembimbing')->primary()->autoIncrement();

            $table->integer('id_guru');
            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('migration_guru')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('id_dudi');
            $table->foreign('id_dudi')
                  ->references('id_dudi')
                  ->on('migration_dudi')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_pembimbing');
    }
};
