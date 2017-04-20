@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    header('X-Frame-Options: GOFORIT');
    header('X-Frame-Options: ALLOW');
    ?>

    <iframe src="http://localhost:33060" target="_parent" style="border:none; width: 100%; height: 500px;"></iframe>

@endsection