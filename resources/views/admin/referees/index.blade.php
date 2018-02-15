@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Referees
                    <a href="/admin/referees/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referees as $referee)
                            <tr>
                                <td><a href="/admin/users/{{ $referee->user->id }}/edit">{{ $referee->user->username }}</a></td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$referee->id}}', 'Are you sure you want to remove this referee from the list? All related referee data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$referee->id}}" action="/admin/referees/{{ $referee->id }}" method="POST" style="display: none;">
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
