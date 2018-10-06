<div class="m-0 p-0 sidebar position-fixed">
    <div class="nav sidebar-nav my-sidebar">
        <ul class="list-unstyled w-100 m-0">
            <li class="list-item pl-5 my-dashboard"><a href="/dashboard"><i class="fa fa-dashboard mr-3"></i>DASHBOAED</a></li>
            <li class="list-item pl-5"><a href="{{ route('users.show', [auth()->user()->id]) }}"><i class="fa fa-user-circle mr-3"></i>Profile</a></li>
            <li class="list-item pl-5"><a href="/companies"><i class="fa fa-building mr-3"></i>My Companies</a></li>
            <li class="list-item pl-5"><a href="/projects"><i class="fa fa-briefcase mr-3"></i>My Projects</a></li>
            <li class="list-item pl-5"><a href="/tasks"><i class="fa fa-tasks mr-3"></i>My Tasks</a></li>
        </ul>
        @if(auth()->user()->role_id == 1)
        <hr />
        <ul class="list-unstyled w-100">
            <li class="list-item pl-5"><a href="/admin/all/companies"><i class="fa fa-building mr-3"></i>All Companies</a></li>
            <li class="list-item pl-5"><a href="/admin/all/projects"><i class="fa fa-briefcase mr-3"></i>All Projects</a></li>
            <li class="list-item pl-5"><a href="/admin/all/tasks"><i class="fa fa-tasks mr-3"></i>All Tasks</a></li>
        </ul>
        @endif
        <hr />
        <ul class="list-unstyled w-100">
            <li class="list-item pl-5"><a href="{{ route('users.edit', [auth()->user()->id]) }}"><i class="fa fa-edit mr-3"></i>Edit Profile</a></li>
            <li class="list-item pl-5"><a href="/settings"><i class="fa fa-gear mr-3"></i>Settings</a></li>
            <li class="list-item pl-5"><a href="/help"><i class="fa fa-hand-o-right mr-3"></i>Help</a></li>
            <li class="list-item pl-5">
                <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="sidebar-img"></div>
</div>
