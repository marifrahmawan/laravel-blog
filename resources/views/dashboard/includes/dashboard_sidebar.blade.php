<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link navbar-cyan">
        <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->photo != NULL)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>
        
        <!-- Sidebar Menu -->
        <nav class="mt-2 ">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if(Route::currentRouteName() == 'dashboard') active @endif">
                        <i class="nav-icon nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview @if(Route::currentRouteName() == 'dashboard-admin') menu-open @endif @if(Route::currentRouteName() == 'dashboard-user') menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'dashboard-admin') active @endif @if(Route::currentRouteName() == 'dashboard-user') active @endif">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('dashboard-admin') }}" class="nav-link @if(Route::currentRouteName() == 'dashboard-admin') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard-user') }}" class="nav-link @if(Route::currentRouteName() == 'dashboard-user') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(Route::currentRouteName() == 'category-tag') menu-open @endif">
                    <a href="#" class="nav-link @if(Route::currentRouteName() == 'category-tag') active @endif">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Post Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category-tag') }}" class="nav-link @if(Route::currentRouteName() == 'category-tag') active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category & Tag</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>