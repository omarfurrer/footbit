<div class="match-list-item list-group-item row">
    <div class="col-sm-4">
        <b>{{ $match->firstTeam != NULL ? $match->firstTeam->name : 'TBA' }}</b> vs <b>{{ $match->secondTeam != NULL ? $match->secondTeam->name : 'TBA' }}</b>
    </div>
    <div class="col-sm-1">
        <b>Court : </b> {{$match->court != NULL ? $match->court : '-'}}
    </div>
    <div class="col-sm-2">
        <b>Duration : </b> {{$match->duration}}
    </div>
    <div class="col-sm-3">
        <b>Referee : </b> {{$match->referee != NULL ? $match->referee->user->name : '-'}}
    </div>
    <div class="col-sm-2">
        <b>Time : </b> {{$match->starting_at != NULL ? $match->starting_at->format('M j, Y g:i A') : ''}}
    </div>
</div>