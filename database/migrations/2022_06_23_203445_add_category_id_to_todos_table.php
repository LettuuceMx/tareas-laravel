<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            // CREO MI CAMPO ID EN TODOS
            $table->bigInteger('category_id')->unsigned();
            // DESPUES REALIZO UNA RELACION ENTRE LA TABLA TODOS Y CATEGORIA
            // LA CUAL UNA CATEGORIA PUEDE TENER MUCHAS TAREAS | UNA TAREA PUEDE TENER UNA CATEGORIA
            // POR LO QUE LA RELACION ES DE 1 A MUCHOS
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            //
        });
    }
}
