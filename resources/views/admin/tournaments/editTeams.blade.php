@extends('layouts.admin')

@section('content')
<div class="container" id="admin-edit-tournament-teams">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $tournament->name }} teams 
                    <span class="pull-right"><b>{{ $tournament->number_of_teams - $tournament->teams()->count() }}</b> free slots remaining</span>
                </div>

                <div class="panel-body">
                    <form action="/admin/tournaments/{{ $tournament->id }}/teams/update" method="POST">

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('teams') ? ' has-error' : '' }}">
                            <label for="teams">Teams</label>
                            <select id="teams" multiple="multiple" name="teams[]" class="form-control">
                                @foreach($teams as $id => $name)
                                <option value="{{ $id }}" {{ isset($tournament)? (in_array($id,$tournament->teams()->pluck('teams.id')->toArray()) ? 'selected' : '' ) : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('teams'))
                            <p class="text-danger">{{ $errors->first('teams') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
