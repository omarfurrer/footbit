<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\TournamentsRepository;
use App\Models\Tournament;
use App\Validators\TournamentsValidator;
use Illuminate\Support\Collection;

/**
 * Class TournamentsRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TournamentsRepositoryEloquent extends BaseRepository implements TournamentsRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tournament::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Create new tournament.
     * 
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        return $model;
    }

    /**
     * Update a tournament.
     * 
     * @param array $attributes
     * @param Integer $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);

        if ($model) {
            if (isset($attributes['teams'])) {
                $model->teams()->sync($attributes['teams']);
            }
        }

        return $model;
    }

    /**
     * List ids of teams playing in the tournament.
     * 
     * @param Integer $id
     * @return array
     */
    public function listTeams($id)
    {
        return $this->find($id)->teams()->pluck('id');
    }

    /**
     * Get the teams of a tournament in a random order.
     * 
     * @param Integer $id
     * @return Collection
     */
    public function getTeamsInRandomOrder($id)
    {
        return $this->find($id)->teams()->inRandomOrder()->get();
    }

    /**
     * Get team IDs of a tournament in a random order.
     * 
     * @param Integer $id
     * @return array
     */
    public function listTeamsInRandomOrder($id)
    {
        return $this->getTeamsInRandomOrder($id)->pluck('id');
    }

    /**
     * Get the tournaments played by a specific player.
     * 
     * @param Integer $playerID
     * @return Collection
     */
    public function getTournamentsByPlayerID($playerID)
    {
        return $this->model->join('matches', 'tournaments.id', '=', 'matches.tournament_id')
                        ->join('teams',
                               function ($join) {
                            $join->on('matches.first_team_id', '=', 'teams.id')
                            ->orOn('matches.second_team_id', '=', 'teams.id');
                        })
                        ->join('player_team', 'teams.id', '=', 'player_team.team_id')
                        ->where('player_team.player_id', $playerID)
                        ->get(['tournaments.*']);
    }
    

}
