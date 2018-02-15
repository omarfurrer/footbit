<form action="{{ isset($team)? '/admin/teams/'.$team->id : '/admin/teams' }}" method="POST">

    {{ csrf_field() }}

    @if(isset($team))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($team)? $team->name : '' }}">
        @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('moto') ? ' has-error' : '' }}">
        <label for="moto">Moto</label>
        <input type="text" class="form-control" name="moto" id="moto" placeholder="Moto" value="{{ isset($team)? $team->moto : '' }}">
        @if($errors->has('moto'))
        <p class="text-danger">{{ $errors->first('moto') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('coach_id') ? ' has-error' : '' }}">
        <label for="coach_id">Select Team Coach</label>
        <select id="coach_id" name="coach_id" class="form-control">
            <option value=""></option>
            @foreach($playersEligbleForCoach as $id => $userName)
            <option value="{{ $id }}" {{ isset($team)? ($team->coach->id == $id ? 'selected' : '' ):''  }}>{{ $userName }}</option>
            @endforeach
        </select>
        @if($errors->has('coach_id'))
        <p class="text-danger">{{ $errors->first('coach_id') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('players') ? ' has-error' : '' }}">
        <label for="players">Team Players</label>
        <select id="players" multiple="multiple" name="players[]" class="form-control">
            @foreach($playersEligbleForTeam as $id => $userName)
            <option value="{{ $id }}" {{ isset($team)? (in_array($id,$team->players()->pluck('players.id')->toArray()) ? 'selected' : '' ) : '' }}>{{ $userName }}</option>
            @endforeach
        </select>
        @if($errors->has('players'))
        <p class="text-danger">{{ $errors->first('players') }}</p>
        @endif
    </div>

    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>