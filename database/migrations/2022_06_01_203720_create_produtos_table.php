<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_subcategoria')->unsigned();
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias')->onDelete('cascade');
            $table->string('nome', 150);
            $table->string('slug', 150);
            $table->string('codigo', 150)->nullable();
            $table->decimal('valor', 12, 2)->nullable();
            $table->text('texto')->nullable();
            $table->string('foto', 150);
            $table->string('foto_thumb', 150);
            $table->integer('ordem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
