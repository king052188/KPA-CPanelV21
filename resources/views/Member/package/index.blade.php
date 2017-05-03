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

        .loveit_package {
            background: #FFEBEB;
        }

        .likeit_package {
            background: #EFF4FF;
        }

        .selected_checked_icon {
            float: right;
            margin-top: -45px;
            margin-right: -85px;
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
                $('#package_id'+id).removeAttr("class");
                $('#package_id'+id).attr("class", "content-top-1 selected_package");

                $('#checked_id'+id).removeAttr("style");
                $('#checked_id'+id).attr("style", "display: block;");

                $('#divContinue').show();
                choose_id = parseInt(id);
            })
        }
    </script>
    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Setup Package Plan</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Choose a Package Plan </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Account Name</label>
                <input type="text" id="account" name="account" value="{{ $user[0]->username }}">
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Hosting that grows with your business.</h3>
                <p style="font-size: .8em;">We offer professional grade Windows Web Hosting to organizations, businesses and developers across the Globe. Our fast Web Hosting plans are equipped with the latest Laravel & .NET support and many more features listed below:</p>
            </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;"><a href="#demo" class="btn btn-info" data-toggle="collapse">More Features</a></h3>

            </div>

            <div class="clearfix"> </div>

            <div id="demo" class="col-md-12 form-group2 group-mail collapse">
                <div class="col-md-12">
                    <div class="content-top-1">

                        <div class="col-md-6 top-content">
                            <h5>Professional</h5>
                            <label>Laravel & .NET <span style="font-size: 18px; font-weight: 200; color: #B0B0B0;"><b>Framework</b> Web Hosting</span></label>
                        </div>
                        <div class="col-md-3 top-content1">
                            <h3>Top Features</h3>
                            <ul>
                                <li>100% Uptime Guarantee</li>
                                <li>Latest ASP .NET support</li>
                                <li>Latest Laravel support</li>
                                <li>Latest PHP support</li>
                                <li>FREE Hostname</li>
                            </ul>
                        </div>
                        <div class="col-md-3 top-content1">
                            <h3>Support Features</h3>
                            <ul>
                                <li>Composer Installed</li>
                                <li>.NET 2|3|3.5|4|4.5.2</li>
                                <li>Laravel 4|5|5.1|5.2|5.3|5.4</li>
                                <li>PHP 5.3|5.4|5.5|5.6 & 7</li>
                                <li>MySQL Stored Procedures</li>
                                <li>MySQL Remote Access</li>
                                <li>MS ACCESS Support</li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>

                    </div>

                    <div class="content-top-1">

                        <div class="col-md-6 top-content">
                            <h5>Professional</h5>
                            <label>Laravel & .NET <span style="font-size: 18px; font-weight: 200; color: #B0B0B0;"><b>Framework</b> Web Hosting</span></label>
                        </div>
                        <div class="col-md-4 top-content1">
                            <h3>Top Features</h3>
                            <ul>
                                <li>100% Uptime Guarantee</li>
                                <li>Latest ASP .NET support</li>
                                <li>Latest Laravel support</li>
                                <li>Latest PHP support</li>
                                <li>FREE Hostname</li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Plan Packages</h3>
                <p style="font-size: .8em;">Just click one of our packages and it will highlight.</p>
            </div>

            <div class="clearfix"> </div>

            <div id="package_info" class="col-md-12 form-group1 group-mail" >
                @for($i = 0; $i < COUNT($packages); $i++)
                    <div class="col-md-3">
                        <?php
                            $class = "";
                            if($packages[$i]->status == 3) {
                                $class = "likeit_package";
                            }
                            elseif ($packages[$i]->status  == 4) {
                                $class = "loveit_package";
                            }
                        ?>
                        <div id="package_id{{ $packages[$i]->Id }}" data-status="{{ $packages[$i]->status }}" onclick="event_click({{ $packages[$i]->Id }})" class="content-top-1 {{ $class }}">
                            <div class="col-md-11 top-content">
                                @if($packages[$i]->status == 3)
                                    <img id="most_selected_id{{ $packages[$i]->Id }}" class="selected_checked_icon" src="https://cdn4.iconfinder.com/data/icons/ballicons-2-free/100/like-128.png" alt="Like it!" />
                                    <img id="checked_id{{ $packages[$i]->Id }}" class="selected_checked_icon_3" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/96/check-1-icon.png" alt="Selected" />
                                    <h5>Plan Most Like It!</h5>
                                @elseif($packages[$i]->status == 4)
                                    <img id="most_selected_id{{ $packages[$i]->Id }}" class="selected_checked_icon" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/96/favorite-icon.png" alt="Love it!" />
                                    <img id="checked_id{{ $packages[$i]->Id }}" class="selected_checked_icon_2" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/96/check-1-icon.png" alt="Selected" />
                                    <h5>Plan Most Love It!</h5>
                                @else
                                    <img id="checked_id{{ $packages[$i]->Id }}" class="selected_checked_icon" style="display: none;" src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/96/check-1-icon.png" alt="Selected" />
                                    <h5>Plan</h5>
                                @endif
                                <label>{{ $packages[$i]->code_name }}</label>
                                <p>As low as</p>
                                <h5 style="font-size: 1.6em; color: #ef6c0f; font-family: 'tahoma'; font-weight: 600;">${{ number_format($packages[$i]->price_usd, 2) }}<span style="font-size: .6em;">/mo</span></h5>
                                <br />
                                <p>{{ $packages[$i]->web }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->web > 1 ? "websites" : "website" }}</span></p>
                                <p>{{ $packages[$i]->mysql }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->mysql > 1 ? "databases" : "database" }}</span></p>
                                <p>{{ $packages[$i]->ftp }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->ftp > 1 ? "ftp accounts" : "ftp account" }}</span></p>
                                <p>{{ number_format($packages[$i]->disk, 0) }} GB <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">storage</span></p>
                                <p>Unmetered <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">traffic</span></p>
                                <p>DDoS <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">protected</span></p>
                                <p>{{ $packages[$i]->web }} FREE <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">hostname<br /><i style="font-size: .8em; color: #ef6c0f;">i.e.: YOUR-APP-NAME.cpv21-host.ddns.net</i></span></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                @endfor
            </div>

            {{--<link rel="stylesheet" href="{{ asset('css/table-responsive.css') }}">--}}
            {{--<script src="http://zurb.com/playground/projects/responsive-tables/responsive-tables.js"></script>--}}

            {{--<div class="col-md-12 form-group1 group-mail">--}}
                {{--<table id="packages_plan" class="responsive" style="width: 100%;">--}}
                    {{--<tr>--}}
                        {{--<th style="text-align: right; width: 190px; border-bottom: 1px solid #F0F0F0;">Package</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Web Site</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">MySQL</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">FTP</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Storage</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Bandwidth</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">DDoS Protection</th>--}}
                        {{--<th id="usd_price_th" style="text-align: center; border-bottom: 1px solid #F0F0F0;">USD | <a href="#" id="show_php">PHP</a></th>--}}
                        {{--<th id="php_price_th" style="text-align: center; border-bottom: 1px solid #F0F0F0; display: none;"><a href="#" id="show_usd">USD</a> | PHP</th>--}}
                        {{--<th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Action</th>--}}
                    {{--</tr>--}}
                    {{--@for($i = 0; $i < COUNT($packages); $i++)--}}
                        {{--<tr>--}}
                            {{--<td style="text-align: right; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->code_name }}</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->web }}</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->mysql }}</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->ftp }}</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ number_format($packages[$i]->disk, 2) }} GB</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">Unmetered</td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;">YES</td>--}}
                            {{--<td id="usd_price_{{ $i }}" style="text-align: right; border-bottom: 1px solid #F0F0F0;">{{ number_format($packages[$i]->price_usd, 2) }}<span style="font-size: 13px; color: #C5C5C5;"> /month</span></td>--}}
                            {{--<td id="php_price_{{ $i }}" style="text-align: right; border-bottom: 1px solid #F0F0F0; display: none;">{{ number_format($packages[$i]->price_ph, 2) }}<span style="font-size: 13px; color: #C5C5C5;"> /month</span></td>--}}
                            {{--<td style="text-align: center; border-bottom: 1px solid #F0F0F0;"><button type="submit" onclick="event_click({{ $packages[$i]->Id }})" id="btnChoose_{{ $packages[$i]->Id }}" class="btn btn-warning">Choose</button></td>--}}
                        {{--</tr>--}}
                    {{--@endfor--}}

                {{--</table>--}}
            {{--</div>--}}

            <div class="clearfix"> </div>

            <div id="divContinue" class="col-md-12 form-group" style="display: none;">
                <button type="submit" class="btn btn-primary">Continue</button>
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
    <script>
        var package ;
        $(document).ready(function() {

            var total_packages = {{ COUNT($packages) }};
            $( "#show_php" ).click(function() {
                $( "#usd_price_th" ).hide();
                $( "#php_price_th" ).show();
                for(var i = 0; i < total_packages; i++){
                    $( "#usd_price_" + i ).hide();
                    $( "#php_price_" + i ).show();
                }
            });

            $( "#show_usd" ).click(function() {
                $( "#usd_price_th" ).show();
                $( "#php_price_th" ).hide();
                for(var i = 0; i < total_packages; i++){
                    $( "#php_price_" + i ).hide();
                    $( "#usd_price_" + i ).show();
                }
            });

            $( "#packages" ).change(function() {
                package = $( "#packages" ).val();
                if(package == "0") {
                    $( "#package_info" ).hide();
                    return false;
                }
                var packages = package.split(":");
                $( "#package_info" ).show();
                var text = '<p style=" margin: 0 0 0 0; color: #B3AEAE;">';
                text += '-> Package Plan: <span style=" color: #3FD64B;">' + packages[0] + '</span> <br />';
                text += '-> <span style=" color: #3FD64B;">' + packages[2] + '</span> Web Site/s <br />';
                text += '-> <span style=" color: #3FD64B;">' + packages[4] + '</span> FTP Account/s<br />';
                text += '-> <span style=" color: #3FD64B;">' + packages[3] + '</span> MySQL Database/s<br />';
                text += '-> <span style=" color: #3FD64B;">' + packages[1] + '</span> GB Storage Disk<br />';
                text += '-> <span style=" color: #3FD64B;">' + packages[5] + '</span> USD / Month<br />';
                text += '</p>';
                $('#package_info').empty().prepend(text);
            });
        })
    </script>

@endsection