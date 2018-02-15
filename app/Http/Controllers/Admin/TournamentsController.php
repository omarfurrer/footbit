<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\TournamentsRepositoryEloquent;
use App\Repositories\Eloquent\PlayersRepositoryEloquent;
use App\Repositories\Eloquent\VenuesRepositoryEloquent;
use App\Repositories\Eloquent\TeamsRepositoryEloquent;
use App\Http\Requests\Tournament\StoreTournamentRequest;
use App\Http\Requests\Tournament\UpdateTournamentRequest;
use App\Http\Requests\Tournament\UpdateTournamentTeamsRequest;
use App\Http\Requests\Tournament\UpdateTournamentScheduleRequest;
use App\Entities\TournamentTypes;
use App\Services\TournamentManagerService;

class TournamentsController extends Controller {

    /**
     * Tournaments Repository.
     * 
     * @var TournamentsRepositoryEloquent 
     */
    public $tournamentsRepository;

    /**
     * Players Repository.
     * 
     * @var PlayersRepositoryEloquent 
     */
    public $playersRepository;

    /**
     * Venues Repository.
     * 
     * @var VenuesRepositoryEloquent 
     */
    public $venuesRepository;

    /**
     * Teams Repository.
     * 
     * @var TeamsRepositoryEloquent 
     */
    public $teamsRepository;

    /**
     * Tournament manager service.
     * 
     * @var TournamentManagerService 
     */
    public $tournamentManagerService;

    /**
     * 
     * @param TournamentsRepositoryEloquent $tournamentsRepository
     * @param PlayersRepositoryEloquent $playersRepository
     * @param VenuesRepositoryEloquent $venuesRepository
     * @param TeamsRepositoryEloquent $teamsRepository
     * @param RefereesRepositoryEloquent $refereesRepository
     * @param TournamentManagerService $tournamentManagerService
     */
    public function __construct(TournamentsRepositoryEloquent $tournamentsRepository, PlayersRepositoryEloquent $playersRepository, VenuesRepositoryEloquent $venuesRepository,
            TeamsRepositoryEloquent $teamsRepository, TournamentManagerService $tournamentManagerService)
    {
        parent::__construct();
        $this->tournamentsRepository = $tournamentsRepository;
        $this->playersRepository = $playersRepository;
        $this->venuesRepository = $venuesRepository;
        $this->teamsRepository = $teamsRepository;
        $this->tournamentManagerService = $tournamentManagerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = $this->tournamentsRepository->orderBy('id', 'DESC')->all();
        return view('admin.tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TournamentTypes::lists();
        $venues = $this->venuesRepository->pluck('name', 'id');
        return view('admin.tournaments.create', compact('types', 'venues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTournamentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentRequest $request)
    {
        $data = $request->all();

        $tournament = $this->tournamentManagerService->create($data);

        if (!$tournament) {
            $errorMessages = $this->tournamentManagerService->getErrorMessages();
            \Session::flash('flash_message_error', $errorMessages);
            return redirect()->back()->withInput();
        }

        \Session::flash('flash_message_success', 'Tournament Created.');

        return redirect('/admin/tournaments/' . $tournament->id . '/teams/edit');
    }

    /**
     * Display a page to edit the tournament teams.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function editTeams(Tournament $tournament)
    {
        $teams = $this->teamsRepository->pluck('name', 'id');
        return view('admin.tournaments.editTeams', compact('tournament', 'teams'));
    }

    /**
     * Update the tournament teams.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function updateTeams(UpdateTournamentTeamsRequest $request, Tournament $tournament)
    {

        $this->tournamentManagerService->load($tournament->id);
        $tournament = $this->tournamentManagerService->updateTeams($request->teams);

        if (!$tournament) {
            $errorMessages = $this->tournamentManagerService->getErrorMessages();
            \Session::flash('flash_message_error', $errorMessages);
            return redirect()->back()->withInput();
        }

        \Session::flash('flash_message_success', 'Tournament teams updated.');
        return redirect('/admin/tournaments/' . $tournament->id . '/schedule/edit');
    }

    /**
     * Display a page to edit the tournament schedule.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function editSchedule(Tournament $tournament)
    {
        $this->tournamentManagerService->load($tournament->id);

        $matches = $this->tournamentManagerService->getMatchesForSchedule();
        $referees = $this->tournamentManagerService->getEligbleRefereesList();
        return view('admin.tournaments.editSchedule', compact('tournament', 'matches', 'referees'));
    }

    /**
     * Update the tournament schedule.
     *
     * @param  UpdateTournamentScheduleRequest $request
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule(UpdateTournamentScheduleRequest $request, Tournament $tournament)
    {

        $this->tournamentManagerService->load($tournament->id);

        $tournament = $this->tournamentManagerService->updateSchedule($request->matches);

        if (!$tournament) {
            $errorMessages = $this->tournamentManagerService->getErrorMessages();
            \Session::flash('flash_message_error', $errorMessages);
            return redirect()->back()->withInput();
        }

        \Session::flash('flash_message_success', 'Tournament schedule updated.');
        return redirect('/admin/tournaments');
    }

    /**
     * Randomize the teams for a specific tournament for first round.
     * 
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function getRandomizeFirstRoundTeams(Tournament $tournament)
    {
        $this->tournamentManagerService->load($tournament->id);

        $tournament = $this->tournamentManagerService->randomizeFirstRoundTeams();

        if (!$tournament) {
            $errorMessages = $this->tournamentManagerService->getErrorMessages();
            \Session::flash('flash_message_error', $errorMessages);
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Tournament teams randomized.');
        return redirect()->back();
    }

    public function getMatches(Tournament $tournament)
    {
        return view('admin.tournaments.matches');
    }

    /**
     * Display the specified resource.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        return view('admin.tournaments.show', compact('tournament'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $types = TournamentTypes::lists();
        $venues = $this->venuesRepository->pluck('name', 'id');

        return view('admin.tournaments.edit', compact('tournament', 'types', 'venues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTournamentRequest  $request
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentRequest $request, Tournament $tournament)
    {
        $this->tournamentManagerService->load($tournament->id);

        $tournament = $this->tournamentManagerService->update($request->all());

        if (!$tournament) {
            $errorMessages = $this->tournamentManagerService->getErrorMessages();
            \Session::flash('flash_message_error', $errorMessages);
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Tournament Updated.');

        return redirect('/admin/tournaments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        $this->tournamentsRepository->delete($tournament->id);

        \Session::flash('flash_message_success', 'Tournament Deleted.');

        return redirect('/admin/tournaments');
    }

}
