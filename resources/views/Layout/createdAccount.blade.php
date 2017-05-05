<!DOCTYPE HTML>
<html>
<?php
$url_secured = $helper["status"];
?>
<head>
    <title>KPA CPanelV21 - Account Created</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="pragma" content="no-cache" />
    <link rel="icon" href="{{ asset('images/k-icon.png', $url_secured) }}" type="image/x-icon">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{ asset("/plugins/minimal_admin_panel/css/style.css", $url_secured) }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset("/plugins/minimal_admin_panel/css/font-awesome.css", $url_secured) }}" rel="stylesheet">
    <script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.min.js", $url_secured) }}"> </script>
    <script src="{{ asset("/plugins/minimal_admin_panel/js/bootstrap.min.js", $url_secured) }}"> </script>
    <script>
//        setInterval(function() {
//            window.location.href="/login";
//        }, 5000);
    </script>
</head>
<body>
<div class="four">
    <img src="{{ asset("/images/account-created-success-img.png", $url_secured) }}" alt="Hooray! Your account has now been created! We’ve send a welcome email. Please check." />
    <br /><br /><br />
    <p style="font-size: 1.2em;">This page will automatically redirect to your dashboard after 5 seconds.</p>
    Or <br /><br /> <a href="/dashboard" class="hvr-shutter-in-horizontal">Click here</a>
</div>
<!---->
<div class="copy-right">
    <p> &copy; 2016-{{ date("Y") }} KPA CPanelV21. </p>
</div>
<!---->
<!--scrolling js-->
<script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.nicescroll.js", $url_secured) }}"></script>
<script src="{{ asset("/plugins/minimal_admin_panel/js/scripts.js", $url_secured) }}"></script>
<!--//scrolling js-->
</body>
</html>
