<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("keywords");
            $table->text("description");
            $table->string("facebook", 150);
            $table->string("instagram", 150);
            $table->string("whatsapp", 150);
            $table->string("email", 150);
            $table->string("telefone", 150);
            $table->text("endereco");
            $table->string("mapa", 500);
            $table->text("codigos_terceiros")->nullable();
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
        Schema::dropIfExists('site');
    }
}
