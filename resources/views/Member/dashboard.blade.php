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

    <!--content-->
    <div class="content-top">

        <div class="col-md-4 ">
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>Website</h5>
                    <label>{{ $statistics["Website"] }}</label>
                </div>
                <div class="col-md-6 top-content1">
                    <div id="demo-pie-1" class="pie-title-center" data-percent="{{ $statistics["Website"] }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>MySQL</h5>
                    <label>{{ $statistics["MySQL"] }}</label>
                </div>
                <div class="col-md-6 top-content1">
                    <div id="demo-pie-2" class="pie-title-center" data-percent="{{ $statistics["MySQL"] }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="content-top-1">
                <div class="col-md-6 top-content">
                    <h5>FTP</h5>
                    <label>{{ $statistics["FTP"] }}</label>
                </div>
                <div class="col-md-6 top-content1">
                    <div id="demo-pie-3" class="pie-title-center" data-percent="{{ $statistics["FTP"] }}"> <span class="pie-value"></span> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="content-top-1">
                <script type="text/javascript">
                    $(function () {
                        Highcharts.chart('container', {
                            title: {
                                text: 'Monthly Average Traffic',
                                x: -20 //center
                            },
                            subtitle: {
                                text: 'Source: CPanel.kpa21.com',
                                x: -20
                            },
                            xAxis: {
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                            },
                            yAxis: {
                                title: {
                                    text: 'Reports (₱)'
                                },
                                plotLines: [{
                                    value: 0,
                                    width: 1,
                                    color: '#808080'
                                }]
                            },
                            tooltip: {
                                valueSuffix: ' ₱'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle',
                                borderWidth: 0
                            },
                            series: [{
                                name: 'Website',
                                data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0]
                            }, {
                                name: 'MySQL',
                                data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0]
                            }, {
                                name: 'FTP',
                                data: [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0]
                            }]
                        });
                    });
                </script>
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/exporting.js"></script>
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
                    <h2 id="success_noti" class="text-center"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/check-1-icon.png" class="img-circle"><br>Success</h2>
                    <h2 id="alert_noti" class="text-center" style="display: none;"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/information-icon.png" class="img-circle"><br>Alert</h2>
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
                    <h6 class="text-center"><a href="mailto:info@cpanelv21.kpa21.com">For more info email us at info@CPanelV21.kpa21.com</a></h6>
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