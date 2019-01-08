<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Halaman Login</title>

        <meta name="description" content="Halaman Login">
        <meta name="author" content="Arif Setiawan">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="/admin/img/favicon.png">
        <link rel="apple-touch-icon" href="/admin/img/icon57.png" sizes="57x57">
        <link rel="apple-touch-icon" href="/admin/img/icon72.png" sizes="72x72">
        <link rel="apple-touch-icon" href="/admin/img/icon76.png" sizes="76x76">
        <link rel="apple-touch-icon" href="/admin/img/icon114.png" sizes="114x114">
        <link rel="apple-touch-icon" href="/admin/img/icon120.png" sizes="120x120">
        <link rel="apple-touch-icon" href="/admin/img/icon144.png" sizes="144x144">
        <link rel="apple-touch-icon" href="/admin/img/icon152.png" sizes="152x152">
        <link rel="apple-touch-icon" href="/admin/img/icon180.png" sizes="180x180">
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
    </head>
    <body>
        <!-- Login Container -->
        <div id="login-container">
            <!-- Login Header -->
            <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
                <strong>Sistem Informasi Geografis</strong>
            </h1>
            <!-- END Login Header -->

            <!-- Login Block -->
            <div class="block animation-fadeInQuickInv">
                <!-- Login Title -->
                <div class="block-title">
                    <!-- <div class="block-options pull-right">
                        <a href="/register" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Buat Akun Baru"><i class="fa fa-plus"></i></a>
                    </div> -->
                    <h2>Lupa Password</h2>
                </div>
                <!-- END Login Title -->

                <!-- Login Form -->
                <form id="form-login" method="post" class="form-horizontal" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input type="email" id="email" name="email" class="form-control" value="{{ $email or old('email') }}" placeholder="Email.." required autofocus>
                        </div>
                        @if ($errors->has('email'))
                            <div class="col-xs-12">
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password.." required>                 
                        </div>                        
                        @if ($errors->has('password'))
                            <div class="col-xs-12">
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                        @endif                        
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password.." required>                            
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="col-xs-12">
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group form-actions">
                        <div>
                            <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary" style="width: 100%;"><i class="fa fa-arrow-right"></i> Reset Password</button>

                        </div>
                    </div>
                </form>
                <!-- END Login Form -->
            </div>
            <!-- END Login Block -->

            <!-- Footer -->
            <footer class="text-muted text-center animation-pullUp">
                <small>&copy; <a href="http://masariuman.itkonsultan.id" target="_blank">MASARIUMAN.ITKONSULTAN.ID</a></small>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Login Container -->

        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="/admin/js/vendor/jquery-2.2.4.min.js"></script>
        <script src="/admin/js/vendor/bootstrap.min.js"></script>
        <script src="/admin/js/plugins.js"></script>
        <script src="/admin/js/app.js"></script>

        <!-- Load and execute javascript code used only in this page -->
        <script src="/admin/js/pages/readyLogin.js"></script>
        <script>$(function(){ ReadyLogin.init(); });</script>
    </body>
</html>