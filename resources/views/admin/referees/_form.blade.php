<form action="{{ isset($referee)? '/admin/referees/'.$referee->id : '/admin/referees' }}" method="POST">

    {{ csrf_field() }}

    @if(isset($referee))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
        <label for="user_id">Select User to set as referee</label>
        <select id="user_id" name="user_id" class="form-control">
            <option value=""></option>
            @foreach($nonRefereeUsers as $id => $userName)
            <option value="{{ $id }}">{{ $userName }}</option>
            @endforeach
        </select>
        @if($errors->has('user_id'))
        <p class="text-danger">{{ $errors->first('user_id') }}</p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>