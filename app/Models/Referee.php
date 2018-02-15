<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'referees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
