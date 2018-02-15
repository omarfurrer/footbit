@extends('layouts.admin')

@section('content')
<div class="container" id="admin-edit-tournament-schedule">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $tournament->name }} schedule
                    <a href="/admin/tournaments/{{ $tournament->id }}/schedule/randomizeteams" class="btn btn-sm btn-success pull-right">Randomize First Round Teams</a>
                </div>

                <div class="panel-body">
                    <form action="/admin/tournaments/{{ $tournament->id }}/schedule/update" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        @if(!empty($matches))

                        @foreach($matches as $round => $matchGroup)

                        <h1>Round {{ $round }}</h1>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Team One</th>
                                    <th>Team Two</th>
                                    <th>On</th>
                                    <th>Court</th>
                                    <th>Referee</th>
<!--                                    <th>time</th>
                                    <th>venue</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($matchGroup as $match)
                                <tr>
                                    <td>
                                        <p class="form-control-static">{{ $match->name }}</p>
                                    </td>
                                    <td>
                                        <p class="form-control-static">{{ $match->first_team_id != NULL ? $match->firstTeam->name : 'TBA' }}</p>

                                    </td>
                                    <td>
                                        <p class="form-control-static">{{ $match->second_team_id != NULL ? $match->secondTeam->name : 'TBA' }}</p>

                                    </td>
                                    <td>
                                        <div class='input-group date'>
                                            <input 
                                                type='text' 
                                                class="form-control datetimepicker"  
                                                placeholder="date time" 
                                                name="matches[{{ $match->id }}][starting_at]"
                                                value="{{ old('matches.'.$match->id.'.starting_at', $match->starting_at != NULL ? $match->starting_at->format('M j, Y g:i A') : '' ) }}"
                                                >
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <input 
                                            type="number"
                                            class="form-control"
                                            placeholder="Venue court"
                                            name="matches[{{ $match->id }}][court]"
                                            value="{{ old('matches.'.$match->id.'.court', $match->court ) }}"
                                            >
                                    </td>
                                    <td>
                                        <select class="form-control match-content" name="matches[{{ $match->id }}][referee_id]">
                                            <option value="">Select referee</option>
                                            @foreach($referees as $id => $name)
                                            <option 
                                                value="{{ $id }}"
                                                {{ old('matches.'.$match->id.'.referee_id') != NULL ? (old('matches.'.$match->id.'.referee_id') == $id ? 'selected' : '' ) : (isset($match)? ($match->referee_id == $id ? 'selected' : '') :'')  }}
                                                >{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endforeach





                        @endif



                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function () {
//        $('.datetimepicker').datetimepicker({'format': 'llll'});
        $('.datetimepicker').datetimepicker({'format': 'LLL'});
    });
</script>
@endpush