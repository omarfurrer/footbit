<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTournamentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type');
            $table->integer('status')->default(0);
            $table->integer('round')->nullable();
            $table->integer('number_of_teams')->nullable();
            $table->integer('players_per_team')->nullable();
            $table->integer('fees_per_team')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->integer('first_prize')->nullable();
            $table->integer('second_prize')->nullable();
            $table->integer('third_prize')->nullable();
            $table->integer('default_match_time')->nullable();
            $table->integer('default_venue_id')->unsigned()->index();
            $table->foreign('default_venue_id')->references('id')->on('venues')->onDelete('cascade');
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
        Schema::dropIfExists('tournaments');
    }

}
