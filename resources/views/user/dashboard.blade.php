@extends('layouts.app')


@section('title', 'Dashboard')

@section('css')

@endsection

@section('user')

    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">
<p>Last Login Date and Time: {{ $user->getLastLoginDateTime() }}</p>
<h2>Device Information</h2>

<p>Device: {{ $deviceInformation['device'] }}</p>
<p>Platform: {{ $deviceInformation['platform'] }}</p>
<p>Browser: {{ $deviceInformation['browser'] }}</p>
@if($userLocation)
    <h1>User Location</h1>
    <p>IP: {{ $userLocation->ip }}</p>
    <p>Country: {{ $userLocation->country_name }}</p>
    <p>City: {{ $userLocation->city_name }}</p>
    <!-- Display other location properties as needed -->
@else
    <p>No location data available.</p>
@endif

                    <div class="lower-content">
                        <h3>Including Animation In Your Design System.</h3>
                    
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card-body" style="background-color: #1baf65;">
                                    <h1 class="card-title" style="color: white; font-weight: bold;">0
                                    </h1>
                                    <h5 class="card-text"style="color: white;"> Approved properties
                                    </h5>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-body" style="background-color: #ffc107;">
                                    <h1 class="card-title" style="color: white; font-weight: bold; ">0
                                    </h1>
                                    <h5 class="card-text"style="color: white;"> Pending approve
                                        properties</h5>

                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card-body" style="background-color: #002758;">
                                    <h1 class="card-title" style="color: white; font-weight: bold;">0
                                    </h1>
                                    <h5 class="card-text"style="color: white; "> Rejected properties
                                    </h5>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <h3>Activity Logs</h3>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

@endsection
