<!DOCTYPE html>
<html>
<?php
$url_secured = $helper["status"];
?>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="pragma" content="no-cache" />
    <title>FBI - Sign Up</title>
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
        .btn {
            width: 400px;
        }
        .login-box {
            margin: -40px;;
        }
    </style>
</head>
{{--//4267b2--}}
<body class="login-page">
<div class="login-box">
    <div class="logo" style="background: #4267b2; padding: 10px;"  id="notifier_msg">
        <a href="javascript:void(0);"><b>FBI </b>- Registration Form</a>
        <small>Sign up to start your FBI!</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="form" method="POST" action="/sign-up/processing">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="msg">Please fill up the form below.</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle name" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">face</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="txt_date_of_birth" name="txt_date_of_birth" placeholder="Date of birth">
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of birth" style="display: none;" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">perm_identity</i>
                        </span>
                    <div class="form-line">
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="0">Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phonelink_ring</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required autofocus>
                    </div>
                </div>
                @if( $endorser_account == null)
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="endorsed_by" name="endorsed_by" placeholder="Endorsed by (Required)" required autofocus>
                        </div>
                    </div>
                @endif
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="specialist" name="specialist" placeholder="Specialist (Optional)" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button id="btnSignUp" class="btn btn-block bg-blue waves-effect" type="submit">SIGN UP</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="/login" class="btn btn-block bg-pink waves-effect" type="submit">I ALREADY A MEMBER</a>
                    </div>
                </div>
            </form>
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
<script src="{{ asset("js/admin.js", $url_secured) }}"></script>
<script src="{{ asset("js/scripts.js", $url_secured) }}"></script>
<script src="{{ asset("js/sign-in.js", $url_secured) }}"></script>
@if (session('message'))
    <script>
        var error_message = "{{ session('message') }}";
        $(document).ready(function() {
            $("#notifier_msg").notify(error_message);
        })
    </script>
@endif
<script>
    $(document).ready(function() {
        $( "#txt_date_of_birth" ).click(function() {
            $("#txt_date_of_birth").hide();
            $("#date_of_birth").show();
        });
    })
</script>
</body>
</html>