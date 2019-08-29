<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJneListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jne_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('district_id');
            $table->integer('reg');
            $table->integer('oke');
            $table->string('etd_reg',30);
            $table->string('etd_oke',30);
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
        Schema::dropIfExists('jne_lists');
    }
}
