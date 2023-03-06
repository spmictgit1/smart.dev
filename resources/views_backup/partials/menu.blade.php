<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home")}}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            @can('users_manage')
            <li class="nav-item nav-dropdown">

                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon"></i>
                    Urus Pengguna
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}"
                            class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}"
                            class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}"
                            class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            <!-- KUOTA SEKOLAH   -->
            @canany(['users_manage'])
            <li class="nav-item nav-dropdown">

                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon"></i>
                    Tetapan Sekolah
                </a>

                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a href="{{ url('senaraisekolah.url') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-circle"></i>
                            Kuota Penempatan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('paparcalon.url') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-circle"></i>
                            Jana Markah Calon
                        </a>
                    </li>

                </ul>
            </li>
            
            @endcanany

            <!-- -->



            @canany(['panel','ppd'])

            <li class="nav-item">
                <a href="{{ url('/filter') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-filter"></i>
                    Tapisan Calon
                </a>
            </li>

            <!--li class="nav-item nav-dropdown">

                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon"></i>
                    Panel Pemilihan
                </a>


                <ul class="nav-dropdown-items">

                    <li class="nav-item">
                        <a href="{{ url('/filter') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-filter"></i>
                            Tapisan Calon
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/datamurids') }}" class="nav-link">
                            <i class="nav-icon fas fa-fw fa-list-ol"></i>
                            Penempatan Calon
                        </a>
                    </li>
                </ul>
            </li-->


            <li class="nav-item nav-dropdown">

                <a href="{{route('murid_isi.name')}}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-pie-chart"></i>
                    Kuota Penempatan
                </a>
            </li>
            

            <!--li class="nav-item">
                <a href="{{ url('semak') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">
                    </i>
                    Semakan</a>
            </li-->
            @endcanany

            @canany(['admin_sekolah'])
            <li class="nav-item">
                <a href="{{ url('/pengesahansekolah') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">
                    </i>
                    Pengesahan Sekolah</a>
            </li>

            @endcanany
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-key">
                    </i>
                    Tukar Katalaluan</a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">
                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>