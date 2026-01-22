<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Laravel leerá esto y ejecutará "CREATE TABLE users..." en MySQL
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken(); // Necesario para "recordar sesión"
            $table->timestamps();    // Crea 'created_at' y 'updated_at'
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};