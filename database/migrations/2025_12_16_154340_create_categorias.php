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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // BIGINT, Primary Key
            $table->string('nombre', 50)->unique();
            $table->timestamps(); // creado_en y actualizado_en
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
