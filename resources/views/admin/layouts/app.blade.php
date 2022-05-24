<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @section('styles')
        @include('admin.layouts.styles')
    @show
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Language Dropdown Menu -->
            <li class="nav-item dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ Config::get('languages')[App::getLocale()]['label'] }}</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('admin.lang.update', $lang) }}">{{ $language['label'] }}</a>
                        @endif
                    @endforeach
                </ul>
            </li>

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item d-none">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{  route('admin.home') }}" class="brand-link">
            <img src="{{ asset('header-logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ $setting->name }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ auth()->user()->avatar_url }}" onerror="this.onerror=null; this.src='{{ asset('themes/AdminLTE/dist/img/avatar5.png') }}';" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="{{  route('admin.home') }}" class="d-block">{{ auth()->user()->full_name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{  route('admin.home') }}" class="nav-link @if(request()->is('admin/home')) active @endif">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview @if(request()->is('admin/m1/*')) menu-open @endif">
                        <a href="#" class="nav-link @if(request()->is('admin/m1/*')) active @endif">
                            <i class="nav-icon fas fa-biking"></i>
                            <p>
                                Spinning Cycle
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.m1.configurations.edit', [$setting]) }}" class="nav-link @if(request()->is('admin/m1/configurations*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Configurations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.m1.packages.index') }}" class="nav-link @if(request()->is('admin/m1/packages*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Packages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.m1.coupons.index') }}" class="nav-link @if(request()->is('admin/m1/coupons*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Coupons</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.m1.classes.index') }}" class="nav-link @if(request()->is('admin/m1/classes*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Classes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.m1.calendar.index') }}" class="nav-link @if(request()->is('admin/m1/calendar*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Calendar</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview @if(request()->is('admin/users*')) menu-open @endif">
                        <a href="#" class="nav-link @if(request()->is('admin/users*')) active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.users.admins.index') }}" class="nav-link @if(request()->is('admin/users/admins*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview @if(request()->is('admin/governorates*')||request()->is('admin/areas*')) menu-open @endif">
                        <a href="#" class="nav-link @if(request()->is('admin/areas*') || request()->is('admin/governorates*')) active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Master
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.governorates.index') }}" class="nav-link @if(request()->is('admin/governorates*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Governorates</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.areas.index') }}" class="nav-link @if(request()->is('admin/areas*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Areas</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-header">MISCELLANEOUS</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cms.edit', ['masterCms' => 1]) }}" class="nav-link @if(request()->is('admin/cms/1/*')) active @endif">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>About</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cms.edit', ['masterCms' => 2]) }}" class="nav-link @if(request()->is('admin/cms/2/*')) active @endif">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>Privacy Policy</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.cms.edit', ['masterCms' => 3]) }}" class="nav-link @if(request()->is('admin/cms/3/*')) active @endif">
                            <i class="nav-icon fas fa-file-contract"></i>
                            <p>Terms & Conditions</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview @if(request()->is('admin/security*')) menu-open @endif">
                        <a href="#" class="nav-link @if(request()->is('admin/security*')) active @endif">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                Security
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.security.permissions.index') }}" class="nav-link @if(request()->is('admin/security/permissions*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.security.roles.index') }}" class="nav-link @if(request()->is('admin/security/roles*')) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.edit', ['setting' => 1]) }}" class="nav-link @if(request()->is('admin/settings/*')) active @endif">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Settings</p>
                        </a>
                    </li>

                    <li class="nav-header">MY ACCOUNT</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.my-profile.edit', [auth()->user()->id]) }}" class="nav-link @if(request()->is('admin/my-profile/*')) active @endif">
                            <i class="nav-icon fas fa-user"></i>
                            <p>My Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.change-password.edit', [auth()->user()->id]) }}" class="nav-link @if(request()->is('admin/change-password/*')) active @endif">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); $('#logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div>
        @yield('content')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer text-sm">
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ now()->year }} <a href="#">{{ $setting->name }}</a>.</strong> All rights reserved.

        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <strong>{{ $setting->version }}</strong>
        </div>
    </footer>
</div>

@section('scripts')
    @include('admin.layouts.scripts')
@show
</body>
</html>
