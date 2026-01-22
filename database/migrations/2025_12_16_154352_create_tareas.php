<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id(); 
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            
            // ----------------------------------------------------
            //  DEFINIR LA COLUMNA DE LA CLAVE FORÁNEA
            // ----------------------------------------------------
            $table->bigInteger('categoria_id')->unsigned(); 
            
            // Campos de clasificación
            $table->enum('prioridad', ['Alta', 'Media', 'Baja']);

            // Campos de estado y fechas
            $table->boolean('es_urgente')->default(false);
            $table->boolean('esta_completada')->default(false);
            $table->date('fecha_limite')->nullable();
            $table->timestamp('recordar_en')->nullable(); 
                  
            $table->timestamps();
            
            // ----------------------------------------------------
            // EFINIR LA RESTRICCIÓN DE LA CLAVE FORÁNEA AL FINAL
            // ----------------------------------------------------
            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categorias')
                  ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};