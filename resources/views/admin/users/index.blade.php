@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users
                    <a href="/admin/users/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Date Of Birth</th>
                                <th>Phone Number</th>
                                <th>Player</th>
                                <th>Referee</th>
                                <th>Admin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->date_of_birth != NULL ? $user->date_of_birth->toFormattedDateString() : '-' }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td class="text-center"><i class="fa {{$user->player != NULL ? 'fa-check-circle text-primary' : 'fa-times-circle text-danger'}}" aria-hidden="true"></i></td>
                                <td class="text-center"><i class="fa {{$user->referee != NULL ? 'fa-check-circle text-primary' : 'fa-times-circle text-danger'}}" aria-hidden="true"></i></td>
                                <td class="text-center"><i class="fa {{$user->is_admin ? 'fa-check-circle text-primary' : 'fa-times-circle text-danger'}}" aria-hidden="true"></i></td>
                                <td>
                                    <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="return deleteModel(event,'delete-form-{{$user->id}}', 'Are you sure you want to delete this user ? All related data will be lost');">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$user->id}}" action="/admin/users/{{ $user->id }}" method="POST" style="display: none;">
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

