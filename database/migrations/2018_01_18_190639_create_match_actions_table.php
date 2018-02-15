<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchActionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_actions',
                       function (Blueprint $table) {
            $table->increments('id');
            // PASSES
            $table->boolean('pass')->default(0);
            $table->string('pass_type')->nullable();
            $table->string('pass_situation')->nullable();
            $table->string('pass_body_part')->nullable();
            $table->integer('pass_success_player_id')->unsigned()->index();
            $table->foreign('pass_success_player_id')->references('id')->on('players')->onDelete('cascade');
            $table->boolean('pass_failure_out')->default(0);
            $table->integer('pass_failure_interception_opponent_id')->unsigned()->index();
            $table->foreign('pass_failure_interception_opponent_id')->references('id')->on('players')->onDelete('cascade');
            $table->string('pass_failure_interception_result')->nullable();
            // ONE ON ONES
            $table->boolean('one_on_one')->default(0);
            $table->integer('one_on_one_player_id')->unsigned()->index();
            $table->foreign('one_on_one_player_id')->references('id')->on('players')->onDelete('cascade');
            $table->string('one_on_one_result')->nullable();
            $table->string('one_on_one_card')->nullable();
            $table->integer('one_on_one_action_id')->unsigned()->index();
            $table->foreign('one_on_one_action_id')->references('id')->on('players')->onDelete('cascade');
            // SHOTS
            $table->boolean('shot')->default(0);
            $table->string('shot_zone')->nullable();
            $table->string('shot_situation')->nullable();
            $table->string('shot_accuracy_type')->nullable();
            $table->string('shot_accuracy_result')->nullable();
            $table->string('shot_accuracy_role')->nullable();
            $table->integer('shot_accuracy_player_id')->unsigned()->index();
            $table->foreign('shot_accuracy_player_id')->references('id')->on('players')->onDelete('cascade');
            $table->string('shot_body_part')->nullable();
            $table->integer('shot_assisted_player_id')->unsigned()->index();
            $table->foreign('shot_assisted_player_id')->references('id')->on('players')->onDelete('cascade');
            // SPECIAL SKILLS
            $table->boolean('special_skill')->default(0);
            $table->integer('special_skill_player_id')->unsigned()->index();
            $table->foreign('special_skill_player_id')->references('id')->on('players')->onDelete('cascade');
            $table->string('special_skill_skill')->nullable(); // ??????????????????????????????????????????
            $table->string('special_skill_result')->nullable();
            
            $table->integer('player_id')->unsigned()->index();
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            
            $table->integer('match_id')->unsigned()->index();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            
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
        Schema::dropIfExists('match_actions');
    }

}
