<form action="{{ isset($user)? '/admin/users/'.$user->id : '/admin/users' }}" method="POST">

    {{ csrf_field() }}

    @if(isset($user))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($user)? $user->name : '' }}">
        @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ isset($user)? $user->email : '' }}">
        @if($errors->has('email'))
        <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ isset($user)? $user->username : '' }}">
        @if($errors->has('username'))
        <p class="text-danger">{{ $errors->first('username') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
        <label for="phone_number">Phone Number</label>
        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone Number" value="{{ isset($user)? $user->phone_number : '' }}">
        @if($errors->has('phone_number'))
        <p class="text-danger">{{ $errors->first('phone_number') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
        <label for="date_of_birth">Date Of Birth</label>
        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
               min="1900-01-01" max="2017-01-01"
               placeholder="Date Of Birth" value="{{ isset($user)? ($user->date_of_birth != NULL ? $user->date_of_birth->toDateString():'') : '' }}">
        @if($errors->has('date_of_birth'))
        <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
        @endif
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="is_admin" value="1" {{  isset($user)? ($user->is_admin ? 'checked' : '') : ''  }}> Admin
        </label>
    </div>

    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>