<a href="/tournaments/{{ $tournament->id }}" class="list-group-item">
    <h4 class="list-group-item-heading">{{ $tournament->name }}
        <span class="badge ml-1">@tournamentstatus($tournament->status)
            @if($tournament->round != NULL)
            - Round {{ $tournament->round }}
            @endif
        </span>
    </h4>
    <div id="tournament-details" class="row mt-3 mb-1">
        <div class="col-sm-3">
            <p class="list-group-item-text"><b>Type</b> {{ $tournament->players_per_team }} a-side @tournamenttype($tournament->type) round</p>
        </div>
        <div class="col-sm-3">
            <p class="list-group-item-text"><b>Teams</b> {{ $tournament->number_of_teams }} </p>
        </div>
        <div class="col-sm-3">
            <p class="list-group-item-text"><b>Age Group</b> @tournamentagegroup( $tournament->min_age , $tournament->max_age )</p>
        </div>
        <div class="col-sm-3">
            <p class="list-group-item-text"><b>Fees</b> {{ $tournament->fees_per_team }} EGP / Team</p>
        </div>
    </div>
</a>