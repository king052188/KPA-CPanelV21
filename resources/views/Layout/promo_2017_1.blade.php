<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Free WordPress | Webs.IO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset("css/promo.2017.1/style.css") }}">
    <style>
        .btn {
            color: #fff;
            background: limegreen;
            font-size: 20px;
            border: 0px;
            padding: 20px 20px 20px 20px;
            width: 100%;
            text-decoration: none;
            font-size: 21px;
            word-spacing: 1px;
        }
    </style>
    <script> var _code = "", _csrf = "", _csrf_token = "{{ csrf_token() }}";</script>
</head>
<body>
<div class="back"></div>

<div class="logo">
    <div class="inner">
        <img class="img-circle" src="{{ asset("images/webs-logo.png") }}" />
    </div>
</div>

<div class="registration-form">
    <header>
        <h1>Let's Get Started</h1>
        <p id="tag_line">Fill in all informations</p>
    </header>
    <!-- <form> -->

    <div class="input-section email-section">
        <input class="mobile" type="mobile" id="mobile" placeholder="Enter your mobile here" autocomplete="off"/>
        <div class="animated-button"><span class="icon-paper-plane"><i class="fa fa-mobile"></i></span><span class="next-button mobile"><i class="fa fa-arrow-up"></i></span></div>
    </div>

    <div class="success s_bg">
        <p>VALIDATING YOUR MOBILE#</p>
    </div>

    <div class="final f_bg">
        <button class="btn" id="btnProceed"> <i class="fa fa-paper-plane fa-1x"></i> Click here to Proceed</button>
    </div>

    <!-- </form> -->
</div>

<div class="footer">
    <div class="inner">
        <p>&copy; 2017 Webs.kpa.ph</p>
    </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script src="{{ asset("js/promo.2017.1/index.js") }}"></script>
</body>
</html>
