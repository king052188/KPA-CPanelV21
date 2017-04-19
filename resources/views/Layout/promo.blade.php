<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="http://www.kpa21.info">
    <link rel="shortcut icon" href="{{ asset('/images/fbi_dark_logo.png') }}">
    <title>F3H Project - On-Going Registration</title>

    <!-- SEO -->
    <meta name="description" content="OUR VISION A transformed and peaceful society where there is equality, debt-free, social justice and order for everyone.

    OUR MISSION To empower the people in the Community by organizing and uniting them through raising their social consciousness in preserving peace and order, actively participate in community development and nation building and enlightening them about financial awareness thus liberating them from the bondage of poverty and turning them self-reliant and making realize that the foundation of the Community is based on trust.
    ">
    <meta name="keywords" content="fbi-ph.org, kpa21.info, ptxt4wrd.com">

    <meta property="og:description" content="OUR VISION A transformed and peaceful society where there is equality, debt-free, social justice and order for everyone.

    OUR MISSION To empower the people in the Community by organizing and uniting them through raising their social consciousness in preserving peace and order, actively participate in community development and nation building and enlightening them about financial awareness thus liberating them from the bondage of poverty and turning them self-reliant and making realize that the foundation of the Community is based on trust.
    " />
    <meta property="og:title" content="F3H Project - On-Going Registration" />
    <meta property="og:url" content="http://fbi-ph.org" />
    <meta property="og:type" content="website" />

    <meta name="twitter:title" content="F3H Project - On-Going Registration" />
    <meta name="twitter:site" content="http://fbi-ph.org" />
    <!--//END SEO -->

    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/fbi_dark_logo.png') }}"/>

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
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=239866523142614";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <img src="{{ asset('/images/fbi_dark_logo.png') }}" style="width: 256px;" title="FBI-PH.org" alt="FBI-PH.org">
                <h1 style="margin-top: 0px;">F3H<span style="color: #f2d06e;">PROJECT</span></h1>
                <h2 style="margin-top: -35px;" class="subtitle">ON-GOING REGISTRATION</h2>
                <style>
                    a.btn_v2 {
                        background: #3498db;
                        background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
                        background-image: -moz-linear-gradient(top, #3498db, #2980b9);
                        background-image: -ms-linear-gradient(top, #3498db, #2980b9);
                        background-image: -o-linear-gradient(top, #3498db, #2980b9);
                        background-image: linear-gradient(to bottom, #3498db, #2980b9);
                        -webkit-border-radius: 28;
                        -moz-border-radius: 28;
                        border-radius: 28px;
                        font-family: Arial;
                        color: #ffffff;
                        font-size: 37px;
                        padding: 10px 20px 10px 20px;
                        text-decoration: none;
                    }
                    a.btn_v2:hover {
                        background: #3498db;
                        text-decoration: none;
                    }
                </style>
                <div style="margin-top: 35px;">
                    <a href="http://web.fbi-ph.org/endorsement/link/78ac81cfae86880313195fbb934a28e5" class="btn_v2">JOIN NOW!</a>
                </div>
                <div style="margin-top: 35px;" id="countdown"></div>
            </div>
        </div>

        <div style="margin-top: -25px;" class="fb-page" data-href="https://www.facebook.com/filipinobayanihan" data-tabs="timeline" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/filipinobayanihan" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/filipinobayanihan">FBI in the Philippines</a></blockquote></div>

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
