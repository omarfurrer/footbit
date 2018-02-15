<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\MatchesRepository;
use App\Models\Match;
use App\Validators\MatchesValidator;
use Illuminate\Support\Collection;
use Carbon\Carbon;

/**
 * Class MatchesRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MatchesRepositoryEloquent extends BaseRepository implements MatchesRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Match::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get matches for a specific tournament grouped by round.
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getTournamentMatchesGroupedByRound($tournamentID)
    {
        return $this->model->where('tournament_id', $tournamentID)->get()->groupBy('round');
    }

    /**
     * Return a list of matches by tournament and round.
     * 
     * @param Integer $tournamentID
     * @param Integer $round
     * @return Collection
     */
    public function getTournamentMatchesByRound($tournamentID, $round)
    {
        return $this->model->where('tournament_id', $tournamentID)->where('round', $round)->get();
    }

    /**
     * Return a list of matches by tournament.
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getTournamentMatches($tournamentID)
    {
        return $this->model->where('tournament_id', $tournamentID)->get();
    }

    /**
     * Return a list of matches player by a specific player.
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getMatchesByPlayerID($playerID)
    {
        return $this->model->join('teams',
                                  function ($join) {
                            $join->on('matches.first_team_id', '=', 'teams.id')
                            ->orOn('matches.second_team_id', '=', 'teams.id');
                        })
                        ->join('player_team', 'teams.id', '=', 'player_team.team_id')
                        ->where('player_team.player_id', $playerID)
                        ->get(['matches.*']);
    }

    /**
     * Return a list of matches player by a specific player in the past. 
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getPastMatchesByPlayerID($playerID)
    {
        $matches = $this->getMatchesByPlayerID($playerID);
        return $matches->filter(function($match) {
                    $match->finished;
                });
    }

    /**
     * Return a list of matches being played now by a specific player. 
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getPresentMatchesByPlayerID($playerID)
    {
        $matches = $this->getMatchesByPlayerID($playerID);
        return $matches->filter(function($match) {
                    return $match->started && !$match->finished;
                });
    }

    /**
     * Return a list of matches to be played in the future by a specific player. 
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getFutureMatchesByPlayerID($playerID)
    {
        $matches = $this->getMatchesByPlayerID($playerID);
        return $matches->filter(function($match) {
                    return $match->starting_at != NULL && $match->starting_at > Carbon::now() && !$match->started;
                });
    }

    /**
     * Return a list of matches to be played by a specific player 
     * and that their time has not been specified yet.. 
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getTbaMatchesByPlayerID($playerID)
    {
        $matches = $this->getMatchesByPlayerID($playerID);
        return $matches->filter(function($match) {
                    return $match->starting_at == NULL;
                });
    }

    /**
     * Return a list of matches tournament by a specific tournament in the past. 
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getPastMatchesByTournamentID($tournamentID)
    {
        $matches = $this->getTournamentMatches($tournamentID);
        return $matches->filter(function($match) {
                    $match->finished;
                });
    }

    /**
     * Return a list of matches being played now by a specific tournament. 
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getPresentMatchesByTournamentID($tournamentID)
    {
        $matches = $this->getTournamentMatches($tournamentID);
        return $matches->filter(function($match) {
                    return $match->started && !$match->finished;
                });
    }

    /**
     * Return a list of matches to be played in the future by a specific tournament. 
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getFutureMatchesByTournamentID($tournamentID)
    {
        $matches = $this->getTournamentMatches($tournamentID);
        return $matches->filter(function($match) {
                    return $match->starting_at != NULL && !$match->started;
                });
    }

    /**
     * Return a list of matches to be played by a specific tournament 
     * and that their time has not ben specified yet.. 
     * 
     * @param Integer $tournamentID
     * @return Collection
     */
    public function getTbaMatchesByTournamentID($tournamentID)
    {
        $matches = $this->getTournamentMatches($tournamentID);
        return $matches->filter(function($match) {
                    return $match->starting_at == NULL;
                });
    }

    /**
     * Delete all matches for a specific tournament.
     * 
     * @param Integer $tournamentID
     * @return Integer
     */
    public function deleteByTournamentID($tournamentID)
    {
        return $this->deleteWhere(['tournament_id' => $tournamentID]);
    }

}
