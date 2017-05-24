@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <script>
        var u_name = null, u_role = 0, d_name = null, s_uid = 0;
        var mysql_hostname = "{{ $configs["MySQL_Hosts"]["hostname"] }}";
        var mysql_ip_address = "{{ $configs["MySQL_Hosts"]["ip_address"] }}";
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
            width: 180px;;
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
            <span>Database Lists</span>
            <div class="kpa_custom">
                <div class="kpa_custom_mysql">
                    <input type="checkbox" id="ip_checkbox" /> Use IP |
                    <input type="text" id="mysqlConnection" style="border: 0px;" disabled />
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

                                $('#btnCopy').text("COPIED MySQL HOST");
                            } catch (err) {
                                console.log('Oops, unable to copy');
                                $('#btnCopy').text("COPY MySQL HOST");
                            }

                            $('#mysqlConnection').attr("disabled","disabled");
                        });

                        $(document).ready(function() {
                            $('#mysqlConnection').val(mysql_hostname);
                            $('#ip_checkbox').click(function(){
                                if($(this).prop('checked')){
                                    $('#mysqlConnection').val(mysql_ip_address);
                                }else{
                                    $('#mysqlConnection').val(mysql_hostname);
                                }
                            });
                        })
                    </script>
                </div>
            </div>

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
        </style>

        <div class="blank-page">

            <div class="_wrapper">
                <div class="show_" style="display: none;">
                    <label>Show</label>
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="search_">
                    <form action="" method="GET">
                        <label>Search</label>
                        <input type="search" name="search" id="search" placeholder="Database name" style="width: 300px;" />
                    </form>
                </div>
            </div>

            <table id="database_dt" class="footable table" data-sorting="true" data-page-size="10" data-limit-navigation="5" style="padding: 10px;">
                <thead>
                <tr>
                    <th style="width: 100px;">#</th>
                    <th>Database</th>
                    <th style="width: 150px;">Members</th>
                    <th style="width: 250px;">Created</th>
                    <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(COUNT($database) > 0)
                    @for($i = 0; $i < COUNT($database); $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td><b>{{ $database[$i]["database_name"] }}</b></td>
                            <td><i class="fa fa-link" aria-hidden="true"></i> Only you</td>
                            <td>
                                <?php
                                $date_time = $database[$i]["created_at"];
                                $date = \App\Http\Controllers\Helper::get_current_time_stamp($date_time);
                                ?>
                                {{ $date }}
                            </td>
                            <td>
                                <select>
                                    <option value="{{ $database[$i]["Id"] }}:select">-- select --</option>
                                    <option value="{{ $database[$i]["Id"] }}:share:{{ $database[$i]["database_name"] }}">share</option>
                                    <option value="{{ $database[$i]["Id"] }}:drop:{{ $database[$i]["database_name"] }}">drop</option>
                                </select>
                            </td>
                        </tr>
                    @endfor
                @else
                    <tr> <td colspan="7" style="text-align: center;"> No Records </td> </tr>
                @endif
                </tbody>
            </table>

            <div class="_wrapper" style="height: 30px; margin-top: 10px;">
                <div class="show_" style="display: none;">
                    <label>Show</label>
                    <select>
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="search_">
                    <a href="/mysql/create-database" id="btnCreateDatabase" class="btn btn-primary">Create Database</a>
                </div>
            </div>

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
                            case "share" :
                                if(values.length > 2) {
                                    $('#share_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Would you like to share this <span style='color: #E91E63;'>( " + values[2] + " )</span> database?</h5>");
                                }
                                d_name = values[2];
                                $('#share').show();
                                $('#drop').hide();
                                $('#modal_event').click();
                                break;
                            case "drop" :
                                if(values.length > 2) {
                                    $('#drop_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Are you sure you want to DROP <span style='color: #E91E63;'>( " + values[2] + " )</span> database?<br />Click <span style='color: #E91E63;'>YES</span> to completely drop the database.</h5>");
                                }
                                $('#share').hide();
                                $('#drop').show();
                                $('#modal_event').click();
                                break;
                        }
                    });

                    $('#btnVerifyUsername').click(function() {
                        $('#btnApproveShareDatabase').attr("disabled","disabled");
                        if(_uid == 0) {
                            alert("Please reload the page.");
                            return false;
                        }
                        u_name = $('#u_name').val();
                        if(u_name == "0") {
                            alert("Please select username.");
                            return false;
                        }
                        $.ajax({
                            url: "/verify/account/"+u_name,
                            dataType: "text",
                            beforeSend: function () {
                                $('#btnVerifyUsername').text("Please wait...");
                                $('#share_verify_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>***</h5>");
                            },
                            success: function(response) {
                                var json = $.parseJSON(response);
                                if(json == null)
                                    return false;
                                if(json.status == 200) {
                                    var html = '<h4 style="margin: 0 0 5px 0;">Username Information</h4>';
                                    html += '<table class="username_verify_list" cellspacing="0" cellpadding="4" style="margin: 0 auto; width: 500px; border: 1px solid gray;">';
                                    html += '<thead>';
                                    html += '<tr>';
                                    html += '<th style="text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Email</th>';
                                    html += '<th style="text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray;">Username</th>';
                                    html += '<th style="text-align: center; font-size: .9em; border-top: 1px solid gray; border-left: 1px solid gray; border-right: 1px solid gray;">Host</th>';
                                    html += '<tr>';
                                    html += '</thead>';
                                    html += '<tbody>';
                                    $(json.data).each(function(key, data){
                                        console.log(data);
                                        s_uid = data.user_id;
                                        u_role = data.role;
                                        html += '<tr>';
                                        html += '<td style="text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">'+data.email+'</td>';
                                        html += '<td style="text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">'+data.username+'</td>';
                                        if(data.role == 1) {
                                            html += '<td style="text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray;">localhost</td>';
                                        }
                                        else {
                                            html += '<td style="text-align: center; font-size: .8em; border-top: 1px solid gray; border-left: 1px solid gray; border-right: 1px solid gray;">any host</td>';
                                        }
                                        html += '<tr>';
                                        html += '</thead>';
                                    });
                                    html += '<tbody>';
                                    html += '</table>';
                                    $('#share_verify_msg').empty().prepend(html);
                                    $('#btnApproveShareDatabase').removeAttr("disabled");
                                }
                                else {
                                    $('#share_verify_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Username did not found.</h5>");
                                }
                                $('#btnVerifyUsername').text("Verify");
                            }
                        });
                    })
                } );
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