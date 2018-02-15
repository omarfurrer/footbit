<form action="{{ isset($player)? '/admin/players/'.$player->id : '/admin/players' }}" method="POST">

    {{ csrf_field() }}

    @if(isset($player))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        <label for="user_id">Select User to set as player</label>
        <select id="user_id" name="user_id" class="form-control">
            <option value=""></option>
            @foreach($nonPlayerUsers as $id => $userName)
            <option value="{{ $id }}">{{ $userName }}</option>
            @endforeach
        </select>
        @if($errors->has('user_id'))
        <p class="text-danger">{{ $errors->first('user_id') }}</p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>