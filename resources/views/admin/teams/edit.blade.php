@extends('layouts.admin')

@section('content')
<div class="container" id="admin-create-team">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Team</div>

                <div class="panel-body">
                    @include('admin.teams._form',['team'=>$team])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
