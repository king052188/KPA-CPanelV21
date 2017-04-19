<!DOCTYPE html>
<html>
<?php
$url_secured = $helper["status"];
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>FBI - Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('images/k-icon.png', $url_secured) }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core Css -->
    <link href="{{ asset("/plugins/bootstrap/bootstrap/css/bootstrap.css", $url_secured) }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset("/plugins/bootstrap/node-waves/waves.css", $url_secured) }}" rel="stylesheet" />
    <!-- Animation Css -->
    <link href="{{ asset("/plugins/bootstrap/animate-css/animate.css", $url_secured) }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ asset("/css/style.css", $url_secured) }}" rel="stylesheet">
    <style>
        body {
            -webkit-font-smoothing: antialiased;
            -webkit-overflow-scrolling: touch;
            background: url( {{ asset('images/pexels_photo_25349.jpg', $url_secured) }} ) no-repeat center center fixed;
            -webkit-background-size: 100%;
            -moz-background-size: 100%;
            -o-background-size: 100%;
            background-size: 100%;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .login-box {
            margin: -40px;;
        }

        .or_sign_in {
            text-align: center;
        }

        button#fb_account_kit, .or_sign_in {
            width: 400px;
        }
    </style>
</head>
{{--//4267b2--}}
<body class="login-page">
<div class="login-box">
    <div class="logo" style="background: #4267b2; padding: 10px;">
        <a href="javascript:void(0);"><b>FBI </b>- Log In Form</a>
        <small>Sign In to start your FBI!</small>
    </div>
    <div class="card">
        <div class="body">
            <form method="POST" action="/login/processing">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="msg">Log In to start your session.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="account" name="account" placeholder="Hash Code or Username" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-blue">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <img id="loginLoading" src="{{ asset('/images/facebook.gif', $url_secured) }}" alt="Please wait..." style="display: none; float: right;" />
                        <button id="btnSignUp" class="btn btn-block bg-blue waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xs-4 or_sign_in">
                    <span>OR</span>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <form id="login_success" method="post" action="/login/execute/v2">
                        <input id="_token" type="hidden" name="_token">
                        <input id="csrf" type="hidden" name="csrf" />
                        <input id="code" type="hidden" name="code" />
                    </form>
                    <button id="fb_account_kit" onclick="smsLogin();" class="btn btn-block bg-pink waves-effect" disabled>LOGIN VIA SMS</button>
                </div>
            </div>
            <div class="row m-t-15 m-b--20">
                <div class="col-xs-6">
                    <a href="/forgot-password">Forgot Password?</a>
                </div>
                <div class="col-xs-6 align-right">
                    <a href="/sign-up">Join to FBI PH?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset("js/jquery-3.1.1.min.js", $url_secured) }}"></script>
<script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<!-- Bootstrap Core Js -->
{{--<script src="{{ asset("plugins/bootstrap/js/bootstrap.js", $url_secured) }}"></script>--}}
<!-- Waves Effect Plugin Js -->
<script src="{{ asset("plugins/bootstrap/node-waves/waves.js", $url_secured) }}"></script>
<!-- Validation Plugin Js -->
<script src="{{ asset("plugins/bootstrap/jquery-validation/jquery.validate.js", $url_secured) }}"></script>
<!-- Custom Js -->
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script>
    // initialize Account Kit with CSRF protection
    AccountKit_OnInteractive = function(){
        AccountKit.init(
                {
                    appId:"239866523142614",
                    state:"{{ csrf_token() }}",
                    version:"v1.1",
                    debug: true
                }
        );
    };
</script>
<script src="{{ asset("js/admin.js", $url_secured) }}"></script>
<script src="{{ asset("js/scripts.js", $url_secured) }}"></script>
<script src="{{ asset("js/sign-in.js", $url_secured) }}"></script>
@if (session('message'))
    <script>
        var error_message = "{{ session('message') }}";
        $(document).ready(function() {
            $(".body").notify(error_message);
        })
    </script>
@endif

</body>
</html>