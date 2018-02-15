<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\UsersRepository;
use App\Models\User;
use App\Validators\UsersValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Class UsersRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class UsersRepositoryEloquent extends BaseRepository implements UsersRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Override create method.
     * 
     * @param array $attributes
     */
    public function create(array $attributes)
    {
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }
        parent::create($attributes);
    }

    /**
     * Update a user.
     * 
     * @param array $attributes
     * @param Integer $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (isset($attributes['photo'])) {
            $model = $this->find($id);

            if (!$this->_deletePhoto($model)) {
                return false;
            }

            $photo = $attributes['photo'];
            $photoPath = $photo->store('img/users', 'public');
            $attributes = array_merge($attributes, ['photo_path' => $photoPath]);
        }
        return parent::update($attributes, $id);
    }

    /**
     * Return a list of [id,username] of users who are not players.
     * 
     * @return Collection
     */
    public function listNonPlayerUsers()
    {
        return $this->model->with('player')->whereDoesntHave('player')->pluck('username', 'id');
    }

    /**
     * Return a list of [id,username] of referees who are not referees.
     * 
     * @return Collection
     */
    public function listNonRefereeUsers()
    {
        return $this->model->with('referee')->whereDoesntHave('referee')->pluck('username', 'id');
    }

    /**
     * Get a random set of users.
     * 
     * @param Integer $numberOfRows
     */
    public function getRandom($numberOfRows = 10)
    {
        return $this->model->inRandomOrder()->limit($numberOfRows)->get();
    }

    /**
     * Delete a user.
     * 
     * @param Integer $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->find($id);

        if (!$this->_deletePhoto($model)) {
            return false;
        }

        return parent::delete($id);
    }

    protected function _deletePhoto(User $user)
    {
        if ($user->photo_path != NULL) {
            $photoName = explode('.', $user->photo_path)[0];
            //skip if default seeder photos are found
            if ($photoName > 0 && $photoName < 7) {
                return true;
            }
            $deleted = Storage::disk('public')->delete($user->photo_path);
            if (!$deleted) {
                return $deleted;
            }
        }
        return true;
    }

}
