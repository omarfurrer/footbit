@extends('layouts.admin')

@section('content')
<div class="container" id="admin-create-venue">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Venue</div>

                <div class="panel-body">
                    @include('admin.venues._form',['venue'=>$venue])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
