@php
    $route = Route::current()->getName();
    
@endphp
<style>
    .active-bar {
        background-image: url('https://img.freepik.com/free-vector/gradient-dynamic-purple-lines-background_23-2148995757.jpg');
        background-size: cover;
        background-position: center;
        color: white !important;
    }
</style>
<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="{{route('dashboard')}}">
                            <img src="{{ !empty(Auth::user()->photo) ? asset(Auth::user()->photo) : asset('https://placehold.jp/30/dd6699/ffffff/300x150.png?text=' . Auth::user()->name) }}"
                                alt=""></a></figure>
                    <h5><a href="{{route('user.profile')}}">{{ Auth::user()->name }} </a></h5>
                    <p>{{ Auth::user()->email }}</p>
                    <small class="text-info">{{ Auth::user()->username }}</small>
                </div>
            </div>
        </div>

        <div class="sidebar-widget category-widget">

            <div class="widget-content">
                <ul class="category-list ">

                    <li class="{{ $route == 'dashboard' ? 'active-bar' : '' }}"> <a href="{{ route('dashboard') }}"><i
                                class="fab fa fa-envelope "></i>
                            Dashboard </a></li>
                    <li class="{{ $route == 'user.profile' ? 'active-bar' : '' }}"><a
                            href="{{ route('user.profile') }}"><i class="fa fa-cog" aria-hidden="true"></i>
                            Settings</a></li>
                    <li><a href="blog-details.html"><i class="fa fa-credit-card" aria-hidden="true"></i> Buy
                            credits<span class="badge badge-info">( 10 credits)</span></a></li>
                    <li><a href="blog-details.html"><i class="fa fa-list-alt" aria-hidden="true"></i></i> Properties
                        </a></li>
                    <li><a href="blog-details.html"><i class="fa fa-indent" aria-hidden="true"></i> Add a Property </a>
                    </li>
                    <li><a href="blog-details.html"><i class="fa fa-key" aria-hidden="true"></i>
                            Security </a></li>
                    <li class="bg-danger"><a href="blog-details.html"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> Logout
                        </a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
