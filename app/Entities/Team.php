<?php

namespace App\Entities;

class Team {

    /**
     * Name of the team.
     * 
     * @var String 
     */
    protected $name;

    /**
     * Moto of the team.
     * 
     * @var String 
     */
    protected $moto;

    /**
     * Coach of the team
     * 
     * @var Coach 
     */
    protected $coach;

    /**
     * Team players.
     * 
     * @var array 
     */
    protected $players;

}
