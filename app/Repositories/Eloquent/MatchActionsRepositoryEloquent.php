<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\MatchActionsRepository;
use App\Models\MatchAction;
use App\Validators\MatchActionsValidator;

/**
 * Class MatchActionsRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class MatchActionsRepositoryEloquent extends BaseRepository implements MatchActionsRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MatchAction::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    

}
