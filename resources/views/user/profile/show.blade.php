@extends('layouts.app')


@section('title', 'Profile Page')

@section('css')
<style>
input{
    font-weight:900 !important;
}
label{
    color: teal !important;
    
}
input[type="text"], input[type="email"], textarea, select {
  font-family: "Open Sans", Arial, sans-serif !important;
}
</style>
@endsection

@section('user')

    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">
                    <div class="lower-content">
                        <center>
                    <a href="" class="btn btn-outline-info btn-lg shadow" data-toggle="modal" data-target="#exampleModalCenter"><span class=" badge badge-info"><i class="fas fa-location fa-pulse"></i></span> My Location</a>
                        </center>
                        <form action="{{ route('user.profile.update') }}" method="post" class="default-form" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ $user->username }}"
                                    class="form-control @error('username') is-invalid @enderror">
                                @error('username')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="phone" value="{{ $user->phone }}"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{ $user->address }}"
                                    class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="image-input" class="form-label">Profile Image</label>
                                        <input class="form-control @error('photo') is-invalid @enderror" type="file"
                                            name="photo" id="image-input">
                                        @error('photo')
                                            <i class="text-danger">{{ $message }}</i>
                                        @enderror
                                    </div>
                                    <div class="col-md-5">
                                        <img
                                        src="{{ !empty($user->photo) ? asset($user->photo) : asset('https://placehold.jp/30/dd6699/ffffff/300x150.png?text=' . $user->name) }}"
                                        alt="" class="w-50 img-fluid" id="profile-image">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Save Changes </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal shadow fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Current Location <i class="fas fa-location-circle fa-spin"></i>
<hr>
        <pre class="text-info text-sm">{{ $user->userLocation->ip }}</pre>
<small class="text-info text-sm">lat: {{ $user->userLocation->latitude }}</small> <br>
        <small class="text-info text-sm">log: {{ $user->userLocation->logitude }}</small> <br>
        
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive shadow">
            <table class="table table-hover">
                <tr>
                    <th>Country</th>
                    <td>{{ $user->userLocation->country_name }}</td>
                </tr>
                <tr>
                    <th>Region</th>
                    <td>{{ $user->userLocation->region_name }}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{ $user->userLocation->city_name }}</td>
                </tr>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="" class="btn btn-primary"><i class="fal fa-map-marker-question"></i> Edit Location</a>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script>
const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0,
};

function success(pos) {
  const crd = pos.coords;

  console.log("Your current position is:");
  console.log(`Latitude : ${crd.latitude}`);
  console.log(`Longitude: ${crd.longitude}`);
  console.log(`More or less ${crd.accuracy} meters.`);
}

function error(err) {
  console.warn(`ERROR(${err.code}): ${err.message}`);
}

navigator.geolocation.getCurrentPosition(success, error, options);

        document.addEventListener('DOMContentLoaded', function() {
            var imageInput = document.getElementById('image-input');
            var profileImage = document.getElementById('profile-image');
            //  var imageError = document.getElementById('image-error');

            imageInput.addEventListener('change', function() {
                var input = this;
                // imageError.innerHTML = '';

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        profileImage.setAttribute('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // Handle error if no file is selected
                    //imageError.innerHTML = 'Please select an image.';
                }
            });
        });
    </script>
@endsection
