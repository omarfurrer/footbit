<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\TeamsRepositoryEloquent;
use App\Repositories\Eloquent\PlayersRepositoryEloquent;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;

class TeamsController extends Controller {

    /**
     * Teams Repository.
     * 
     * @var TeamsRepositoryEloquent 
     */
    public $teamsRepository;

    /**
     * Players Repository.
     * 
     * @var PlayersRepositoryEloquent 
     */
    public $playersRepository;

    /**
     * 
     * @param TeamsRepositoryEloquent $teamsRepository
     * @param PlayersRepositoryEloquent $playersRepository
     */
    public function __construct(TeamsRepositoryEloquent $teamsRepository, PlayersRepositoryEloquent $playersRepository)
    {
        parent::__construct();
        $this->teamsRepository = $teamsRepository;
        $this->playersRepository = $playersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = $this->teamsRepository->orderBy('id', 'DESC')->all();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $playersEligbleForCoach = $this->playersRepository->with('user')->all()->pluck('user.username', 'id');
        $playersEligbleForTeam = $this->playersRepository->with('user')->all()->pluck('user.username', 'id');
        return view('admin.teams.create', compact('playersEligbleForCoach', 'playersEligbleForTeam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $team = $this->teamsRepository->create($request->all());

        \Session::flash('flash_message_success', 'Team Created.');

        return redirect('/admin/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $playersEligbleForCoach = $this->playersRepository->with('user')->all()->pluck('user.username', 'id');
        $playersEligbleForTeam = $this->playersRepository->with('user')->all()->pluck('user.username', 'id');
        return view('admin.teams.edit', compact('playersEligbleForCoach', 'playersEligbleForTeam', 'team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTeamRequest  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team = $this->teamsRepository->update($request->all(), $team->id);

        \Session::flash('flash_message_success', 'Team Updated.');

        return redirect('/admin/teams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $this->teamsRepository->delete($team->id);

        \Session::flash('flash_message_success', 'Team Deleted.');

        return redirect('/admin/teams');
    }

}
