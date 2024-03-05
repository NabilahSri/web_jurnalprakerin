<!-- sidebar-->
<section class="sidebar position-relative">
    <div class="multinav">
        <div class="multinav-scroll" style="height: 100%;">
            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
                @if (auth()->user()->level == 'admin')
                    <li class="header">Dashboard</li>
                    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="header">Management</li>
                    <li class="menu-item {{ request()->is('kelas*') ? 'active' : '' }}">
                        <a href="/kelas">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Kelas</span>
                        </a>
                    </li>
                    <li class="treeview {{ request()->is('users*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="menu-item {{ request()->is('users/administrator') ? 'active' : '' }}"><a
                                    href="/users/administrator"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Administrator</a></li>
                            <li class="menu-item {{ request()->is('users/siswa') ? 'active' : '' }}"><a
                                    href="/users/siswa"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Siswa</a></li>
                            <li class="menu-item {{ request()->is('users/pemonitoring') ? 'active' : '' }}"><a
                                    href="/users/pemonitoring"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Guru/Pemonitor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item {{ request()->is('industri*') ? 'active' : '' }}">
                        <a href="/industri">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Industri</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                        <a href="/monitoring">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Monitoring</span>
                        </a>
                    </li>
                    <li class="header">Mobile</li>
                    <li class="menu-item {{ request()->is('banner*') ? 'active' : '' }}">
                        <a href="/banner">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Banner</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('absensi*') ? 'active' : '' }}">
                        <a href="/absensi">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Kehadiran & Kegiatan</span>
                        </a>
                    </li>
                    <li class="header">Report</li>
                    <li class="treeview {{ request()->is('report*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                            <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="menu-item {{ request()->is('report/kehadiran') ? 'active' : '' }}"><a
                                    href="/report/kehadiran"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kehadiran</a></li>
                            <li class="menu-item {{ request()->is('report/kegiatan') ? 'active' : '' }}"><a
                                    href="/report/kegiatan"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kegiatan</a></li>
                        </ul>
                    </li>
                @else
                    <li class="header">Dashboard</li>
                    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a href="/dashboard">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="header">Management</li>
                    <li class="menu-item {{ request()->is('monitoring*') ? 'active' : '' }}">
                        <a href="/monitoring">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Monitoring</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->is('absensi*') ? 'active' : '' }}">
                        <a href="/absensi">
                            <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                            <span>Kehadiran & Kegiatan</span>
                        </a>
                    </li>
                    <li class="header">Report</li>
                    <li class="treeview {{ request()->is('report*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                            <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="menu-item {{ request()->is('report/kehadiran') ? 'active' : '' }}"><a
                                    href="/report/kehadiran"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kehadiran</a></li>
                            <li class="menu-item {{ request()->is('report/kegiatan') ? 'active' : '' }}"><a
                                    href="/report/kegiatan"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Kegiatan</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</section>
