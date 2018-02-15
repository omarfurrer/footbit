@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Teams
                    <a href="/admin/teams/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Moto</th>
                                <th>Coach</th>
                                <th># Players</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teams as $team)
                            <tr>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->moto }}</td>
                                <td>{{ $team->coach != NULL ? $team->coach->user->username : 'N/A' }}</td>
                                <td class="text-center">{{ $team->players()->count() }}</td>
                                <td>
                                    <a href="/admin/teams/{{ $team->id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$team->id}}', 'Are you sure you want to remove this team from the list? All related team data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$team->id}}" action="/admin/teams/{{ $team->id }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
