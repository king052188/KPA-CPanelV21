<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="http://www.kpa21.info">
    <link rel="shortcut icon" href="{{ asset('/images/maintenance-icon.png') }}">
    <title>KPA CPanelV21 - Under Construction.</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/maintenance-icon.png') }}"/>

    <!-- Bootstrap -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-theme.css') }}" rel="stylesheet">

    <!-- siimple style -->
    <link href="{{ asset('/css/style_v0.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <img src="{{ asset('/images/maintenance-icon.png') }}" style="width: 120px;" title="CPanelV21.kpa21.com" alt="CPanelV21.kpa21.com">
                <h1 style="margin-top: 15px;">CPanelV21.kpa21.com <span style="color: #E6E6E6;">Under Construction</span></h1>
                <h2 class="subtitle">We're working hard to improve our website and we'll ready to launch after</h2>
                <div id="countdown"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <p class="copyright">&copy; 2016-{{ date("Y") }} KPA CPanelV21. </p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.countdown.min.js') }}"></script>
<script type="text/javascript">
    $('#countdown').countdown('2017/04/15', function(event) {
        $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
    });
</script>
</body>
</html>
