<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'players';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The teams that the player is assigned to.
     */
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }

    /**
     * The teams where the player is a coach.
     */
    public function coachingTeams()
    {
        return $this->hasMany('App\Models\Team', 'coach_id');
    }

}
