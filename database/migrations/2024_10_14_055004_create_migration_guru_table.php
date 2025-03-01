<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('migration_guru', function (Blueprint $table) {
            $table->integer('id_guru')->primary()->autoIncrement();
            $table->char('nip', 18)->unique();
            $table->string('email', 25);
            $table->string('password', 255);
            $table->string('nama_guru', 25);
            $table->string('foto', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_guru');
    }
};
