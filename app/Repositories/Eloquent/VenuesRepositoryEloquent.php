<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VenuesRepository;
use App\Models\Venue;
use App\Validators\VenuesValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Class VenuesRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VenuesRepositoryEloquent extends BaseRepository implements VenuesRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Venue::class;
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
        if (isset($attributes['image'])) {
            $image = $attributes['image'];
            $originalImageName = $image->getClientOriginalName();
            $imagePath = $image->store('img/venues', 'public');
            $attributes = array_merge($attributes, ['image_name' => $originalImageName, 'image_path' => $imagePath]);
        }
        return parent::create($attributes);
    }

    /**
     * Update a venue.
     * 
     * @param array $attributes
     * @param Integer $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        if (isset($attributes['image'])) {
            $model = $this->find($id);

            if (!$this->_deleteImage($model)) {
                return false;
            }

            $image = $attributes['image'];
            $originalImageName = $image->getClientOriginalName();
            $imagePath = $image->store('img/venues', 'public');
            $attributes = array_merge($attributes, ['image_name' => $originalImageName, 'image_path' => $imagePath]);
        }
        return parent::update($attributes, $id);
    }

    /**
     * Delete a venue.
     * 
     * @param Integer $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->find($id);

        if (!$this->_deleteImage($model)) {
            return false;
        }

        return parent::delete($id);
    }

    protected function _deleteImage(Venue $venue)
    {
        if ($venue->image_path != NULL) {
            $imageName = explode('.', $venue->image_path)[0];
            //skip if default seeder images are found
            if ($imageName > 0 && $imageName < 7) {
                return true;
            }
            $deleted = Storage::disk('public')->delete($venue->image_path);
            if (!$deleted) {
                return $deleted;
            }
        }
        return true;
    }

}
