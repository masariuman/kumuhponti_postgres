@inject('tampilan', 'App\Http\Controllers\tampilanController')
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>@yield('seo-title') - Halaman Admin</title>

        <meta name="description" content="Panel Admin">
        <meta name="author" content="Arif Setiawan">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{$tampilan->data()->favicon}}">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="57x57">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="72x72">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="76x76">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="114x114">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="120x120">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="144x144">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="152x152">
        <link rel="apple-touch-icon" href="{{$tampilan->data()->favicon}}" sizes="180x180">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="/admin/css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="/admin/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="/admin/css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="/admin/css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="/admin/js/vendor/modernizr-3.3.1.min.js"></script>
        @stack('css')
    </head>
    <body>
        <!-- Page Wrapper -->
        <!-- In the PHP version you can set the following options from inc/config file -->
        <!--
            Available classes:

            'page-loading'      enables page preloader
        -->
        <div id="page-wrapper" class="page-loading">
            <!-- Preloader -->
            <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
            <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
            <div class="preloader">
                <div class="inner">
                    <!-- Animation spinner for all modern browsers -->
                    <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                    <!-- Text for IE9 -->
                    <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
                </div>
            </div>
            <!-- END Preloader -->

            <!-- Page Container -->
            <!-- In the PHP version you can set the following options from inc/config file -->
            <!--
                Available #page-container classes:

                'sidebar-light'                                 for a light main sidebar (You can add it along with any other class)

                'sidebar-visible-lg-mini'                       main sidebar condensed - Mini Navigation (> 991px)
                'sidebar-visible-lg-full'                       main sidebar full - Full Navigation (> 991px)

                'sidebar-alt-visible-lg'                        alternative sidebar visible by default (> 991px) (You can add it along with any other class)

                'header-fixed-top'                              has to be added only if the class 'navbar-fixed-top' was added on header.navbar
                'header-fixed-bottom'                           has to be added only if the class 'navbar-fixed-bottom' was added on header.navbar

                'fixed-width'                                   for a fixed width layout (can only be used with a static header/main sidebar layout)

                'enable-cookies'                                enables cookies for remembering active color theme when changed from the sidebar links (You can add it along with any other class)
            -->
            <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">

                @include('layouts.admin.slice.sidebar')

                <!-- Main Container -->
                <div id="main-container">
                    @include('layouts.admin.slice.header')

                    @include('layouts.admin.slice.main')
                </div>
                <!-- END Main Container -->
            </div>
            <!-- END Page Container -->
        </div>
        <!-- END Page Wrapper -->

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="/admin/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="/admin/js/vendor/bootstrap.min.js"></script>
        <script src="/admin/js/plugins.js"></script>
        <script src="/admin/js/app.js"></script>
        @stack('js')
    </body>
</html>