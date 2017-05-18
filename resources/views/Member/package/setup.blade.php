@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <style>

        .notifyjs-container div span {
            font-weight: 200;
            font-size: .8em;
        }
        .checking {
            font-weight: 200;
            color: #B3AEAE;
        }
        #share_verify_msg table.username_verify_list tbody tr:last-child { background:#ff0000; }

        #package_info .col-md-3 .content-top-1:hover {
            background: #F2FFEF;
        }

        .selected_package {
            background: #F2FFEF;
        }

        .not_available {
            background: #e4dede;
        }

        div.features h3 {
            font-size: 1.2em;
        }

        div.features ul {
            list-style-image: url('{{ asset('/images/checked.png') }}');
            padding: 10px 0 0 25px;
        }

        div.features ul li {
            padding: 0 0 0 0;
            font-size: .9em;
        }

        .selected_checked_icon {
            float: right;
            margin-top: -45px;
            margin-right: -95px;
            width: 96px;
            height: 96px;
        }

        .selected_checked_icon_2 {
            float: right;
            margin-top: 50px;
            margin-right: -95px;
            width: 96px;
            height: 96px;
        }

        .selected_checked_icon_3 {
            float: right;
            margin-top: 60px;
            margin-right: -95px;
            width: 96px;
            height: 96px;
        }
    </style>
    <script>
        var last_id = 0, last_status_id = 0;
        var choose_id = 0;
        function event_click(id) {
            var status = document.getElementById("package_id" + id).getAttribute("data-status");
            var current_id = parseInt(status);

            $(document).ready(function() {
                if(last_id == 0) {
                    last_id = parseInt(id);
                    last_status_id = parseInt(status);
                }
                else {
                    $('#checked_id'+last_id).removeAttr("style");
                    $('#checked_id'+last_id).attr("style", "display: none;");
                    $('#package_id'+last_id).removeAttr("class");

                    if(last_status_id == 3) {
                        $('#package_id'+last_id).attr("class", "content-top-1 likeit_package");
                    }
                    else if(last_status_id == 4) {
                        $('#package_id'+last_id).attr("class", "content-top-1 loveit_package");
                    }
                    else {
                        $('#package_id'+last_id).attr("class", "content-top-1");
                    }
                    last_id = parseInt(id);
                    last_status_id = parseInt(status);
                }

                $('#divContinue').hide();
                $('#region_id').val(0);

                var selected_class = "not_available";
                if(current_id == 2) {
                    selected_class = "selected_package";
                    $('#divContinue').show();
                    choose_id = parseInt(id);
                    $('#region_id').val(choose_id);
                }

                $('#package_id'+id).removeAttr("class");
                $('#package_id'+id).attr("class", "content-top-1 " + selected_class);
                $('#checked_id'+id).removeAttr("style");
                $('#checked_id'+id).attr("style", "display: block;");

            })
        }
    </script>
    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Setup a Package Plan</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Server Credentials </h3>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Userame</label>
                <input type="hidden" id="package_id" name="package_id" value="{{ $package["id"] }}" />
                <input type="hidden" id="region_id" name="region_id" />
                <input type="text" id="account" name="account" value="{{ $user[0]->username }}" disabled />
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Password</label>
                <input type="text" id="account" name="account" placeholder="Password" />
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Confirm Password</label>
                <input type="text" id="account" name="account" placeholder="Confirm Password" />
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Data Center Region</h3>
                <p style="font-size: .8em;">Just click one of our region and it will highlight.</p>
            </div>

            <div class="clearfix"> </div>

            <div id="package_info" class="col-md-12 form-group1 group-mail" >
                @for($i = 0; $i < COUNT($servers); $i++)
                    <div class="col-md-3">
                        <?php
                        $class = "";
                        if($servers[$i]->status == 3) {
                            $class = "coming_soon";
                        }
                        elseif ($servers[$i]->status  == 4) {
                            $class = "not_available";
                        }
                        ?>
                        @if($servers[$i]->status == 3)
                            <div id="package_id{{ $servers[$i]->Id }}" data-status="3" onclick="event_click({{ $servers[$i]->Id }})" class="content-top-1">
                                <div class="col-md-11 top-content">
                                    <img id="most_selected_id{{ $servers[$i]->Id }}" class="selected_checked_icon" src="http://icons.iconarchive.com/icons/graphicloads/100-flat/128/warning-icon.png" alt="Like it!" />
                                    <img id="checked_id{{ $servers[$i]->Id }}" class="selected_checked_icon_3" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat/128/close-icon.png" alt="Selected" />
                                    <h5>Region Coming Soon</h5>
                                    <label>{{ $servers[$i]->region }}</label>
                                    <p>{{ $servers[$i]->country }}</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        @elseif($servers[$i]->status == 4)
                            <div id="package_id{{ $servers[$i]->Id }}" data-status="4" onclick="event_click({{ $servers[$i]->Id }})" class="content-top-1">
                                <div class="col-md-11 top-content">
                                    <img id="most_selected_id{{ $servers[$i]->Id }}" class="selected_checked_icon" src="http://icons.iconarchive.com/icons/graphicloads/100-flat/128/close-2-icon.png" alt="Love it!" />
                                    <img id="checked_id{{ $servers[$i]->Id }}" class="selected_checked_icon_3" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat/128/close-icon.png" alt="Selected" />
                                    <h5>Region Not Available</h5>
                                    <label>{{ $servers[$i]->region }}</label>
                                    <p>{{ $servers[$i]->country }}</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        @else
                            <div id="package_id{{ $servers[$i]->Id }}" data-status="2" onclick="event_click({{ $servers[$i]->Id }})" class="content-top-1">
                                <div class="col-md-11 top-content">
                                    <img id="checked_id{{ $servers[$i]->Id }}" class="selected_checked_icon" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/96/check-1-icon.png" alt="Selected" />
                                    <h5>Region</h5>
                                    <label>{{ $servers[$i]->region }}</label>
                                    <p>{{ $servers[$i]->country }}</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Operating System | Control Panel</h3>
                <p style="font-size: .8em;">Just click one of our region and it will highlight.</p>
            </div>

            <div class="clearfix"> </div>

            <div id="package_info" class="col-md-12 form-group1 group-mail" >
                <div class="col-md-4">
                    <div id="windows_server_2012r2" data-status="2" class="content-top-1 selected_package">
                        <div class="col-md-11 top-content">
                            <img class="selected_checked_icon" src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/96/check-1-icon.png" alt="Selected" />
                            <h5>Operating System</h5>
                            <label>Windows Server</label>
                            <p>2012 r2</p>
                            <br />
                            <p>+dotNet & Laravel Framework</p>
                            <p>+Composer Installed</p>
                            <p>+CPanelV21</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"> </div>

            <div id="divContinue" class="col-md-12 form-group" style="display: none;">
                <button id="btnCreateServer" type="submit" class="btn btn-primary">Create Server</button>
                <a href="/logout" class="btn btn-default">Cancel</a>
            </div>

            <div class="clearfix"> </div>

        </div>

    </div>
    <!--//grid-->

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