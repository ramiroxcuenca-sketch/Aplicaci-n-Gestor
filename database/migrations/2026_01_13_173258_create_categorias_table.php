<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('categorias', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
    });

    // Agregamos la columna a 'tareas' aquí mismo para no hacer 2 archivos
    Schema::table('tareas', function (Blueprint $table) {
        $table->foreignId('categoria_id')->nullable()->constrained('categorias');
    });
}
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
