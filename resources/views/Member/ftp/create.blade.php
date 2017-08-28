@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <script>
        var u_name = null, u_role = 0, d_name = null, s_uid = 0;
        var ftp_hostname = "{{ $configs["FTP_Hosts"]["hostname"] }}";
        var ftp_ip_address = "{{ $configs["FTP_Hosts"]["ip_address"] }}";
    </script>
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
            <span>Create FTP Account</span>
            <div class="kpa_custom">
                <div class="kpa_custom_mysql">
                    <input type="checkbox" id="ip_checkbox" /> Use IP |
                    <input type="text" id="mysqlConnection" value="ftp.ckt.kpa21.com" style="border: 0px;" disabled />
                    <button id="btnCopy" class="btn btn-default">COPY FTP Host</button>
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
                                $('#btnCopy').text("COPIED FTP HOST");
                            } catch (err) {
                                console.log('Oops, unable to copy');
                            }

                            $('#mysqlConnection').attr("disabled","disabled");
                        });

                        var root_path = "";
                        var app_name = "";
                        var sub_name = "";

                        $(document).ready(function() {
                            $('#mysqlConnection').val(ftp_hostname);
                            $('#ip_checkbox').click(function(){
                                if($(this).prop('checked')){
                                    $('#mysqlConnection').val(ftp_ip_address);
                                }else{
                                    $('#mysqlConnection').val(ftp_hostname);
                                }
                            });

                            root_path = "\\{{ $user[0]->username }}\\";

                            $( "#app_path" ).change(function() {
                                app_name = $( "#app_path" ).val();
                                if(app_name == "0") {
                                    return false;
                                }

                                if(app_name != "1") {
                                    $( "#app_name" ).val("");
                                    $( "#div_app_name" ).hide();
                                    $( "#ftp_dir" ).val(root_path + app_name + sub_name);
                                }
                                else {
                                    app_name = "";
                                    $( "#app_name" ).val("");
                                    $( "#div_app_name" ).show();
                                    $( "#ftp_dir" ).val(root_path + app_name + sub_name);
                                }
                            });

                            $( "#app_name" ).keyup(function() {
                                app_name = $( "#app_name" ).val() + "\\";
                                $( "#ftp_dir" ).val(root_path + app_name + sub_name);
                            });

                            $( "#sub_name" ).keyup(function() {
                                sub_name = $( "#sub_name" ).val();
                                $( "#ftp_dir" ).val(root_path + app_name + sub_name);
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

            <h3> Create FTP Account </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">FTP Home Directory</label>
                <input type="text" id="ftp_dir" name="ftp_dir" disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">FTP Directory (required)</label>
                <select id="app_path" name="app_path">
                    <option value="0">-- Select Account --</option>
                    <optgroup label="Application Lists">WebSite Lists</optgroup>
                    @for($i = 0; $i < COUNT($web); $i++)
                        <option value="{{ $web[$i]["site_name"] }}\">{{ $web[$i]["site_name"] }}</option>
                    @endfor
                    <optgroup label="New Application">New WebSite</optgroup>
                    <option value="1">Create New Application</option>
                </select>
            </div>

            <div id="div_app_name" class="col-md-12 form-group1 group-mail" style="display: none;">
                <label class="control-label">Application Name (required)</label>
                <input type="text" id="app_name" name="app_name" placeholder="Application name I.e.: your-domain.com" required>
            </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Sub-folder Name (Optional)</label>
                <input type="text" id="sub_name" name="sub_name" placeholder="Sub-folder name I.e.: www or html">
            </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Username (required)</label>
                <input type="text" id="username" name="username" placeholder="Username here..."  required>
            </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Password (required)</label>
                <input type="password" id="password1" name="password1" placeholder="Password here..."  required>
            </div>
            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Re-type password (required)</label>
                <input type="password" id="password2" name="password2" placeholder="Re-type password here..."  required>
            </div>

            @if($ftp["available"] > 0)
                <div class="col-md-12 form-group">
                    <button type="submit" id="btnSaveFTP" class="btn btn-primary">Save</button>
                    <a href="/ftp/lists" class="btn btn-default">Cancel</a>
                </div>
            @else
                <div class="col-md-12 form-group">
                    <span class="btn btn-danger">Oops, No Available FTP Credits</span>
                    <a href="/dashboard" class="btn btn-default">Cancel</a>
                </div>
            @endif

            <div class="clearfix"> </div>

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

        #share_verify_msg table.username_verify_list tbody tr:last-child { background:#ff0000; }
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

@endsection