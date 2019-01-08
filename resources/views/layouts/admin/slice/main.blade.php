<!-- Page content -->
                    <div id="page-content">
                        <!-- Blank Header -->
                        <div class="content-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="header-section">
                                        <h1>@yield('title')</h1>
                                    </div>
                                </div>
                                <div class="col-sm-6 hidden-xs">
                                    <div class="header-section">
                                        <ul class="breadcrumb breadcrumb-top">
                                            <li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                                            <li><a href="{{Request::URL()}}">@yield('seo-title')</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Blank Header -->

                        @yield('main')
                    </div>
                    <!-- END Page Content -->