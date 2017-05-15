@extends("layout.portal")

@section("content")
    <?php
        $url_secured = $helper["status"];
        $user_id = $user[0]->Id
    ?>
    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Create FTP Account</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">
        <div class="validation-form">
            <h3> Composer </h3>
            <iframe src="http://composer.kpa21.com/?app={{ $user_id }}" target="_parent" style="border:none; width: 100%; height: 600px;"></iframe>
        </div>
    </div>
    <!--//grid-->

@endsection