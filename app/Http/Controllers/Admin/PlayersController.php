<?php

namespace App\Http\Controllers\Admin;

use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\PlayersRepositoryEloquent;
use App\Repositories\Eloquent\UsersRepositoryEloquent;
use App\Http\Requests\Player\StorePlayerRequest;

class PlayersController extends Controller {

    /**
     * Players Repository.
     * 
     * @var PlayersRepositoryEloquent 
     */
    public $playersRepository;

    /**
     * Users Repository.
     * 
     * @var UsersRepositoryEloquent 
     */
    public $usersRepository;

    /**
     * 
     * @param PlayersRepositoryEloquent $playersRepository
     * @param UsersRepositoryEloquent $usersRepository
     */
    public function __construct(PlayersRepositoryEloquent $playersRepository, UsersRepositoryEloquent $usersRepository)
    {
        parent::__construct();
        $this->playersRepository = $playersRepository;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $players = $this->playersRepository->orderBy('id', 'DESC')->all();
        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nonPlayerUsers = $this->usersRepository->listNonPlayerUsers();
        return view('admin.players.create', compact('nonPlayerUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePlayerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerRequest $request)
    {
        $player = $this->playersRepository->create($request->all());

        \Session::flash('flash_message_success', 'Player Created.');

        return redirect('/admin/players');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {

        return view('admin.players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $this->playersRepository->delete($player->id);

        \Session::flash('flash_message_success', 'Player Deleted.');

        return redirect('/admin/players');
    }

}
