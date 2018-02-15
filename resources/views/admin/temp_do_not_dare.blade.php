@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-12 text-center">
        <img class="img-rounded" src="/gifs/anon.gif">
        <!--<h1 class="text-center">YOU DO NOT DELETE THE DEVELOPER, {{ Auth()->user()->name }}</h1>-->
        <blockquote style="font-size: 20px;margin-top: 30px">
            <b>Introduce a little anarchy. Upset the established order, and everything becomes chaos. I'm an agent of chaos...!</b>
            <footer> The Joker - Heath Ledger</footer>
        </blockquote>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('html').delay(5000).fadeOut(400, function () {
            window.location.replace('../');
        })
    });
</script>
@endpush

