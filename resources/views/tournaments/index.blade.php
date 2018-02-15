@extends('layouts.main')

@section('content')
<div id="index-tournaments">
    <div class="container">

        <div class="page-header">
            <h3>Showing <b>{{ $tournaments->count() }}</b> tournaments</h3>
            <!--<h3><small>Showing <b>{{ $tournaments->count() }}</b> tournaments</small></h3>-->
        </div>

        <!--Details Panel-->
        <div class="row">
            <div class="col-sm-12">
                <div class="list-group">
                    @foreach($tournaments as $tournament)
                    @include('tournaments._tournament',['tournament' => $tournament])
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush
