<?php

namespace App\Http\Controllers\Admin;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\VenuesRepositoryEloquent;
use App\Http\Requests\Venue\StoreVenueRequest;
use App\Http\Requests\Venue\UpdateVenueRequest;

class VenuesController extends Controller {

    /**
     * Venues Repository.
     * 
     * @var VenuesRepositoryEloquent 
     */
    public $venuesRepository;

    /**
     * 
     * @param VenuesRepositoryEloquent $venuesRepository
     */
    public function __construct(VenuesRepositoryEloquent $venuesRepository)
    {
        parent::__construct();
        $this->venuesRepository = $venuesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $venues = $this->venuesRepository->orderBy('id', 'DESC')->all();
        return view('admin.venues.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.venues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVenueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = $this->venuesRepository->create($request->all());

        \Session::flash('flash_message_success', 'Venue Created.');

        return redirect('/admin/venues');
    }

    /**
     * Display the specified resource.
     *
     * @param  Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateVenueRequest  $request
     * @param  Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue = $this->venuesRepository->update($request->all(), $venue->id);

        if (!$venue) {
            \Session::flash('flash_message_error', 'Faield to update Venue.');
            return redirect()->back()->withInput();
        }

        \Session::flash('flash_message_success', 'Venue Updated.');
        return redirect('/admin/venues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {

        $this->venuesRepository->delete($venue->id);

        \Session::flash('flash_message_success', 'Venue Deleted.');

        return redirect('/admin/venues');
    }

}
