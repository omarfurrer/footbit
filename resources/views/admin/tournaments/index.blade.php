@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tournaments
                    <a href="/admin/tournaments/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Round</th>
                                <th>#Teams</th>
                                <th>Players/T</th>
                                <th>Fees</th>
                                <th>Age group</th>
                                <th>Match time</th>
                                <th>Venue</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tournaments as $tournament)
                            <tr>
                                <td>{{ $tournament->name }}</td>
                                <td>@tournamenttype($tournament->type)</td>
                                <td>@tournamentstatus($tournament->status)</td>
                                <td>{{ $tournament->round == NULL ? 'N/A' : $tournament->round }}</td>
                                <td>{{ $tournament->number_of_teams }}</td>
                                <td>{{ $tournament->players_per_team }}</td>
                                <td>{{ $tournament->fees_per_team }}</td>
                                <td>@tournamentagegroup( $tournament->min_age , $tournament->max_age )</td>
                                <td>{{ $tournament->default_match_time }}</td>
                                <td>{{ $tournament->venue->name }}</td>
                                <td>
                                    <a href="/admin/tournaments/{{ $tournament->id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$tournament->id}}', 'Are you sure you want to remove this tournament from the list? All related tournament data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$tournament->id}}" action="/admin/tournaments/{{ $tournament->id }}" method="POST" style="display: none;">
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
