@extends('layouts.main')

@section('content')
<div id="show-tournament">
    <div class="container">

        <!--Title-->
        <div class="row">
            <div class="col-sm-12 text-center">
                <h1>{{ $tournament->name }}</h1>
                <span class="badge mb-1">@tournamentstatus($tournament->status)</span>
            </div>
        </div>

        <!--Details Panel-->
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h3>{{ $tournament->players_per_team }} a-side @tournamenttype($tournament->type) round</h3>
                            <h3>{{ $tournament->number_of_teams }} Teams</h3>
                            <h3>@tournamentagegroup( $tournament->min_age , $tournament->max_age )</h3>
                            <h3>{{ $tournament->fees_per_team }} EGP / Team</h3>
                        </div>
                        <div class="col-md-4 text-center">
                            <h3>Prizes</h3>
                            <h4>1st : {{ $tournament->first_prize }}</h4>
                            <h4>2nd : {{ $tournament->second_prize }}</h4>
                            @if(!empty($tournament->third_prize))
                            <h4>3rd : {{ $tournament->third_prize }}</h4>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div id="venue-details" style="background-image: url({{ asset('storage/'.$tournament->venue->image_path) }})">
                                <h4>{{ $tournament->venue->name }}</h4>
                                <h4>{{ $tournament->venue->location }}</h4>
                                <h4><a target="_blank" href="{{ $tournament->venue->gmaps_url }}">View location on map</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-sm-12">


                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#future-matches" aria-controls="upcoming matches" role="tab" data-toggle="tab">Upcoming</a></li>
                    <li role="presentation"><a href="#past-matches" aria-controls="past matches" role="tab" data-toggle="tab">Past</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="future-matches">
                        @if(!$futureMatches->isEmpty())
                        <ul class="list-group">
                            @foreach($futureMatches as $match)
                            @include('_match-list-item',['match' => $match])
                            @endforeach
                        </ul>
                        @else
                        <p>Waiting for matches</p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane" id="past-matches">
                        @if(!$pastMatches->isEmpty())
                        <ul class="list-group">
                            @foreach($pastMatches as $match)
                            @include('_match-list-item',['match' => $match])
                            @endforeach
                        </ul>
                        @else
                        <p>Waiting for matches</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div id="bracket">

                </div>
            </div>
        </div>
    </div>


</div>
</div>
@endsection

@push('scripts')
<script>
    console.log('hi');
    var minimalData = {
    teams: {!! json_encode($diagram['teams']) !!},
            results: [
            // [[1, 2], [3, 4]],
            // [[4, 6], [2, 1]]        
            ]
    }

    $(function () {
    $('#bracket').bracket({
    init: minimalData,
            teamWidth: 150,
            scoreWidth: 50,
            matchMargin: 40,
            roundMargin: 60
    })
    })
</script>
@endpush
