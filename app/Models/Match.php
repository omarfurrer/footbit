<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'starting_at', 'duration', 'round', 'court', 'started', 'finished', 'has_results', 'referee_id', 'venue_id', 'first_team_id', 'second_team_id',
        'winner_team_id', 'loser_team_id', 'tournament_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'starting_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'started' => 'boolean',
        'finished' => 'boolean',
        'has_results' => 'boolean',
    ];

    /**
     * A match belongs to a first team.
     *
     * @return BelongsTo
     */
    public function firstTeam()
    {
        return $this->belongsTo('App\Models\Team', 'first_team_id');
    }

    /**
     * A match belongs to a first team.
     *
     * @return BelongsTo
     */
    public function secondTeam()
    {
        return $this->belongsTo('App\Models\Team', 'second_team_id');
    }

    /**
     * A match belongs to a team winner.
     *
     * @return BelongsTo
     */
    public function winnerTeam()
    {
        return $this->belongsTo('App\Models\Team', 'winner_team_id');
    }

    /**
     * A match belongs to a team loser.
     *
     * @return BelongsTo
     */
    public function looserTeam()
    {
        return $this->belongsTo('App\Models\Team', 'loser_team_id');
    }

    /**
     * A match belongs to a referee.
     *
     * @return BelongsTo
     */
    public function referee()
    {
        return $this->belongsTo('App\Models\Referee');
    }

}
