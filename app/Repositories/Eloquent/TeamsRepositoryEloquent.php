<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\TeamsRepository;
use App\Models\Team;
use App\Validators\TeamsValidator;
use Illuminate\Support\Collection;

/**
 * Class TeamsRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TeamsRepositoryEloquent extends BaseRepository implements TeamsRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Team::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Create new team.
     * 
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        if ($model) {
            if (isset($attributes['players'])) {
                $model->players()->sync($attributes['players']);
            }
        }

        return $model;
    }

    /**
     * Update a team.
     * 
     * @param array $attributes
     * @param Integer $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);

        if ($model) {
            if (isset($attributes['players'])) {
                $model->players()->sync($attributes['players']);
            }
        }

        return $model;
    }

    /**
     * Get a list for dropdown with [teams.id => teams.name]
     * 
     * @return array
     */
    public function getList()
    {
        return $this->model->get()->pluck('name', 'id');
    }

}
