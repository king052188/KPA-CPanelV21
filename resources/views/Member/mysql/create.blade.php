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
            <span>Create Database</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Create Database </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <form method="POST" action="/mysql/create-database-execute">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Database Name (required)</label>
                    <input type="text" id="database" name="database" placeholder="Database name here..."  required="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Attach Username (required)</label>
                    <select id="account" name="account">
                        <option value="0">-- Select Account --</option>
                        @for($i = 0; $i < COUNT($account); $i++)
                            <option value="{{ $account[$i]["username"] }}">{{ $account[$i]["username"] }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-12 form-group">
                    <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                    <a href="/mysql/create-database-username" id="btnAddAccount" class="btn btn-default">Add Username</a>
                </div>

                <div class="clearfix"> </div>
            </form>

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

@endsection