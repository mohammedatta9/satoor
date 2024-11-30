<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::is('user.dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i>
                    <span>{{ __('dash.Dashboard') }}</span></a></li>
            <li class="{{ Route::is('user.agent.*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('user.agents.index') }}"><i class="fas fa-users"></i>
                <span>{{ __('dash.Agents') }}</span></a></li>
            <li class="{{ Route::is('user.orders.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('user.orders') }}"><i class="fas fa-file-invoice"></i>
                    <span>{{ __('dash.Orders') }}</span></a></li>
            <li class="{{ Route::is('user.category.*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('user.category.index') }}"><i class="fas fa-th-large"></i>
                    <span>{{ __('dash.Categories') }}</span></a></li>

            <li class="{{ Route::is('user.general-setting') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('user.general-setting') }}"><i class="fas fa-cog"></i>
                    <span>{{ __('user.Setting') }}</span></a></li>
            <li
                class="nav-item dropdown {{ Route::is('user.product.*')  ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i
                        class="fas fa-th-large"></i><span>{{ __('user.Manage Product') }}</span></a>

                <ul class="dropdown-menu">
                    <li class="{{ Route::is('user.product.create') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('user.product.create') }}">{{ __('user.Create Product') }}</a></li>

                    <li class="{{ Route::is('user.product.*') || Route::is('user.product-variant') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.product.index') }}">{{ __('user.All Product') }}</a>
                    </li>


                </ul>
            </li>

        </ul>
    </aside>
</div>
