<!DOCTYPE HTML>
<html>
<?php
$url_secured = $helper["status"];
?>
<head>
    <title>FBI - Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="{{ asset('images/k-icon.png', $url_secured) }}" type="image/x-icon">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="{{ asset("/plugins/minimal_admin_panel/css/bootstrap.min.css", $url_secured) }}" rel='stylesheet' type='text/css' />
    <!-- Custom Theme files -->
    <link href="{{ asset("/plugins/minimal_admin_panel/css/style.css", $url_secured) }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset("/plugins/minimal_admin_panel/css/font-awesome.css", $url_secured) }}" rel="stylesheet">
    <script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.min.js", $url_secured) }}"> </script>
    <!-- Mainly scripts -->
    <script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.metisMenu.js", $url_secured) }}"></script>
    <script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.slimscroll.min.js", $url_secured) }}"></script>
    <!-- Custom and plugin javascript -->
    <link href="{{ asset("/plugins/minimal_admin_panel/css/custom.css", $url_secured) }}" rel="stylesheet">
    <script src="{{ asset("/plugins/minimal_admin_panel/js/custom.js", $url_secured) }}"></script>
    <script src="{{ asset("/plugins/minimal_admin_panel/js/screenfull.js", $url_secured) }}"></script>
    <script>
        $(function () {
            $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
            if (!screenfull.enabled) {
                return false;
            }
            $('#toggle').click(function () {
                screenfull.toggle($('#container')[0]);
            });
        });
    </script>
    <!----->
    <!--pie-chart--->
    <script src="{{ asset("/plugins/minimal_admin_panel/js/pie-chart.js", $url_secured) }}" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#3bb2d0',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#fbb03b',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ed6498',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });
        });
    </script>
    <!--skycons-icons-->
    <script src="{{ asset("/plugins/minimal_admin_panel/js/skycons.js", $url_secured) }}"></script>
    <!--//skycons-icons-->
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1> <a class="navbar-brand" href="/dashboard">FBI</a></h1>
        </div>

        <div class=" border-bottom">

            <div class="full-left">
                <section class="full-top">
                    {{--<button id="toggle"><i class="fa fa-arrows-alt"></i></button>--}}
                    <span style="color: #B3AEAE;"><i class="fa fa-barcode"></i> {{ $member[0]->hash_code }}</span>
                    {{--<input type="text" value="{{ $member[0]->hash_code }}" style="width: 310px;">--}}
                </section>
                <form class="navbar-left-right">
                    {{--<input type="text"  value="Search..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search...';}">--}}

                    {{--<input type="submit" value="" class="fa fa-search">--}}
                </form>
                <div class="clearfix"> </div>
            </div>

            <!-- Brand and toggle get grouped for better mobile display -->

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="drop-men" >
                <ul class=" nav_1">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown">
                            <span class=" name-caret">
                                @if($member[0]->role == 2)
                                    (ADMIN)
                                @elseif ($member[0]->role == 3)
                                    (SU-ADMIN)
                                @endif
                                {{ preg_replace('/\s+/', '', strtolower($member[0]->first_name)) . preg_replace('/\s+/', '', strtolower($member[0]->last_name)) }}<i class="caret"></i></span>
                            @if( (int)$member[0]->gender == 1)
                                <img src="{{ asset("/images/male_avatar.png", $url_secured) }}">
                            @else
                                <img src="{{ asset("/images/female_avatar.png", $url_secured) }}">
                            @endif
                        </a>
                        <ul class="dropdown-menu " role="menu">
                            <li><a href="/edit-profile?page=basic"><i class="fa fa-user"></i>Edit Profile</a></li>
                            <li><a href="/settings"><i class="fa fa-cog"></i>Settings</a></li>
                            <li><a href="/logout"><i class="fa fa-sign-in"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->

            <div class="clearfix"> </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="/dashboard" class=" hvr-bounce-to-right" ><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                        </li>

                        @if($member[0]->role > 1)
                            <li>
                                <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Members</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <style>
                                        .m_counts {
                                            padding: 2px 7px 2px 7px;
                                            border-radius: 5px;
                                        }
                                        .activated { background: #4267b2; color: #ffffff; }
                                        .on_processed { background: #F65A0C; color: #ffffff; }
                                        .pending { background: #EF0F7B; color: #ffffff; }
                                    </style>
                                    <li><a href="/members/activated" class=" hvr-bounce-to-right"> <i class="fa fa-users nav_icon"></i>Activated <span class="m_counts activated"> {{ number_format($activated, 0) }} </span></a></li>
                                    <li><a href="/members/on-processed" class=" hvr-bounce-to-right"> <i class="fa fa-users nav_icon"></i>On-Processed <span class="m_counts on_processed"> {{ number_format($on_processed, 0) }} </span></a></li>
                                    <li><a href="/members/pending" class=" hvr-bounce-to-right"> <i class="fa fa-users nav_icon"></i>Pending <span class="m_counts pending"> {{ number_format($pending, 0) }} </span></a></li>
                                </ul>
                            </li>
                        @endif

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Levels</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="#" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Graphs</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> <span class="nav-label">Message</span> </a>
                        </li>

                        <li><a href="#" class=" hvr-bounce-to-right"><i class="fa fa-question-circle nav_icon"></i>FAQ</a></li>

                        @if( IsSet($page["page"]) )
                            @if($page["page"] == "settings")
                                <li>
                                    <a href="/settings" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li><a href="/settings" class=" hvr-bounce-to-right"> <i class="fa fa-plus-square nav_icon"></i>General</a></li>
                                        <li><a href="/settings" class=" hvr-bounce-to-right"> <i class="fa fa-plus-square nav_icon"></i>Security</a></li>
                                    </ul>
                                </li>
                            @endif
                        @endif

                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">
            @yield("content")
            <div class="copy">
                <p> &copy; {{ date("Y") }} FB Inc. </p>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!---->
<!--scrolling js-->
<script src="{{ asset("/plugins/minimal_admin_panel/js/jquery.nicescroll.js", $url_secured) }}"></script>
<script src="{{ asset("/plugins/minimal_admin_panel/js/scripts.js", $url_secured) }}"></script>
<!--//scrolling js-->
<script src="{{ asset("/plugins/minimal_admin_panel/js/bootstrap.min.js", $url_secured) }}"> </script>
</body>
</html>

