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
        <link href="{{ asset('/css/footable.core.css')}}" rel="stylesheet">
        <script src="{{ asset('/js/footable.all.min.js')}}"></script>
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
        </style>

        <div class="blank-page">

            <table id="database_dt" class="footable table" data-sorting="true" data-page-size="10" data-limit-navigation="5" style="padding: 10px;">
                <thead>
                <tr>
                    <th style="width: 100px;">#</th>
                    <th style="width: 100px;">Type</th>
                    <th>Host Name</th>
                    <th style="width: 120px;">IP</th>
                    <th style="width: 100px;">Port</th>
                    <th style="width: 250px;">Created</th>
                    <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>
                    @if(COUNT($web) > 0)
                        @for($i = 0; $i < COUNT($web); $i++)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><b>{{ $web[$i]->binding_type == 1 ? "HTTP" : "HTTPS" }}</b></td>
                                <td><b>{{ $web[$i]->binding_hostname }}</b></td>
                                <td><b>{{ $web[$i]->binding_ip }}</b></td>
                                <td><b>{{ $web[$i]->binding_port }}</b></td>
                                <td>
                                    <?php
                                    $date_time = $web[$i]->created_at;
                                    $date = \App\Http\Controllers\Helper::get_current_time_stamp($date_time);
                                    ?>
                                    {{ $date }}
                                </td>
                                <td>
                                    <select class="select_ddl">
                                        <option value="{{ $web[$i]->Id }}:select">-- select --</option>
                                        <option value="{{ $web[$i]->Id }}:binding:{{ $web[$i]->binding_hostname }}">binding</option>
                                        <option value="{{ $web[$i]->Id }}:restart:{{ $web[$i]->binding_hostname }}">restart</option>
                                        <option value="{{ $web[$i]->Id }}:stop:{{ $web[$i]->binding_hostname }}">stop</option>
                                    </select>
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
                    <a href="/web/create" id="btnCreateDatabase" class="btn btn-primary">Add WebSite</a>
                </div>
                <div class="search_">

                    <p>Total Active WebSite: <b>{{ COUNT($web) }}</b></p>

                </div>
            </div>

            <div class="clearfix"> </div>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    {{--// activate account --}}

                    <div id="share" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="share_noti" class="text-center"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/signal-icon.png" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="share_msg"> </div>
                            <div style="text-align: center; margin: 9px 0 0 0;">
                                To: <input type="text" id="u_name" name="u_name" placeholder="Enter username here..." style="padding: 5px; font-size: .9em;" required>
                                <button type="submit" id="btnVerifyUsername" class="btn btn-primary">Verify</button>
                                <div id="share_verify_msg" style="text-align: center; margin: 15px 0 0 0;"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnApproveShareDatabase" class="btn btn-primary" disabled>Approve</button>
                            <button type="submit" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                        </div>
                    </div>

                    {{--// reset password --}}

                    <div id="drop" class="modal-content" style="display: none;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="drop_noti" class="text-center"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/signal-icon.png" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="drop_msg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnSave" class="btn btn-primary">Yes</button>
                            <button type="submit" id="btnNo" class="btn btn-default" data-dismiss="modal" aria-hidden="true">No</button>
                        </div>
                    </div>

                </div>
            </div>

            <script href="http://code.jquery.com/jquery-3.2.0.min.js" ></script>

            <script>
                $(document).ready(function() {
                    $('.footable').footable();
                    var _uid = 0;

                    $("#database_dt > tbody  > tr").change(function(){
                        var selected =      $(this).find('select:first');
                        var value =         selected.val();
                        var values =        value.split(':');
                        _uid = parseInt(values[0]);
                        switch (values[1]) {
                            case "binding" :
                                if(values.length > 2) {
                                    $('#share_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Would you like to add binding to <span style='color: #E91E63;'>( " + values[2] + " )</span>?</h5>");
                                }
                                d_name = values[2];
                                $('#share').show();
                                $('#drop').hide();
                                $('#modal_event').click();
                                break;
                            case "restart" :
                                if(values.length > 2) {
                                    $('#drop_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Are you sure you want to RESTART<br /><span style='color: #E91E63;'>( " + values[2] + " )</span> web site?<br /></h5>");
                                }
                                $('#share').hide();
                                $('#drop').show();
                                $('#modal_event').click();
                                break;
                            case "stop" :
                                if(values.length > 2) {
                                    $('#drop_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Are you sure you want to STOP<br /><span style='color: #E91E63;'>( " + values[2] + " )</span> web site?<br /.</h5>");
                                }
                                $('#share').hide();
                                $('#drop').show();
                                $('#modal_event').click();
                                break;
                        }
                    });

                } );

                function ajax_execute(data, url, button_id) {
                    $(document).ready(function() {
                        $.ajax({
                            dataType: 'json',
                            type:'POST',
                            url: url,
                            data: data,
                            beforeSend: function () {
                                $("#"+button_id).text("Please wait....");
                            }
                        }).done(function(data){
                            console.log(data);

                            if(data.code == 200) {
                                if(redirect != null) {
                                    window.location.href=data.url;
                                    return false;
                                }
                                message_box("Hooray!", data.message, "success");
                            }
                            else if (data.code == 500) {
                                message_box("Oops, Something went wrong.", data.message, "success");
                            }
                            else {
                                message_box("Warning!", data.message, "warning");
                            }
                            $("#"+button_id).text("Save");
                        });
                    })
                }
            </script>

        </div>

    </div>
    <!--//faq-->

    <style>
        .notifyjs-container div span {
            font-weight: 200;
            font-size: .8em;
        }
        .checking {
            font-weight: 200;
            font-size: .9em;
            color: #B3AEAE;
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