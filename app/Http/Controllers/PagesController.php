<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\MatchesRepositoryEloquent;
use App\Repositories\Eloquent\PlayersRepositoryEloquent;
use App\Repositories\Eloquent\RefereesRepositoryEloquent;
use App\Repositories\Eloquent\TeamsRepositoryEloquent;
use App\Repositories\Eloquent\TournamentsRepositoryEloquent;

class PagesController extends Controller {

    /**
     * Tournaments Repository.
     * 
     * @var TournamentsRepositoryEloquent 
     */
    public $tournamentsRepository;

    /**
     * Matches Repository.
     * 
     * @var MatchesRepositoryEloquent 
     */
    public $matchesRepository;

    /**
     * Players Repository.
     * 
     * @var PlayersRepositoryEloquent 
     */
    public $playersRepository;

    /**
     * Teams Repository.
     * 
     * @var TeamsRepositoryEloquent 
     */
    public $teamsRepository;

    /**
     * 
     * @param TournamentsRepositoryEloquent $tournamentsRepository
     * @param MatchesRepositoryEloquent $matchesRepository
     * @param PlayersRepositoryEloquent $playersRepository
     * @param TeamsRepositoryEloquent $teamsRepository
     * @param RefereesRepositoryEloquent $refereesRepository
     */
    public function __construct(TournamentsRepositoryEloquent $tournamentsRepository, MatchesRepositoryEloquent $matchesRepository, PlayersRepositoryEloquent $playersRepository,
            TeamsRepositoryEloquent $teamsRepository)
    {
        parent::__construct();
        $this->tournamentsRepository = $tournamentsRepository;
        $this->matchesRepository = $matchesRepository;
        $this->playersRepository = $playersRepository;
        $this->teamsRepository = $teamsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard()
    {
        $user = $this->authUser;
        $player = $user->player;
        $team = $player->teams()->first();
        $stats = [];
        $tournaments = $this->tournamentsRepository->getTournamentsByPlayerID($player->id);
        $matches = $this->matchesRepository->getFutureMatchesByPlayerID($player->id)->sortBy('starting_at');
        $upcomingMatch = $matches->first();
        return view('dashboard', compact('user', 'player', 'team', 'stats', 'tournaments', 'matches', 'upcomingMatch'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLanding()
    {
        return view('landing');
    }

}
