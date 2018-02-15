<?php

namespace App\Http\Controllers\Admin;

use App\Models\Referee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\RefereesRepositoryEloquent;
use App\Repositories\Eloquent\UsersRepositoryEloquent;
use App\Http\Requests\Referee\StoreRefereeRequest;

class RefereesController extends Controller {

    /**
     * Referees Repository.
     * 
     * @var RefereesRepositoryEloquent 
     */
    public $refereesRepository;

    /**
     * Users Repository.
     * 
     * @var UsersRepositoryEloquent 
     */
    public $usersRepository;

    /**
     * 
     * @param RefereesRepositoryEloquent $refereesRepository
     * @param UsersRepositoryEloquent $usersRepository
     */
    public function __construct(RefereesRepositoryEloquent $refereesRepository, UsersRepositoryEloquent $usersRepository)
    {
        parent::__construct();
        $this->refereesRepository = $refereesRepository;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referees = $this->refereesRepository->orderBy('id', 'DESC')->all();
        return view('admin.referees.index', compact('referees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nonRefereeUsers = $this->usersRepository->listNonRefereeUsers();
        return view('admin.referees.create', compact('nonRefereeUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRefereeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRefereeRequest $request)
    {
        $referee = $this->refereesRepository->create($request->all());

        \Session::flash('flash_message_success', 'Referee Created.');

        return redirect('/admin/referees');
    }

    /**
     * Display the specified resource.
     *
     * @param  Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function show(Referee $referee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function edit(Referee $referee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referee $referee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Referee  $referee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referee $referee)
    {
        $this->refereesRepository->delete($referee->id);

        \Session::flash('flash_message_success', 'Referee Deleted.');

        return redirect('/admin/referees');
    }

}
