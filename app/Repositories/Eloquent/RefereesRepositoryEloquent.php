<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\RefereesRepository;
use App\Models\Referee;
use App\Validators\RefereesValidator;
use Illuminate\Support\Collection;

/**
 * Class RefereesRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RefereesRepositoryEloquent extends BaseRepository implements RefereesRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Referee::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Get a list for dropdown with [referees.id => user.name]
     * 
     * @return array
     */
    public function getList()
    {
        return $this->model->with('user')->get()->pluck('user.name', 'id');
    }

}
