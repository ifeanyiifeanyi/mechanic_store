@extends('layouts.app')


@section('title', 'Profile Page')

@section('css')

@endsection

@section('user')

    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">
                    <div class="lower-content">
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



@endsection

@section('js')
<script>
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
