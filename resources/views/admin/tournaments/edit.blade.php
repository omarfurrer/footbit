@extends('layouts.admin')

@section('content')
<div class="container" id="admin-create-tournament">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Tournament
                    <span class="pull-right">
                        <a href="/admin/tournaments/{{ $tournament->id }}/teams/edit" class="btn btn-sm btn-success">Edit Teams</a>
                        <a href="/admin/tournaments/{{ $tournament->id }}/schedule/edit" class="btn btn-sm btn-success">Edit Schedule</a>
                    </span>
                </div>

                <div class="panel-body">
                    @include('admin.tournaments._form',['tournament'=>$tournament])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
