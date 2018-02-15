<form action="{{ isset($venue)? '/admin/venues/'.$venue->id : '/admin/venues' }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    @if(isset($venue))
    {{ method_field('PATCH') }}
    @endif

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($venue)? $venue->name : '' }}">
        @if($errors->has('name'))
        <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
        <label for="location">Location</label>
        <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="{{ isset($venue)? $venue->location : '' }}">
        @if($errors->has('location'))
        <p class="text-danger">{{ $errors->first('location') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('gmaps_url') ? ' has-error' : '' }}">
        <label for="gmaps_url">GMaps URL</label>
        <input type="text" class="form-control" name="gmaps_url" id="gmaps_url" placeholder="GMaps URL" value="{{ isset($venue)? $venue->gmaps_url : '' }}">
        @if($errors->has('gmaps_url'))
        <p class="text-danger">{{ $errors->first('gmaps_url') }}</p>
        @endif
    </div>

    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
        @if(isset($venue))
        @if($venue->image_path != NULL)
        <img width="200" height="200" src="{{ asset('storage/'.$venue->image_path) }}" alt="..." class="img-rounded" id="venue-image-placeholder">
        @endif
        @endif
        <input type="file" id="image" name="image">
        <p class="help-block">Uplaod Image</p>
        <p class="text-danger">{{ $errors->first('image') }}</p>
    </div>



    <button type="submit" class="btn btn-primary pull-right">Save</button>
</form>

@push('scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#venue-image-placeholder').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image").change(function () {
        readURL(this);
    });
</script>
@endpush