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
                choose_id = parseInt(id);
                $('#divContinue').show();
                $('#package').val(choose_id);
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

            <h3> Choose a Package Plan </h3>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Account Name</label>
                <input type="hidden" id="package" name="package" />
                <input type="text" id="account" name="account" value="{{ $user[0]->username }}" />
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Hosting that grows with your business.</h3>
                <p style="font-size: 13px; font-weight: 200; color: #7f7f7f;">We offer professional grade Windows Web Hosting to organizations, businesses and developers across the Globe. Our fast Web Hosting plans are equipped with the latest Laravel & .NET support and many more features listed below:</p>
             </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;"><a href="#demo" class="btn btn-info" data-toggle="collapse">More Features...</a></h3>
            </div>

            <div class="clearfix"> </div>

            <div id="demo" class="col-md-12 form-group2 group-mail collapse">
                <div class="col-md-12">
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5>Professional</h5>
                            <label>Laravel & .NET <span style="font-size: 18px; font-weight: 200; color: #B0B0B0;"><b>Framework</b> Web Hosting</span></label>
                        </div>
                        <div class="col-md-3 top-content1 features">
                            <h3>Top Features</h3>
                            <ul class="ul_list">
                                <li>100% Uptime Guarantee</li>
                                <li>Latest Laravel support</li>
                                <li>Latest ASP .NET support</li>
                                <li>Latest PHP support</li>
                                <li>FREE Hostname</li>
                                <li>FREE Client Portal</li>
                            </ul>
                        </div>
                        <div class="col-md-3 top-content1 features">
                            <h3>Support Features</h3>
                            <ul class="ul_list">
                                <li>Composer Installed</li>
                                <li>Laravel 4|5|5.1|5.2|5.3|5.4</li>
                                <li>.NET 2|3|3.5|4|4.5.2</li>
                                <li>PHP 5.3|5.4|5.5|5.6 & 7</li>
                                <li>MySQL Remote Access</li>
                                <li>MS ACCESS</li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                        {{--// --}}
                        <div class="col-md-12 top-content1">
                            <h2 style="font-size: 1.2em; color: #333; margin-bottom: 15px;">Why host with us?</h2>

                            <h3 style="font-size: 1em;">Easy Website Deployment!</h3>
                            <p style="font-size: .9em; font-weight: 200; color: #7f7f7f; margin: 5px 0 15px 0;">
                                Laradnet is here to help you to manage your server with hassle free. Instead, buying a cloud, vps or dedicated server and install everything to run your Laravel or MVC ASP.NET Project.
                                Laradnet you can deploy your project anytime you want, no need to create a vhost and do the complexity of configurations for Laravel and MVC ASP.NET.
                            </p>

                            <h3 style="font-size: 1em;">180 Days Risk Free Guarantee!</h3>
                            <p style="font-size: .9em; font-weight: 200; color: #7f7f7f; margin: 5px 0 15px 0;">We have a 180 DAYS RISK FREE guarantee on ALL shared plans. There is no risk for you to sign up and try our great service! Click here for the details.</p>

                            <h3 style="font-size: 1em;">24/7 Technical Support!</h3>
                            <p style="font-size: .9em; font-weight: 200; color: #7f7f7f; margin: 5px 0 15px 0;">We have 24/7 technical support, interactive step-by-step tutorials, and an extensive knowledge-base area. We can even provide you with assistance in transferring your site to us when needed.</p>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group2 group-mail">
                <h3 style="margin: 10px 0 3px 0;">Plan Packages | <span style="font-size: .8em;"><a href="#" id="show_usd">USD</a>/<a href="#" id="show_php">PHP</a></span></h3>
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

                                <div id="price_usd_{{ $i }}">
                                    <?php
                                    $price_annual = $packages[$i]->price_usd * 12;
                                    $annual_discount = $price_annual * $packages[$i]->discount;
                                    $new_price_annual = $price_annual - $annual_discount;
                                    ?>
                                    <h5 style="font-size: 1.6em; color: #c91a68; font-family: 'tahoma'; font-weight: 600;">${{ number_format($packages[$i]->price_usd, 2) }}<span style="font-size: .6em;">/mo</span></h5>
                                    <p>${{ number_format($new_price_annual, 2) }}<span style="font-size: .8em;">/yr</span> <span style="font-size: .9em; color: #c91a68;">${{ number_format($annual_discount, 2) }} saved</span></p>
                                </div>

                                <div id="price_php_{{ $i }}" style="display: none;">
                                    <?php
                                    $usd_php = $packages[$i]->price_usd * $packages[$i]->price_ph;
                                    $price_annual = $usd_php * 12;
                                    $annual_discount = $price_annual * $packages[$i]->discount;
                                    $new_price_annual = $price_annual - $annual_discount;
                                    ?>
                                    <h5 style="font-size: 1.6em; color: #c91a68; font-family: 'tahoma'; font-weight: 600;">₱{{ number_format($usd_php, 2) }}<span style="font-size: .6em;">/mo</span></h5>
                                    <p>₱{{ number_format($new_price_annual, 2) }}<span style="font-size: .8em;">/yr</span> <span style="font-size: .9em; color: #c91a68;">₱{{ number_format($annual_discount, 2) }} saved</span></p>
                                </div>

                                <br />
                                <p>{{ $packages[$i]->web }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->web > 1 ? "websites" : "website" }}</span></p>
                                    <p>{{ number_format($packages[$i]->disk, 0) }} GB <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">storage</span></p>
                                <p>{{ $packages[$i]->mysql }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->mysql > 1 ? "databases" : "database" }}</span></p>
                                <p>{{ $packages[$i]->ftp }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->ftp > 1 ? "ftp accounts" : "ftp account" }}</span></p>

                                @if($packages[$i]->port > 1)
                                <p>{{ $packages[$i]->port }} <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->port > 1 ? "ports (8000 - 8999)" : "port" }}</span></p>
                                @else
                                <p>NO <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">port</span></p>
                                @endif

                                <p>{{ $packages[$i]->hostname }} FREE <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">{{ $packages[$i]->hostname > 1 ? "hostnames" : "hostname" }}<br /><span style="font-size: .8em; color: #c91a68;">i.e.: YOUR-APP-NAME.cpv21-host.ddns.net</span></span></p>

                                <p>Unmetered <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">traffic</span></p>
                                <p>DDoS <span style="font-size: 1em; color: #7E7E7E; font-family: 'tahoma';">protected</span></p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="clearfix"> </div>

            <div id="divContinue" class="col-md-12 form-group" style="display: none;">
                <button id="btnPackagePlan" type="submit" class="btn btn-primary">Continue</button>
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
        var packages = {{ COUNT($packages) }}
        $(document).ready(function() {
            $( "#show_usd" ).click();
            $( "#show_php" ).click(function() {
                for(var i = 0; i < packages; i++){
                    $( "#price_usd_" + i ).hide();
                    $( "#price_php_" + i ).show();
                }
            });
            $( "#show_usd" ).click(function() {
                for(var i = 0; i < packages; i++){
                    $( "#price_usd_" + i ).show();
                    $( "#price_php_" + i ).hide();
                }
            });
        })
    </script>
@endsection