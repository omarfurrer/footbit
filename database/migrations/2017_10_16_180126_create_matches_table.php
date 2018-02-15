<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches',
                       function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('starting_at')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('round')->nullable();
            $table->integer('court')->nullable();
            $table->integer('started')->default(0);
            $table->integer('finished')->default(0);
            $table->integer('has_results')->default(0);
            $table->integer('referee_id')->unsigned()->index()->nullable();
            $table->foreign('referee_id')->references('id')->on('referees')->onDelete('cascade');
            $table->integer('venue_id')->unsigned()->index()->nullable();
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->integer('first_team_id')->unsigned()->index()->nullable();
            $table->foreign('first_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('second_team_id')->unsigned()->index()->nullable();
            $table->foreign('second_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('winner_team_id')->unsigned()->index()->nullable();
            $table->foreign('winner_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('loser_team_id')->unsigned()->index()->nullable();
            $table->foreign('loser_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('tournament_id')->unsigned()->index()->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
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
        Schema::dropIfExists('matches');
    }

}
