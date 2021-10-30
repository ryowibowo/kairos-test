<nav class="navbar navbar-header navbar-expand-lg">
    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <h1 style="color: white">Login Sebagai:
                        {{ Auth::user()->username }}
                    </h1>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <li>
                        <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>