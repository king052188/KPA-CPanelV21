
<!--[if lt IE 7]>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<![endif]-->
<html>
<head>
    <!-- HTTPS required. HTTP will give a 403 forbidden response -->
    <script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
</head>
<body>
    <button onclick="smsLogin();">Login via SMS</button>
    <div>OR</div>
    <button onclick="emailLogin();">Login via Email</button>

    <form id="login_success" method="post" action="/login/execute/v2">
        <input id="_token" type="hidden" name="_token">
        <input id="csrf" type="text" name="csrf" />
        <input id="code" type="text" name="code" />
        <input type="submit" value="submit" />
    </form>

    <script>

    </script>

</body>
</html>