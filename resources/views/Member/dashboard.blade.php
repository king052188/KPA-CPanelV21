@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <!--banner-->
    <a href="#" id="modal_event" class="btn btn-blue btn-lg btn-huge lato" data-toggle="modal" data-target="#myModal" style="display: none;"></a>
    <div class="banner" >
        <h2>
            {{--<a href="index.html">Home</a>--}}
            <i class="fa fa-angle-right"></i>
            <span>Dashboard</span>
        </h2>
    </div>
    <!--//banner-->

    <!--pie-chart-->
    <script src="{{ asset("/js/numeral.min.js", $url_secured) }}" type="text/javascript"></script>
    <script src="{{ asset("/plugins/minimal_admin_panel/js/pie-chart.js", $url_secured) }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#disk').pieChart({
                barColor: '#3bb2d0',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(numeral(percent).format('0,0.0') + '%');
                }
            });

            $('#web').pieChart({
                barColor: '#fbb03b',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(numeral(percent).format('0,0.0') + '%');
                }
            });

            $('#mysql').pieChart({
                barColor: '#ed6498',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(numeral(percent).format('0,0.0') + '%');
                }
            });

            $('#ftp').pieChart({
                barColor: '#94EA60',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(numeral(percent).format('0,0.0') + '%');
                }
            });
        });
    </script>
    <!--skycons-icons-->

    <!--content-->
    <div class="content-top">

        <div class="col-md-6 ">

            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Disk</h5>
                    <label>
                        @if((double)$statistics["Disk"]["Quota"] > 0)
                            {{ number_format($statistics["Disk"]["Available"], 2) }} GB <span style="font-size: 15px; font-weight: 200; color: #B0B0B0;">/ {{ number_format($statistics["Disk"]["Quota"], 2) }} GB</span>
                        @else
                            Unlimited GB
                        @endif
                    </label>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if($statistics["Disk"]["Quota"] > 0) {
                        $used = $statistics["Disk"]["Used"];
                        if($used == 0) {
                            $p = 0;
                        }
                        else {
                            $p = $used / $statistics["Disk"]["Quota"];
                            $p = $p * 100;
                        }
                    }
                    else {
                        $p = $statistics["Disk"]["Used"];
                    }
                    ?>
                    <div id="disk" class="pie-title-center" data-percent="{{ $p }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Website</h5>
                    <label>
                        @if((double)$statistics["Website"]["Quota"] > 0)
                            {{ $statistics["Website"]["Available"] }} <span style="font-size: 15px; font-weight: 200; color: #B0B0B0;">/ {{ $statistics["Website"]["Quota"] }}</span>
                        @else
                            Unlimited
                        @endif
                    </label>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if($statistics["Website"]["Quota"] > 0) {
                        $used = $statistics["Website"]["Used"];
                        if($used == 0) {
                            $p = 0;
                        }
                        else {
                            $p = $used / $statistics["Website"]["Quota"];
                            $p = $p * 100;
                        }
                    }
                    else {
                        $p = $statistics["Website"]["Used"];
                    }
                    ?>
                    <div id="web" class="pie-title-center" data-percent="{{ $p }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>

        </div>

        <div class="col-md-6 ">

            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>MySQL</h5>
                    <label>
                    @if((double)$statistics["MySQL"]["Quota"] > 0)
                        {{ $statistics["MySQL"]["Available"] }} <span style="font-size: 15px; font-weight: 200; color: #B0B0B0;">/ {{ $statistics["MySQL"]["Quota"] }}</span>
                    @else
                        Unlimited
                    @endif
                    </label>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if($statistics["MySQL"]["Quota"] > 0) {
                        $used = $statistics["MySQL"]["Used"];
                        if($used == 0) {
                            $p = 0;
                        }
                        else {
                            $p = $used / $statistics["MySQL"]["Quota"];
                            $p = $p * 100;
                        }
                    }
                    else {
                        $p = $statistics["MySQL"]["Used"];
                    }
                    ?>
                    <div id="mysql" class="pie-title-center" data-percent="{{ $p }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>FTP</h5>
                    <label>
                    @if((double)$statistics["FTP"]["Quota"] > 0)
                        {{ $statistics["FTP"]["Available"] }} <span style="font-size: 15px; font-weight: 200; color: #B0B0B0;">/ {{ $statistics["FTP"]["Quota"] }}</span>
                    @else
                        Unlimited
                    @endif
                    </label>
                </div>
                <div class="col-md-6 top-content1">
                    <?php
                    if($statistics["FTP"]["Quota"] > 0) {
                        $used = $statistics["FTP"]["Used"];
                        if($used == 0) {
                            $p = 0;
                        }
                        else {
                            $p = $used / $statistics["FTP"]["Quota"];
                            $p = $p * 100;
                        }
                    }
                    else {
                        $p = $statistics["FTP"]["Used"];
                    }
                    ?>
                    <div id="ftp" class="pie-title-center" data-percent="{{ $p }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>

        </div>

        <div class="clearfix"> </div>
    </div>
    <!---->
    <div class="content-bottom">
        <div class="col-md-5">
            <div class="cal1 cal_2"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><p class="clndr-previous-button">previous</p></div><div class="month">July 2015</div><div class="clndr-control-button rightalign"><p class="clndr-next-button">next</p></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day adjacent-month last-month calendar-day-2015-06-28"><div class="day-contents">28</div></td><td class="day adjacent-month last-month calendar-day-2015-06-29"><div class="day-contents">29</div></td><td class="day adjacent-month last-month calendar-day-2015-06-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-01"><div class="day-contents">1</div></td><td class="day calendar-day-2015-07-02"><div class="day-contents">2</div></td><td class="day calendar-day-2015-07-03"><div class="day-contents">3</div></td><td class="day calendar-day-2015-07-04"><div class="day-contents">4</div></td></tr><tr><td class="day calendar-day-2015-07-05"><div class="day-contents">5</div></td><td class="day calendar-day-2015-07-06"><div class="day-contents">6</div></td><td class="day calendar-day-2015-07-07"><div class="day-contents">7</div></td><td class="day calendar-day-2015-07-08"><div class="day-contents">8</div></td><td class="day calendar-day-2015-07-09"><div class="day-contents">9</div></td><td class="day calendar-day-2015-07-10"><div class="day-contents">10</div></td><td class="day calendar-day-2015-07-11"><div class="day-contents">11</div></td></tr><tr><td class="day calendar-day-2015-07-12"><div class="day-contents">12</div></td><td class="day calendar-day-2015-07-13"><div class="day-contents">13</div></td><td class="day calendar-day-2015-07-14"><div class="day-contents">14</div></td><td class="day calendar-day-2015-07-15"><div class="day-contents">15</div></td><td class="day calendar-day-2015-07-16"><div class="day-contents">16</div></td><td class="day calendar-day-2015-07-17"><div class="day-contents">17</div></td><td class="day calendar-day-2015-07-18"><div class="day-contents">18</div></td></tr><tr><td class="day calendar-day-2015-07-19"><div class="day-contents">19</div></td><td class="day calendar-day-2015-07-20"><div class="day-contents">20</div></td><td class="day calendar-day-2015-07-21"><div class="day-contents">21</div></td><td class="day calendar-day-2015-07-22"><div class="day-contents">22</div></td><td class="day calendar-day-2015-07-23"><div class="day-contents">23</div></td><td class="day calendar-day-2015-07-24"><div class="day-contents">24</div></td><td class="day calendar-day-2015-07-25"><div class="day-contents">25</div></td></tr><tr><td class="day calendar-day-2015-07-26"><div class="day-contents">26</div></td><td class="day calendar-day-2015-07-27"><div class="day-contents">27</div></td><td class="day calendar-day-2015-07-28"><div class="day-contents">28</div></td><td class="day calendar-day-2015-07-29"><div class="day-contents">29</div></td><td class="day calendar-day-2015-07-30"><div class="day-contents">30</div></td><td class="day calendar-day-2015-07-31"><div class="day-contents">31</div></td><td class="day adjacent-month next-month calendar-day-2015-08-01"><div class="day-contents">1</div></td></tr></tbody></table></div></div>
            <!----Calender -------->
            <link rel="stylesheet" href="{{ asset("/plugins/minimal_admin_panel/css/clndr.css", $url_secured) }}" type="text/css" />
            <script src="{{ asset("/plugins/minimal_admin_panel/js/underscore-min.js", $url_secured) }}" type="text/javascript"></script>
            <script src="{{ asset("/plugins/minimal_admin_panel/js/moment-2.2.1.js", $url_secured) }}" type="text/javascript"></script>
            <script src="{{ asset("/plugins/minimal_admin_panel/js/clndr.js", $url_secured) }}" type="text/javascript"></script>
            <script src="{{ asset("/plugins/minimal_admin_panel/js/site.js", $url_secured) }}" type="text/javascript"></script>
            <!----End Calender -------->
        </div>
        <div class="col-md-7 mid-content-top">
            <div class="middle-content">
                <h3>Latest Images</h3>
                <!-- start content_slider -->
                <div id="owl-demo" class="owl-carousel text-center">
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na1.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na2.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na1.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na2.jpg", $url_secured) }}" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="{{ asset("/plugins/minimal_admin_panel/images/na.jpg", $url_secured) }}" alt="name">
                    </div>
                </div>
            </div>
            <!--//sreen-gallery-cursual---->
            <!-- requried-jsfiles-for owl -->
            <link href="{{ asset("/plugins/minimal_admin_panel/css/owl.carousel.css", $url_secured) }}" rel="stylesheet">
            <script src="{{ asset("/plugins/minimal_admin_panel/js/owl.carousel.js", $url_secured) }}"></script>
            <script>
                $(document).ready(function() {
                    $("#owl-demo").owlCarousel({
                        items : 3,
                        lazyLoad : true,
                        autoPlay : true,
                        pagination : true,
                        nav:true,
                    });
                });
            </script>
            <!-- //requried-jsfiles-for owl -->
        </div>
        <div class="clearfix"> </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 id="success_noti" class="text-center"><img src="{{ asset('/images/check-1-icon.png', $url_secured)}}" class="img-circle"><br>Success</h2>
                    <h2 id="alert_noti" class="text-center" style="display: none;"><img src="{{ asset('/images/information-icon.png', $url_secured)}}" class="img-circle"><br>Alert</h2>
                </div>
                <div class="modal-body row">
                    <div id="success_msg">
                        <h5 class="text-center">Your Payment has been sent!</h5>
                        <h6 class="text-center" style="margin-top: 5px;">Please allow us to evaluate your account within 24 to 48 Hours.</h6>
                    </div>

                    <div id="alert_msg" style="display: none;">
                        <h5 class="text-center">Your Account is not Activated!</h5>
                        <h6 class="text-center" style="margin-top: 5px;">Please allow us to evaluate your account within 24 to 48 Hours</h6>
                        <h6 class="text-center" style="margin-top: 5px;">Or Send an email to us for confirmation.</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <h6 class="text-center"><a href="mailto:cpanelv21@kpa21.info">For more info email us at CPanelV21@kpa21.info</a></h6>
                </div>
            </div>
        </div>
    </div>

    @if (session('message'))
        <script>
            $(document).ready(function() {
                $('#modal_event').click();
            })
        </script>
    @else
        <script>
            $(document).ready(function() {
                var status = {{ $user[0]->status }};
                if (status == 2) {
                    $('#success_noti').hide();
                    $('#alert_noti').show();
                    $('#success_msg').hide();
                    $('#alert_msg').show();
                    $('#modal_event').click();
                }
            })
        </script>
    @endif
@endsection