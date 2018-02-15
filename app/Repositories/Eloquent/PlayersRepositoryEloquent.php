<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PlayersRepository;
use App\Models\Player;
use App\Validators\PlayersValidator;

/**
 * Class PlayersRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PlayersRepositoryEloquent extends BaseRepository implements PlayersRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Player::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a random set of players.
     * 
     * @param Integer $numberOfRows
     */
    public function getRandom($numberOfRows = 10)
    {
        return $this->model->inRandomOrder()->limit($numberOfRows)->get();
    }

}
