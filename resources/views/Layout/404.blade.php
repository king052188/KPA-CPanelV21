<!DOCTYPE HTML>
<html>
<?php
$url_secured = $helper["status"];
?>
<head>
    <title>FBI - Page 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="{{ asset('images/k-icon.png', $url_secured) }}" type="image/x-icon">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{ asset("/plugins/minimal_admin_panel/css/style.css", $url_secured) }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset("/plugins/minimal_admin_panel/css/font-awesome.css", $url_secured) }}" rel="stylesheet">
    <script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.min.js", $url_secured) }}"> </script>
    <script src="{{ asset("/plugins/minimal_admin_panel/js/bootstrap.min.js", $url_secured) }}"> </script>
</head>
<body>
<div class="four">
    <img src="{{ asset("/images/error-img.png", $url_secured) }}" alt="Page 404! You Requested the page that is no longer There." />
    <br /><br /><br />
    <p>Oops, You Requested the page that is no longer There.</p>
    <a href="/" class="hvr-shutter-in-horizontal">Go To Home</a>
</div>
<!---->
<div class="copy-right">
    <p> &copy; 2017 FB Inc. </p>
</div>
<!---->
<!--scrolling js-->
<script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.nicescroll.js", $url_secured) }}"></script>
<script src="{{ asset("/plugins/minimal_admin_panel/js/scripts.js", $url_secured) }}"></script>
<!--//scrolling js-->
</body>
</html>

