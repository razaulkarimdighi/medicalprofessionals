<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="fa fa-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li
                    class="{{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);"
                       class="has-arrow waves-effect {{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Administration</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li class="{{ request()->is('admin/users*') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.users.index') }}"
                               class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                Users
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.anesthesiologists.index') }}" class="waves-effect">
                        <i class="fa fa-home"></i><span> Anesthesiologists </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.medical_practitioners.index') }}" class="waves-effect">
                        <i class="fa fa-home"></i><span> Medical Practitioners </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.get.all.schedule') }}" class="waves-effect">
                        <i class="fa fa-home"></i><span> All Schedules </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
