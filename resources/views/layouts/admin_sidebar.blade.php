
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ 'test' }}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">{{ 'adad' }}</a>
      </div>
       <ul class="sidebar-menu">
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>{{__('admin.Dashboard')}}</span></a></li>

            <li class="{{ Route::is('admin.agent.*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
                <span>{{ __('dash.Users') }}</span></a></li>
        </ul>
    </aside>
  </div>
