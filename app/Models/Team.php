<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'moto', 'coach_id'
    ];

    /**
     * The players that the team has.
     */
    public function players()
    {
        return $this->belongsToMany('App\Models\Player');
    }

    /**
     * The team's coach.
     */
    public function coach()
    {
        return $this->belongsTo('App\Models\Player','coach_id');
    }

}
