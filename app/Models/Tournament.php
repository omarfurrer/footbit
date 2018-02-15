<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tournaments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'status', 'round', 'number_of_teams', 'players_per_team', 'fees_per_team', 'min_age', 'max_age', 'first_prize',
        'second_prize', 'third_prize', 'default_match_time', 'default_venue_id'
    ];

    /**
     * The tournament has many teams.
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }

    /**
     * The tournament's venue.
     */
    public function venue()
    {
        return $this->belongsTo('App\Models\Venue', 'default_venue_id');
    }

}
