@extends('layouts.admin')

@section('content')
<div class="container" id="admin-create-match">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Match</div>

                <div class="panel-body">
                    @include('admin.matches._form',['match'=>$match])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
