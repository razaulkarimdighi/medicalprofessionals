<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="fa fa-home"></i><span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.get.anesthesiologist.schedule') }}" class="waves-effect">
                        <i class="fa fa-calendar" aria-hidden="true"></i><span> Schedules </span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('admin.show.assignment.to.anesthesiologist') }}" class="waves-effect">
                        <i class="fa fa-check" aria-hidden="true"></i><span> Assignments </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

{{-- {{ route('admin.schedules.create') }} --}}
