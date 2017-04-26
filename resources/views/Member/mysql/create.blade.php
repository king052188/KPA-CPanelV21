@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <style>
        input#referral_link, span.referral_label {
            color: #B3AEAE;
        }

        .banner {

        }

        div.kpa_custom {
            margin-top: -6px;
            float: right;
        }

        .kpa_custom_mysql input[type=text] {
            width: 168px;
            padding: 10px 5px 10px 5px;
        }

        .kpa_custom_mysql button {
            width: 160px;;
        }

        @media  only screen and (max-width: 505px) {
            .banner {
                height: 150px;
            }

            .kpa_custom_mysql {
                margin-top: 15px;
                height: 20px;
            }

            .kpa_custom_mysql input[type=text] {
                text-align: center;
                margin-top: 5px;
                width: 100%;
                padding: 5px;
            }

            .kpa_custom_mysql button {
                margin-top: 5px;
                width: 100%;
            }
        }
    </style>

    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Create Database</span>
            <div class="kpa_custom">
                <div class="kpa_custom_mysql">
                    <input type="checkbox" id="ip_checkbox" /> Use IP |
                    <input type="text" id="mysqlConnection" value="mysql.ckt.kpa21.com" style="border: 0px;" disabled />
                    <button id="btnCopy" class="btn btn-default">COPY MySQL Host</button>
                    <script>
                        var copyTextareaBtn = document.querySelector('#btnCopy');
                        copyTextareaBtn.addEventListener('click', function(event) {
                            $('#mysqlConnection').removeAttr("disabled");

                            var copyTextarea = document.querySelector('#mysqlConnection');
                            copyTextarea.select();
                            try {
                                var successful = document.execCommand('copy');
                                var msg = successful ? 'successful' : 'unsuccessful';
                                console.log('Copying text command was ' + msg);
                            } catch (err) {
                                console.log('Oops, unable to copy');
                            }

                            $('#mysqlConnection').attr("disabled","disabled");
                        });

                        $(document).ready(function() {
                            $('#ip_checkbox').click(function(){
                                if($(this).prop('checked')){
                                    $('#mysqlConnection').val("69.4.84.226");
                                }else{
                                    $('#mysqlConnection').val("mysql-ckt.kpa21.com");
                                }
                            });

                            $( "#database" ).keyup(function() {
                                var m = $( "#database" ).val();
                                $( "#database_prefixes" ).val(db_prefix + m);
                            });
                        })
                    </script>
                </div>
            </div>

        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Create Database </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            {{--<form method="POST" action="/mysql/create-database-execute">--}}

                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Database Name (required)</label>
                    <input type="text" id="database" name="database" placeholder="Database name here..."  required="">
                </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Database with Prefixes</label>
                    <input type="text" id="database_prefixes" name="database_prefixes" disabled>
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
                    <button type="submit" id="btnSaveDatabase" class="btn btn-primary">Save</button>
                    <a href="/mysql/create-database-username" id="btnAddAccount" class="btn btn-default">Add Username</a>
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

@endsection