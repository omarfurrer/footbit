@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Players
                    <a href="/admin/players/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th># Teams</th>
                                <th># Teams Captain</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($players as $player)
                            <tr>
                                <td><a href="/admin/users/{{ $player->user->id }}/edit">{{ $player->user->username }}</a></td>
                                <td class="text-center"> {{ $player->teams()->count() }}  </td>
                                <td class="text-center"> {{ $player->coachingTeams()->count() }}  </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$player->id}}', 'Are you sure you want to remove this player from the list? All related player data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$player->id}}" action="/admin/players/{{ $player->id }}" method="POST" style="display: none;">
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
