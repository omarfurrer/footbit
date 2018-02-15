@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Venues
                    <a href="/admin/venues/create" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <colgroup>
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 25%;">
                            <col span="1" style="width: 25%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 10%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th class="text-center">Map</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venues as $venue)
                            <tr>
                                <td><img width="100" height="100" src="{{ asset('storage/'.$venue->image_path) }}" alt="..."></td>
                                <td>{{ $venue->name }}</td>
                                <td>{{ $venue->location }}</td>
                                <td class="text-center">
                                    <a target="_blank" href="{{ $venue->gmaps_url }}"><i class="fa fa-map-marker"></i></a>
                                </td>
                                <td>
                                    <a href="/admin/venues/{{ $venue->id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger" onclick="deleteModel(event,'delete-form-{{$venue->id}}', 'Are you sure you want to remove this venue from the list? All related venue data will be lost')">
                                        <i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <form id="delete-form-{{$venue->id}}" action="/admin/venues/{{ $venue->id }}" method="POST" style="display: none;">
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
