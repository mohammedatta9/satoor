
@include('layouts.dash_header')
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a target="_blank" href=" " class="nav-link nav-link-lg"><i class="fas fa-home"></i> {{__('dash.Visit Website')}}</i></a>

          </li>

          <li class="dropdown "><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg ">

          <div class="d-sm-none d-lg-inline-block"><i class="fas fa-bell"></i>
          </div></a>
          <div class="dropdown-menu dropdown-menu-right">
            @php
                $notifications = Auth::user()->notifications;
            @endphp
            @foreach ( $notifications as $notification)
            <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}"
                class="dropdown-item has-icon">
                @if ($notification->unread())
                    *
                @endif
                <i class="far fa-user"></i> {{$notification->data['body']}}
              <span class="text-sm text-muted float-right">{{$notification->created_at->diffForHumans()}}</span>

              </a>
            @endforeach
          </div>
        </li>


          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              {{-- @if ($default_avatar->image)
              <img alt="image" src="{{ asset($header_admin->image) }}" class="rounded-circle mr-1">
              @else --}}
              {{-- <img alt="image" src=" " class="rounded-circle mr-1"> --}}
              {{-- @endif --}}
            <div class="d-sm-none d-lg-inline-block">Admin</div></a>
            <div class="dropdown-menu dropdown-menu-right">

              <a href=" " class="dropdown-item has-icon">
                <i class="far fa-user"></i> {{__('dash.Profile')}}
              </a>
              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
              document.getElementById('admin-logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{__('dash.Logout')}}
              </a>
            {{-- start admin logout form --}}
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            {{-- end admin logout form --}}


            </div>
          </li>
        </ul>
      </nav>

      @yield('dash-content')



      <footer class="main-footer">
        <div class="footer-left">
           {{}}
        </div>
        <div class="footer-right">
          </div>
      </footer>
    </div>
  </div>

  @include('layouts.dash_footer')
