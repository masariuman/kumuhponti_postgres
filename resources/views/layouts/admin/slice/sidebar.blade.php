<!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Sidebar Brand -->
                    <div id="sidebar-brand" class="themed-background">
                        <a href="/admin/dashboard" class="sidebar-title">
                            <img src="/photos/1/untan.png" height="25"> <span class="sidebar-nav-mini-hide">Tugas Akhir <strong>SKRIPSI</strong></span>
                        </a>
                    </div>
                    <!-- END Sidebar Brand -->

                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <div align="center" id="profile-pengguna">
                                    <img src="{{ Auth::user()->foto }}" alt="avatar" class="img-thumbnail" height="74px" width="74px">
                                    <p style="color: white;">
                                        <b>{{ Auth::user()->name }}</b>
                                        <br />
                                        <span class="label label-primary"><strong> ADMIN </strong></span>
                                    </p>
                                </div>
                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>
                                <li>
                                    <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="gi gi-compass sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
                                </li>
<!--                                 <li>
                                     <a href="/admin/daerah" class="{{ Request::is('admin/daerah') ? 'active' : '' }}"><i class="gi gi-list sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Daerah</span></a>
                                </li> -->
                                <li>
                                    <a href="{{ route('jaling.show_all') }}" class="{{ Request::is('admin/layer') ? 'active' : '' }}"><i class="gi gi-google_maps sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Layer</span></a>
                                </li>
<!--                                   <li>
                                  <a href="/admin/kategori" class="{{ Request::is('admin/kategori') ? 'active' : '' }}"><i class="gi gi-list sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Kategori</span></a>
                                </li> -->
<!--                            <li>
                                    <a href="/admin/data" class="{{ Request::is('admin/data') ? 'active' : '' }}"><i class="fa fa-database sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data</span></a>
                                </li> -->
                                <li>
                                    <a href="/admin/kumuh" class="{{ Request::is('admin/kumuh') ? 'active' : '' }}"><i class="fa fa-database sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Wilayah Kumuh</span></a>
                                </li>
<!--                            <li>
                                    <a href="/admin/maps" class="{{ Request::is('admin/maps') ? 'active' : '' }}"><i class="gi gi-google_maps sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Maps</span></a>
                                </li> -->
                                <li>
                                    <a href="/admin/user" class="{{ Request::is('admin/user') ? 'active' : '' }}"><i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">User</span></a>
                                </li>
                                <li>
                                    <a href="/admin/tampilan" class="{{ Request::is('admin/tampilan') ? 'active' : '' }}"><i class="gi gi-brush sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tampilan</span></a>
                                </li>
                            </ul>
                            <!-- END Sidebar Navigation -->


                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->

                    <!-- Sidebar Extra Info -->
                    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
                        <div class="text-center">
                            <small><span id="year-copy"></span> &copy; <a href="http://itkonsultan.id" target="_blank">{{ date('Y') }}</a></small>
                        </div>
                    </div>
                    <!-- END Sidebar Extra Info -->
                </div>
                <!-- END Main Sidebar -->
