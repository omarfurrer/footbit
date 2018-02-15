<div id="profile-card">
    <img src="{{ $user->photo_path != NULL ? asset('storage/'.$user->photo_path ) : 'https://placeimg.com/640/480/people' }}" alt="John" style="width:100%">
    <h3>{{ $user->name }}</h3>
    <p class="title">Goal Keeper</p>
    <p>{{ $team != NULL ? $team->name : '' }}</p>
    <a href="#"><i class="fa fa-dribbble"></i></a> 
    <a href="#"><i class="fa fa-twitter"></i></a> 
    <a href="#"><i class="fa fa-linkedin"></i></a> 
    <a href="#"><i class="fa fa-facebook"></i></a> 
    <label for="profile-photo" class="m-0">
        <form method="POST" action="{{ url('/users/'.$user->id.'/update/photo') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input id="profile-photo" name="photo" onchange="this.form.submit()" type="file" style="display:none;">
        </form>
        Change Photo
    </label>
</div>