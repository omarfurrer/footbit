@extends('layouts.main')

@section('content')
<div class="container" id="dashboard">
    <div class="row">
        <div class="col-sm-4 mb-3">
            <!--            <div class="panel panel-default">
                            <div class="panel-heading">Dashboard</div>
                            <div class="panel-body">                  
                            </div>
                        </div>-->
            @include('_profile')
        </div>
        <div class="col-sm-8">
            @if($upcomingMatch)
            <div class="col-md-12 mb-3">
                <div class="card">
                    <h4 class="m-0">Your next <a href="{{ url('/tournaments/'.$upcomingMatch->tournament_id) }}">match</a> is on
                        <b>{{ $upcomingMatch->starting_at != NULL ? $upcomingMatch->starting_at->format('M j, Y g:i A') : 'TBA'  }}</b> with
                        <b>{{ $upcomingMatch->firstTeam->id == $team->id ? $upcomingMatch->secondTeam->name : $upcomingMatch->firstTeam->name }}</b></h4>
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <h4>My Stats</h4>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Goals','value'=>'46']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Blocks','value'=>'13']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Wins','value'=>'10']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Losses','value'=>'6']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Tournaments Won','value'=>'3']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Passes','value'=>'56']])
            </div>
            <div class="col-md-12">
                <h4>Team Stats</h4>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Goals','value'=>'46']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Blocks','value'=>'13']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Wins','value'=>'10']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Losses','value'=>'6']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Tournaments Won','value'=>'3']])
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                @include('_stat',['stat'=>['name'=>'Passes','value'=>'56']])
            </div>
        </div>
    </div>
</div>
@endsection
