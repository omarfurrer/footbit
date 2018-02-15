@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New User
                    <p>
                        <small>All users will be created with a default '123456' password.</small>
                    </p>
                </div>

                <div class="panel-body">
                    @include('admin.users._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
