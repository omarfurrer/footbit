<div class="row">
    <div class="col-sm-12">


        <form action="{{ isset($match)? '/admin/matches/'.$match->id : '/admin/matches'  }}" method="POST">

            {{ csrf_field() }}

            @if(isset($match))
            {{ method_field('PATCH') }}
            @endif

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label> <small>Optional, will be set to "team1 vs team2" if left empty.</small>            
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($match)? $match->name : '' }}">
                        @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('referee_id') ? ' has-error' : '' }}">
                        <label for="referee_id">Referee</label>
                        <select id="referee_id" name="referee_id" class="form-control">
                            <option value="">Choose Referee</option>
                            @foreach($referees as $key => $name)
                            <option value="{{ $key }}" {{ old('referee_id') != NULL ? (old('referee_id') == $key ? 'selected' : '' ) : (isset($match)? ($match->referee_id == $key ? 'selected' : '') :'')  }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('referee_id'))
                        <p class="text-danger">{{ $errors->first('referee_id') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('starting_at') ? ' has-error' : '' }}">
                        <label for="starting_at">Starting Time</label>            
                        <input type="text" class="form-control datetimepicker"  placeholder="January 21, 2018 3:30 PM" name="starting_at"
                               value="{{ old('starting_at', isset($match)? ($match->starting_at != NULL ? $match->starting_at->format('M j, Y g:i A') : '') : '' ) }}">
                        @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('starting_at') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                        <label for="duration">Duration (in Minutes)</label>
                        <input type="number" min="0" class="form-control" name="duration" id="duration" placeholder="15" value="{{ old('duration',isset($match)? $match->duration : '') }}">
                        @if($errors->has('duration'))
                        <p class="text-danger">{{ $errors->first('duration') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('venue_id') ? ' has-error' : '' }}">
                        <label for="venue_id">Venue</label>
                        <select id="venue_id" name="venue_id" class="form-control">
                            <option value="">Choose Venue</option>
                            @foreach($venues as $key => $name)
                            <option value="{{ $key }}" {{ old('venue_id') != NULL ? (old('venue_id') == $key ? 'selected' : '' ) : (isset($match)? ($match->venue_id == $key ? 'selected' : '') :'')  }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('venue_id'))
                        <p class="text-danger">{{ $errors->first('venue_id') }}</p>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('court') ? ' has-error' : '' }}">
                        <label for="court">Court</label>
                        <input type="number" min="0" class="form-control" name="court" id="court" placeholder="3" value="{{ old('court',isset($match)? $match->court : '') }}">
                        @if($errors->has('court'))
                        <p class="text-danger">{{ $errors->first('court') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('first_team_id') ? ' has-error' : '' }}">
                        <label for="first_team_id">Team 1</label>
                        <select id="first_team_id" name="first_team_id" class="form-control">
                            <option value="">Choose Team 1</option>
                            @foreach($teams as $key => $name)
                            <option value="{{ $key }}" {{ old('first_team_id') != NULL ? (old('first_team_id') == $key ? 'selected' : '' ) : (isset($match)? ($match->first_team_id == $key ? 'selected' : '') :'')  }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('first_team_id'))
                        <p class="text-danger">{{ $errors->first('first_team_id') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group{{ $errors->has('second_team_id') ? ' has-error' : '' }}">
                        <label for="second_team_id">Team 2</label>
                        <select id="second_team_id" name="second_team_id" class="form-control">
                            <option value="">Choose team 2</option>
                            @foreach($teams as $key => $name)
                            <option value="{{ $key }}" {{ old('second_team_id') != NULL ? (old('second_team_id') == $key ? 'selected' : '' ) : (isset($match)? ($match->second_team_id == $key ? 'selected' : '') :'')  }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('second_team_id'))
                        <p class="text-danger">{{ $errors->first('second_team_id') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </form>
    </div>
</div>
@if(isset($match))
<div class="row">
    <div class="col-sm-12">
        <hr>
        <form action="{{'/admin/matches/'.$match->id .'/upload/results' }}" method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}

            @if(isset($match))
            {{ method_field('PATCH') }}
            @endif

            <div class="form-group{{ $errors->has('results_file') ? ' has-error' : '' }}">
                <input type="file" id="results_file" name="results_file">
                <p class="help-block">Uplaod Results Excel</p>
                <p class="text-danger">{{ $errors->first('results_file') }}</p>
            </div>

            <button type="submit" class="btn btn-primary pull-right">Upload Results</button>
        </form>
    </div>
</div>
@endif

@push('scripts')
<script type="text/javascript">
    $(function () {
//        $('.datetimepicker').datetimepicker({'format': 'llll'});
        $('.datetimepicker').datetimepicker({'format': 'LLL'});
    });
</script>
@endpush