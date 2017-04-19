@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <!--banner-->
    <div class="banner">
        <h2>
            <a href="index.html">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Forms</span>
        </h2>
    </div>
    <!--//banner-->
    <!--grid-->
    <div class="grid-form">
        <div class="grid-form1">
            <h3 style="margin: 0; padding: 0;">Change Password</h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>
            <form id="form" method="POST" action="/settings/change-password">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Re-type New Password</label>
                    <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="Re-type New Password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-primary btn">Save</button>
                    <a href="/login" id="btnCancel" class="btn-default btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <!----->
    <style>
        label.error {
            font-weight: 200;
            font-size: .8em;
            color: #DD3A3A;
        }
        .notifyjs-container div span {
            font-weight: 200;
            font-size: .8em;
        }
    </style>
    <script src="{{ asset("plugins/bootstrap/jquery-validation/jquery.validate.js", $url_secured) }}"></script>
    <script>
        var error_message = "{{ session('message') }}";
        $(document).ready(function() {
            jQuery('#form').validate({
                rules : {
                    current_password : {
                        required: true,
                        minlength : 6
                    },
                    new_password : {
                        required: true,
                        minlength : 6
                    },
                    retype_password : {
                        required: true,
                        minlength : 6,
                        equalTo : "#new_password"
                    }
                }
            });
            $("#submit").click(function() {
                console.log($('#form').valid());
            })
        })
    </script>
    @if (session('message'))
        <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
        <script>
            var error_message = "{{ session('message') }}";
            $(document).ready(function() {
                $("#notifier_msg").notify(error_message);
            })
        </script>
    @endif
@endsection