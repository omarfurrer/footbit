<form action="{{ isset($tournament)? '/admin/tournaments/'.$tournament->id : '/admin/tournaments' }}" method="POST">

    {{ csrf_field() }}

    @if(isset($tournament))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name',isset($tournament)? $tournament->name : '') }}">
        @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
        <label for="type">Type</label>
        <select id="type" name="type" class="form-control" {{ isset($tournament) ? 'disabled' : '' }}>
            <option value="">Choose Type</option>
            @foreach($types as $key => $name)
            <option value="{{ $key }}" {{  old('type') != NULL ? (old('type') == $key ? 'selected' : '' ) : (isset($tournament)? ($tournament->type == $key ? 'selected' : '') :'')   }}>{{ $name }}</option>
            @endforeach
        </select>
        @if($errors->has('type'))
        <p class="text-danger">{{ $errors->first('type') }}</p>
        @endif
    </div>




    <div class="form-group{{ $errors->has('default_venue_id') ? ' has-error' : '' }}">
        <label for="default_venue_id">Venue</label>
        <select id="default_venue_id" name="default_venue_id" class="form-control">
            <option value="">Choose Venue</option>
            @foreach($venues as $key => $name)
            <option value="{{ $key }}" {{ old('default_venue_id') != NULL ? (old('default_venue_id') == $key ? 'selected' : '' ) : (isset($tournament)? ($tournament->default_venue_id == $key ? 'selected' : '') :'')  }}>{{ $name }}</option>
            @endforeach
        </select>
        @if($errors->has('default_venue_id'))
        <p class="text-danger">{{ $errors->first('default_venue_id') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('number_of_teams') ? ' has-error' : '' }}">
        <label for="number_of_teams">Number of teams</label>
        <input type="number" min="0" class="form-control" name="number_of_teams" id="number_of_teams" placeholder="Number of teams" value="{{ old('number_of_teams',isset($tournament)? $tournament->number_of_teams : '') }}">
        @if($errors->has('number_of_teams'))
        <p class="text-danger">{{ $errors->first('number_of_teams') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('players_per_team') ? ' has-error' : '' }}">
        <label for="players_per_team">Players per team</label>
        <input type="number" min="0" class="form-control" name="players_per_team" id="players_per_team" placeholder="Players per team" value="{{ old('players_per_team',isset($tournament)? $tournament->players_per_team : '') }}">
        @if($errors->has('players_per_team'))
        <p class="text-danger">{{ $errors->first('players_per_team') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('fees_per_team') ? ' has-error' : '' }}">
        <label for="fees_per_team">Fees per team</label>
        <input type="number" min="0" class="form-control" name="fees_per_team" id="fees_per_team" placeholder="Fees per team" value="{{ old('fees_per_team',isset($tournament)? $tournament->fees_per_team : '') }}">
        @if($errors->has('fees_per_team'))
        <p class="text-danger">{{ $errors->first('fees_per_team') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('default_match_time') ? ' has-error' : '' }}">
        <label for="default_match_time">Default match time (in Minutes)</label>
        <input type="number" min="0" class="form-control" name="default_match_time" id="default_match_time" placeholder="Fees per team" value="{{ old('default_match_time',isset($tournament)? $tournament->default_match_time : '') }}">
        @if($errors->has('default_match_time'))
        <p class="text-danger">{{ $errors->first('default_match_time') }}</p>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4>Age Group</h4>
            <p>
                <small>Leave one blank to unset that bound. Leave both blank for any age group.</small>
            </p>
        </div>

        <div class="col-sm-6">
            <div class="form-group{{ $errors->has('min_age') ? ' has-error' : '' }}">
                <label for="min_age">Min</label>
                <input type="number" min="0" class="form-control" name="min_age" id="min_age" placeholder="Min age" value="{{ old('min_age',isset($tournament)? $tournament->min_age : '') }}">
                @if($errors->has('min_age'))
                <p class="text-danger">{{ $errors->first('min_age') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group{{ $errors->has('max_age') ? ' has-error' : '' }}">
                <label for="max_age">Max</label>
                <input type="number" min="0" class="form-control" name="max_age" id="max_age" placeholder="Max age" value="{{ old('max_age',isset($tournament)? $tournament->max_age : '') }}">
                @if($errors->has('max_age'))
                <p class="text-danger">{{ $errors->first('max_age') }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h4>Prizes</h4>
        </div>

        <div class="col-sm-4">
            <div class="form-group{{ $errors->has('first_prize') ? ' has-error' : '' }}">
                <label for="first_prize">First</label>
                <input type="number" min="0" class="form-control" name="first_prize" id="first_prize" placeholder="1st" value="{{ old('first_prize',isset($tournament)? $tournament->first_prize : '') }}">
                @if($errors->has('first_prize'))
                <p class="text-danger">{{ $errors->first('first_prize') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group{{ $errors->has('second_prize') ? ' has-error' : '' }}">
                <label for="second_prize">Second</label>
                <input type="number" min="0" class="form-control" name="second_prize" id="second_prize" placeholder="2nd" value="{{ old('second_prize',isset($tournament)? $tournament->second_prize : '') }}">
                @if($errors->has('second_prize'))
                <p class="text-danger">{{ $errors->first('second_prize') }}</p>
                @endif
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group{{ $errors->has('third_prize') ? ' has-error' : '' }}">
                <label for="third_prize">Third</label>
                <input type="number" min="0" class="form-control" name="third_prize" id="third_prize" placeholder="3rd" value="{{ old('third_prize',isset($tournament)? $tournament->third_prize : '') }}">
                @if($errors->has('third_prize'))
                <p class="text-danger">{{ $errors->first('third_prize') }}</p>
                @endif
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>
