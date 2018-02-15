@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Matches
                    <a href="/admin/matches/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Teams</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($matches as $match)
                            <tr>
                                <td><a href="/admin/matches/{{ $match->id }}/edit">{{ $match->firstTeam != NULL ? $match->firstTeam->name : 'TBA' }} vs {{ $match->firstTeam != NULL ? $match->secondTeam->name : 'TBA' }}</a></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$match->id}}', 'Are you sure you want to remove this match from the list? All related match data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$match->id}}" action="/admin/matches/{{ $match->id }}" method="POST" style="display: none;">
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
