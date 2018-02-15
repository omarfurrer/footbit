<?php

namespace App\Entities;

use App\Entities\Venue;

class Tournament {

    /**
     * Name of the tournament.
     * 
     * @var String 
     */
    protected $name;

    /**
     * Type of the tournament.
     * IE : knockouts/round-robin/...
     * 
     * @var String 
     */
    protected $type;

    /**
     * Total number of teams playing in this tournament.
     * 
     * @var Integer 
     */
    protected $numberOfTeams;

    /**
     * Duration for each match in the tournament. (In seconds)
     * 
     * @var Integer 
     */
    protected $matchDuration;

    /**
     * Amount to be paid by each time as a fee for participating in the tournament.
     * 
     * @var Integer 
     */
    protected $feesPerTeam;

    /**
     * List of prizes for the tournament.
     * IE : 1st Prize => $prizes[0]
     * 
     * @var array 
     */
    protected $prizes;

    /**
     * Venue where the tournament will be played.
     * TODO : make class 
     * 
     * @var Venue 
     */
    protected $venue;

    /**
     * Array of teams playing in the tournament.
     * 
     * @var array 
     */
    protected $teams;

    /**
     * Constructor for initiating a completely new tournament.
     * 
     * @param String $name
     * @param String $type
     * @param Integer $numberOfTeams
     * @param Integer $matchDuration (in seconds)
     * @param Integer $feesPerTeam
     * @param array $prizes
     * @param Venue $venue
     */
    public function __construct($name, $type, $numberOfTeams, $matchDuration, $feesPerTeam, $prizes, Venue $venue)
    {
        $this->name = $name;
        $this->type = $type;
        $this->numberOfTeams = $numberOfTeams;
        $this->matchDuration = $matchDuration;
        $this->feesPerTeam = $feesPerTeam;
        $this->prizes = $prizes;
        $this->venue = $venue;
    }

}
