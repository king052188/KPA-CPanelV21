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
            <span>Create Website</span>
        </h2>
    </div>
    <!--//banner-->

    <!--faq-->
    <div class="blank">

        <a href="#" id="modal_event" class="btn btn-blue btn-lg btn-huge lato" data-toggle="modal" data-target="#myModal" style="display: none;"></a>

        <!-- FooTable -->
        <link href="{{ asset('/css/footable.core.css', $url_secured)}}" rel="stylesheet">
        <script src="{{ asset('/js/footable.all.min.js', $url_secured)}}"></script>
        <!-- FooTable -- Page-Level Scripts -->

        <style>
            ._wrapper .show_ label, ._wrapper .show_ select, ._wrapper .search_ label, ._wrapper .search_ input {
                font-family: 'Muli-Regular';
                font-size: .95em;
                padding: 5px;
                border: 0;
            }
            ._wrapper .show_ select, ._wrapper .search_ input {
                border-bottom: 1px solid darkgray;
                border-bottom: 1px solid darkgray;
            }
            ._wrapper .show_ {
                float: left;
            }
            ._wrapper .search_ {
                float: right;
            }
            table.clients_dt tbody tr td { padding: 5px; }
            .select_ddl { padding: 5px; }

            .btn-delete { font-size: .9em; background: #ed5565; border-color: #ed5565; color: #FFFFFF; border: 0; padding: 2px 6px 2px 6px; }
        </style>

        <div class="blank-page">

            <table id="database_dt" class="footable table" data-sorting="true" data-page-size="10" data-limit-navigation="5" style="padding: 10px;">
                <thead>
                <tr>
                    <th style="width: 70px;">#</th>
                    <th>Directory</th>
                    <th style="width: 230px;">Hostname</th>
                    <th style="width: 80px;">Port</th>
                    <th style="width: 180px;">Account</th>
                    <th style="width: 200px;">Created</th>
                    <th style="width: 120px;">Status</th>
                    <th style="width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(COUNT($ftp_lists) > 0)
                    @for($i = 0; $i < COUNT($ftp_lists); $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><b>{{ $ftp_lists[$i]["path"] }}</b></td>
                            <td><b>{{ $configs["FTP_Hosts"]["hostname"] }}</b></td>
                            <td><b>21</b></td>
                            <td><b>{{ $ftp_lists[$i]["username"] }} | <a href="#" data-password="{{ $ftp_lists[$i]["password"] }}" title="Double to view password"><i class="fa fa-barcode"></i></a> </b></td>
                            <td>
                                <?php
                                $date_time = $ftp_lists[$i]["created_at"];
                                $date = \App\Http\Controllers\Helper::get_current_time_stamp($date_time);
                                ?>
                                {{ $date }}
                            </td>
                            <td><b>{{ $ftp_lists[$i]["status"] > 1 ? "Active" : "Inactive" }}</b></td>
                            <td>
                                <button class="btn-delete" style="color: #fff;" aria-label="Delete">delete</button>
                            </td>
                        </tr>
                    @endfor
                @else
                    <tr> <td colspan="7" style="text-align: center;"> No Records </td> </tr>
                @endif
                </tbody>
            </table>

            <div class="clearfix"> </div>

            <div class="_wrapper" style="height: 30px; margin-top: 10px;">
                <div class="show_">
                    <a href="/ftp/create" id="btnCreateDatabase" class="btn btn-primary">Create Account</a>
                </div>
                <div class="search_">
                    <p>Total Active FTP: <b>{{ COUNT($ftp_lists) }}</b></p>
                </div>
            </div>

            <div class="clearfix"> </div>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    {{--// binding account --}}

                    <div id="binding" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="binding_noti" class="text-center"><img src="{{ asset('/images/signal-icon.png', $url_secured)}}" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="binding_msg"> </div>
                            <div style="text-align: center; margin: 9px 0 0 0;">
                                <table class="username_verify_list" cellspacing="0" cellpadding="0" style="margin: 0 auto; width: 570px; border: 1px solid gray;">
                                    <thead>
                                    <tr>
                                        <th style="padding: 5px; text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Type</th>
                                        <th style="padding: 5px; text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Host Name</th>
                                        <th style="padding: 5px; text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">IP</th>
                                        <th style="padding: 5px; text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Port</th>
                                        <th style="padding: 5px; text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">HTTP</td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">paopao.com</td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">127.0.0.1</td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">8000</td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">
                                            <button type="submit" id="btnVerifyUsername" class="btn btn-danger">DEL</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">
                                            <select name="binding_type" id="binding_type" style="padding: 5px;">
                                                <option value="1">HTTP</option>
                                                <option value="2">HTTPS</option>
                                            </select>
                                        </td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">
                                            <input type="text" name="binding_hostname" id="binding_hostname" placeholder="Hostname" style="width: 180px; padding: 5px;" />
                                        </td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">127.0.0.1</td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">
                                            <input type="text" name="binding_port" id="binding_port" placeholder="Port" style="width: 70px; padding: 5px;" />
                                        </td>
                                        <td style="padding: 5px; text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">
                                            <button type="submit" id="btnBinding" class="btn btn-primary">ADD</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div id="share_verify_msg" style="text-align: center; margin: 15px 0 0 0;"></div>
                            </div>
                            <div><h5 style="text-align: center; font-size: .8em; color: #E91E63;">We are sorry, SSL Certification is not supported at this time,<br />but you can still use HTTPS without SSL Certification.</h5></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                        </div>
                    </div>

                    {{--// state account --}}

                    <div id="state" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="state_noti" class="text-center"><img src="{{ asset('/images/signal-icon.png', $url_secured)}}" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="state_msg"> </div>
                        </div>
                        <div class="modal-footer">
                            <div id="state_loader_fb" class="uil-facebook-css" style="display: none;"><div></div><div></div><div></div></div>
                            <button type="button" id="btnStateYes" class="btn btn-primary">Yes</button>
                            <button type="button" id="btnStateNo" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
                        </div>
                    </div>

                </div>
            </div>

            <script href="{{ asset('/js/jquery-3.2.0.min.js', $url_secured)}} " ></script>

            <script>
                $(document).ready(function() {
                    $('.footable').footable();
                    $( "#database_dt > tbody  > tr" ).dblclick(function() {
                        var selected    = $(this).find('a:first');
                        var pwd         = selected.attr('data-password');
                        var msg         = "The password is: " + pwd;
                        alert( msg );
                    });
                } );
            </script>

        </div>

    </div>
    <!--//faq-->
@endsection