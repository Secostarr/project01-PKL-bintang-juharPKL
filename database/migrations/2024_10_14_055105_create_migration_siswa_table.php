<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('migration_siswa', function (Blueprint $table) {
            $table->integer('id_siswa')->primary()->autoIncrement();

            $table->integer('id_pembimbing');
            $table->foreign('id_pembimbing')
                  ->references('id_pembimbing')
                  ->on('migration_pembimbing')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
 
            $table->char('nisn', 10)->unique();
            $table->string('password', 255);
            $table->string('nama_siswa', 25);
            $table->string('foto', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_siswa');
    }
};
