<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TournamentManagerService;
use App\Models\Tournament;
use App\Repositories\Eloquent\TournamentsRepositoryEloquent;

class TournamentsController extends Controller {

    /**
     * Tournament manager service.
     * 
     * @var TournamentManagerService 
     */
    public $tournamentManagerService;

    /**
     * Tournaments Repository.
     * 
     * @var TournamentsRepositoryEloquent 
     */
    public $tournamentsRepository;

    /**
     * @param TournamentManagerService $tournamentManagerService
     * @param TournamentsRepositoryEloquent $tournamentsRepository
     */
    public function __construct(TournamentManagerService $tournamentManagerService, TournamentsRepositoryEloquent $tournamentsRepository)
    {
        parent::__construct();
        $this->tournamentManagerService = $tournamentManagerService;
        $this->tournamentsRepository = $tournamentsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = $this->tournamentsRepository->orderBy('id', 'DESC')->all();

        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        $this->tournamentManagerService->load($tournament->id);

        $pastMatches = $this->tournamentManagerService->getMatches('past', 'starting_at');
        $presentMatches = $this->tournamentManagerService->getMatches('present', 'starting_at');
        $futureMatches = $this->tournamentManagerService->getMatches('future', 'starting_at');

        $diagram = $this->tournamentManagerService->getDiagramData();

        return view('tournaments.show', compact('tournament', 'pastMatches', 'presentMatches', 'futureMatches', 'diagram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
