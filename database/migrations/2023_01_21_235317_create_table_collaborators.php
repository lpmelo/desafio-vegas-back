<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->string('id', 36);
            $table->string('clientName', 50);
            $table->string('cpf', 11);
            $table->date('admissionDate');
            $table->string('cep', 8);
            $table->string('uf', 2);
            $table->string("city", 50);
            $table->string("district", 50);
            $table->string("address", 50);
            $table->integer("number");
            $table->string("complement", 255);
            $table->string("occupation", 50);
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collaborators');
    }
};