<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="http://www.kpa21.info">
    <link rel="shortcut icon" href="{{ asset('/images/maintenance-icon.png') }}">
    <title>FBI PH - Under Construction.</title>

    <!-- SEO -->
    <meta name="description" content="OUR VISION A transformed and peaceful society where there is equality, debt-free, social justice and order for everyone.

    OUR MISSION To empower the people in the Community by organizing and uniting them through raising their social consciousness in preserving peace and order, actively participate in community development and nation building and enlightening them about financial awareness thus liberating them from the bondage of poverty and turning them self-reliant and making realize that the foundation of the Community is based on trust.
    ">
    <meta name="keywords" content="fbi-ph.org, kpa21.info, ptxt4wrd.com">

    <meta property="og:description" content="OUR VISION A transformed and peaceful society where there is equality, debt-free, social justice and order for everyone.

    OUR MISSION To empower the people in the Community by organizing and uniting them through raising their social consciousness in preserving peace and order, actively participate in community development and nation building and enlightening them about financial awareness thus liberating them from the bondage of poverty and turning them self-reliant and making realize that the foundation of the Community is based on trust.
    " />
    <meta property="og:title" content="FBI PH - It's being updated." />
    <meta property="og:url" content="http://fbi-ph.org" />
    <meta property="og:type" content="website" />

    <meta name="twitter:title" content="FBI PH - It's being updated." />
    <meta name="twitter:site" content="http://fbi-ph.org" />
    <!--//END SEO -->

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
                <img src="{{ asset('/images/maintenance-icon.png') }}" style="width: 120px;" title="FBI-PH.org" alt="FBI-PH.org">
                <h1 style="margin-top: 15px;">FBI-PH.org <span style="color: #E6E6E6;">Under Construction</span></h1>
                <h2 class="subtitle">We're working hard to improve our website and we'll ready to launch after</h2>
                <div id="countdown"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <p class="copyright">2017 &copy; FBI PH.</p>
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
