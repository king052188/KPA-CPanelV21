@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>

    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Add User Privileges</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">
        <div class="validation-form">
            <h3> Add User Privileges </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>
            <br />
            {{--<form id="form" method="POST" action="/mysql/create-database-username-execute">--}}

            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Username (required)</label>
                <select id="username" name="username">
                    <option value="0">-- Select Username --</option>
                    @for($i = 0; $i < COUNT($username); $i++)
                        <option value="{{ $username[$i]["role"] }}:{{ $username[$i]["username"] }}">{{ $username[$i]["username"] }}</option>
                    @endfor
                </select>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Database (required)</label>
                <select id="database" name="database">
                    <option value="0">-- Select Database --</option>
                    @for($i = 0; $i < COUNT($database); $i++)
                        <option value="{{ $database[$i]["database_name"] }}">{{ $database[$i]["database_name"] }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-12 form-group">
                <button type="submit" id="btnSaveAccountPrivileges" class="btn btn-primary">Save</button>
                <a href="/mysql/create-database" id="btnAddAccount" class="btn btn-default">Cancel</a>
            </div>

            <div class="clearfix"> </div>
            {{--</form>--}}

        </div>
    </div>
    <!--//grid-->
    <style>
        .notifyjs-container div span {
            font-weight: 200;
            font-size: .8em;
        }

        .checking {
            font-weight: 200;
            font-size: .8em;
            color: #DD3A3A;
        }
    </style>
    <!-- Jquery Core Js -->
    {{--<script src="{{ asset("js/jquery-3.1.1.min.js", $url_secured) }}"></script>--}}
    <script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
    @if (session('message'))
        <script>
            var error_message = "{{ session('message') }}";
            $(document).ready(function() {
                $("#notifier_msg").notify(error_message);
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            var m1 = $( "#password1" );
            var m2 = $( "#password2" )
            m1.keyup(function() {
                var m = m1.val();
                if(m.length < 6 || m.length > 10) {
                    $("#span_password1").show();
                    $("#span_password1").text("Please enter a valid password and limit 6 or 8 length.");

//                    $("#form").removeAttr("action");
//                    $("#form").removeAttr("method");
                    $("#btnSave").attr("disabled", "disabled");
                }
                else {
                    $("#span_password1").hide();
                    $("#span_password1").text();
                    validate_password();
                }
            });
            m2.keyup(function() {
                validate_password();
            })
            function validate_password() {
                if(m2.val() != m1.val()) {
                    $("#span_password2").show();
                    $("#span_password2").text("Password did not match.");

//                    $("#form").removeAttr("action");
//                    $("#form").removeAttr("method");
                    $("#btnSave").attr("disabled", "disabled");
                }
                else {
                    $("#span_password2").hide();
                    $("#span_password2").text();

//                    $("#form").attr("action", "/mysql/create-database-username-execute");
//                    $("#form").attr("method", "POST");
                    $("#btnSave").removeAttr("disabled");
                }
            }
        })
    </script>
@endsection