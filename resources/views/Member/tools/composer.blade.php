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
            <iframe src="http://composer.kpa21.com/?uid={{ $user_id }}" target="_parent" style="border:none; width: 100%; height: 600px;"></iframe>

        </div>

    </div>
    <!--//grid-->

    <style>
        .notifyjs-container div span {
            font-weight: 200;
            font-size: .8em;
        }

        #share_verify_msg table.username_verify_list tbody tr:last-child { background:#ff0000; }

        #output
        {
            font-family: Consolas, monaco, monospace;
            font-size: 16px;
            font-style: normal;
            font-variant: normal;
            line-height: 16 px;
            width:100%;
            height:300px;
            overflow-y:scroll;
            overflow-x:hidden;
            background: #2B2B2B;
            color: #F1F1F1;
        }
    </style>

    <!-- Jquery Core Js -->
    <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

    @if (session('message'))
        <script>
            var error_message = "{{ session('message') }}";
            $(document).ready(function() {
                $("#notifier_msg").notify(error_message);
            })
        </script>
    @endif

    <script type="text/javascript">
        $(document).ready(function(){
            check();
        });
        function url()
        {
            return 'http://localhost:8083/main.php';
        }
        function call(func)
        {

            $("#output").append("\nplease wait...\n");
            $("#output").append("\n===================================================================\n");
            $("#output").append("Executing Started");
            $("#output").append("\n===================================================================\n");
            $.post('http://localhost:8083/main.php',
                    {
                        "path":$("#path").val(),
                        "command":func,
                        "function": "command"
                    },
                    function(data)
                    {
                        $("#output").append(data);
                        $("#output").append("\n===================================================================\n");
                        $("#output").append("Execution Ended");
                        $("#output").append("\n===================================================================\n");
                    }
            );
        }
        function check()
        {
            $("#output").append('\nloading...\n');
            $.post(url(),
                    {
                        "function": "getStatus",
                        "password": $("#password").val()
                    },
                    function(data) {
                        if (data.composer_extracted)
                        {
                            $("#output").html("Ready. All commands are available.\n");
                            $("button").removeClass('disabled');
                        }
                        else if(data.composer)
                        {
                            $.post(url(),
                                    {
                                        "password": $("#password").val(),
                                        "function": "extractComposer",
                                    },
                                    function(data) {
                                        $("#output").append(data);
                                        window.location.reload();
                                    }, 'text');
                        }
                        else
                        {
                            $("#output").html("Please wait till composer is being installed...\n");
                            $.post(url(),
                                    {
                                        "password": $("#password").val(),
                                        "function": "downloadComposer",
                                    },
                                    function(data) {
                                        $("#output").append(data);
                                        check();
                                    }, 'text');
                        }
                    }
            );
        }
    </script>

@endsection