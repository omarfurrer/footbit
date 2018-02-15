<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'venues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'location', 'gmaps_url', 'image_name', 'image_path'];

}
