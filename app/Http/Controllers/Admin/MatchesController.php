<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Match;
use App\Services\MatchManagerService;
use App\Repositories\Eloquent\MatchesRepositoryEloquent;
use App\Repositories\Eloquent\VenuesRepositoryEloquent;
use App\Repositories\Eloquent\RefereesRepositoryEloquent;
use App\Repositories\Eloquent\TeamsRepositoryEloquent;
use App\Http\Requests\Match\StoreMatchRequest;
use Carbon\Carbon;

class MatchesController extends Controller {

    /**
     * Match manager service.
     * 
     * @var MatchManagerService 
     */
    public $matchManagerService;

    /**
     * Match manager service.
     * 
     * @var MatchesRepositoryEloquent 
     */
    public $matchesRepository;

    /**
     * Venues Repository.
     * 
     * @var VenuesRepositoryEloquent 
     */
    public $venuesRepository;

    /**
     * Referees Repository.
     * 
     * @var RefereesRepositoryEloquent 
     */
    public $refereesRepository;

    /**
     * Teams Repository.
     * 
     * @var TeamsRepositoryEloquent 
     */
    public $teamsRepository;

    /**
     * Default Constructor.
     * 
     * @param MatchManagerService $matchManagerService
     * @param MatchesRepositoryEloquent $matchesRepository
     * @param VenuesRepositoryEloquent $venuesRepository
     * @param RefereesRepositoryEloquent $refereesRepository
     * @param TeamsRepositoryEloquent $teamsRepository
     */
    public function __construct(MatchManagerService $matchManagerService, MatchesRepositoryEloquent $matchesRepository, VenuesRepositoryEloquent $venuesRepository
    , RefereesRepositoryEloquent $refereesRepository, TeamsRepositoryEloquent $teamsRepository)
    {
        parent::__construct();
        $this->matchManagerService = $matchManagerService;
        $this->matchesRepository = $matchesRepository;
        $this->venuesRepository = $venuesRepository;
        $this->refereesRepository = $refereesRepository;
        $this->teamsRepository = $teamsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $matches = $this->matchesRepository->orderBy('id', 'DESC')->all();
        return view('admin.matches.index', compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $venues = $this->venuesRepository->pluck('name', 'id');
        $referees = $this->refereesRepository->getList();
        $teams = $this->teamsRepository->getList();
        return view('admin.matches.create', compact('venues', 'referees', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchRequest $request)
    {
        $data = $request->all();
        //need to move to service
        // Handle match name if null
        if ($data['name'] == NULL) {
            $teamOne = $this->teamsRepository->find($data['first_team_id']);
            $teamTwo = $this->teamsRepository->find($data['second_team_id']);
            $data['name'] = $teamOne->name . ' vs ' . $teamTwo->name;
        }
        // handle date conversion
        $data['starting_at'] = Carbon::createFromFormat('M j, Y g:i A', $data['starting_at']);

        $match = $this->matchesRepository->create($data);

        if (!$match) {

            \Session::flash('flash_message_error', 'Error creating match.');
            return redirect()->back()->withInput();
        }

        \Session::flash('flash_message_success', 'Match Created.');

        return redirect('/admin/matches/' . $match->id . '/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Match $match
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match)
    {
        $venues = $this->venuesRepository->pluck('name', 'id');
        $referees = $this->refereesRepository->getList();
        $teams = $this->teamsRepository->getList();
        return view('admin.matches.edit', compact('match', 'venues', 'referees', 'teams'));
    }

    /**
     * Upload match result Excel.
     * 
     * @param Request $request
     * @param  Match $match
     */
    public function uploadResults(Request $request, Match $match)
    {
        $resultsExcel = $request->file('results_file');

        $actions = \Excel::selectSheets('Data Entry')->load($resultsExcel->getPathname(), function($reader) {
                    
                })->all();

        foreach ($actions as $action) {
            var_dump($action);
            // get each type
            // fill
            // check if all is null end
        }
//        dd($request->file('results_file'), $match);
    }

}
