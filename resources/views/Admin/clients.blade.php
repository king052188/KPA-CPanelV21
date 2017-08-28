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
            <span>{{ $types["name"] }} Client Lists</span>
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
                        <input type="search" name="search" id="search" placeholder="Enter name, email or mobile" style="width: 300px;" />
                    </form>
                </div>
            </div>

            <table id="clients_dt" class="footable table" data-sorting="true" data-page-size="10" data-limit-navigation="5">
                <thead>
                <tr>
                    <th style="width: 200px;">Plan</th>
                    <th style="width: 200px;">Company</th>
                    <th>Name (Last, First, Middle)</th>
                    <th style="width: 250px;">Email</th>
                    <th style="width: 150px;">Mobile</th>
                    <th style="width: 220px;">Registered</th>
                    <th style="width: 150px;">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(COUNT($members) > 0)
                    @for($i = 0; $i < COUNT($members); $i++)
                        <tr>
                            <?php
                                if($members[$i]->status > 2) {
                                    $plan = $members[$i]->code_name;
                                    $amount_usd = $members[$i]->price_usd;
                                    $amount_ph = $members[$i]->price_usd * $members[$i]->price_usd;
                                    $tooltips = '$' . number_format($amount_usd, 2) .' | ';
                                    $tooltips .= '₱' . number_format($amount_usd, 2);
                                }
                                else {
                                    $plan = "N/A";
                                    $tooltips = "N/A";
                                }
                            ?>
                            <td ><a href="#" class="masterTooltip" title="{{ $tooltips }}">{{ $plan }}</a> </td>
                            <td>{{ $members[$i]->group_name }}</td>
                            <td>
                                <?php
                                $f_name = strtoupper($members[$i]->first_name);
                                $m_name = strtoupper($members[$i]->middle_name);
                                $l_name = strtoupper($members[$i]->last_name);
                                ?>
                                <b>{{ $l_name }},</b> {{ $f_name }}, {{ $m_name }}
                            </td>
                            <td>{{ $members[$i]->email }}</td>
                            <td>
                                <?php
                                $email = $members[$i]->email;
                                $mobile_number = str_replace("-","", $members[$i]->mobile);
                                ?>
                                {{  $mobile_number }}
                            </td>
                            <td>
                                <?php
                                $date_time = $members[$i]->created_at;
                                $date = \App\Http\Controllers\Helper::get_current_time_stamp($date_time);
                                ?>
                                {{ $date }}
                            </td>
                            <td>
                                <select class="select_ddl">
                                    <option value="{{ $members[$i]->hash_code }}:select">-- select --</option>
                                    <optgroup label="Administrator">Administrator</optgroup>
                                    <option value="{{ $members[$i]->hash_code }}:view">View</option>
                                    @if($members[$i]->status == 3)
                                        <option value="{{ $members[$i]->hash_code }}:deactivate:{{ $f_name }}">Deactivated</option>
                                    @else
                                        <option value="{{ $members[$i]->hash_code }}:activate:{{ $f_name }}">Activate</option>
                                    @endif
                                    <option value="{{ $members[$i]->hash_code }}:reset_password:{{ $email }}">Reset Password</option>
                                    @if($user[0]->role == 3)
                                        <optgroup label="Developer Mode">Developer Mode</optgroup>
                                        <option value="{{ $members[$i]->hash_code }}:make_admin">Make Admin</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                    @endfor
                @else
                    <tr> <td colspan="7" style="text-align: center;"> No Records </td> </tr>
                @endif
                </tbody>
                @if(COUNT($members) > 0)
                    <tfoot>
                    <tr>
                        <td colspan="11">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                @endif
            </table>

            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">

                    {{--// activate account --}}

                    <div id="activation" class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="success_noti" class="text-center"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/signal-icon.png" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="activation_msg"> </div>
                        </div>
                        <div class="modal-footer">
                            <select id="ddlGroups" style="padding: 5px; margin-top: 1.5px;">
                                <option value="0">-- Select Group --</option>
                                <option value="kpa">KPA</option>
                                <option value="ckt">CKT</option>
                            </select>
                            <button type="submit" id="activationBtnSave" class="btn btn-primary">Yes</button>
                            <button type="submit" data-dismiss="modal" aria-hidden="true" class="btn btn-default" >No</button>
                        </div>
                    </div>

                    {{--// reset password --}}

                    <div id="reset_password" class="modal-content" style="display: none;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h2 id="success_noti" class="text-center"><img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/128/signal-icon.png" class="img-circle"><br />Confirming</h2>
                        </div>
                        <div class="modal-body row">
                            <div id="reset_password_msg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="btnSave" class="btn btn-primary">Yes</button>
                            <button type="submit" data-dismiss="modal" aria-hidden="true"  class="btn btn-default" >No</button>
                        </div>
                    </div>


                </div>
            </div>

            <script href="//code.jquery.com/jquery-3.2.0.min.js" ></script>

            <script>
                $(document).ready(function() {
                    $('.footable').footable();

                    $('.masterTooltip').tooltip({
                        items: 'a.masterTooltip',
                        content: 'Loading…',
                        show: null, // show immediately
                        open: function(event, ui)
                        {
                            if (typeof(event.originalEvent) === 'undefined')
                            {
                                return false;
                            }

                            var $id = $(ui.tooltip).attr('id');

                            // close any lingering tooltips
                            $('div.ui-tooltip').not('#' + $id).remove();

                            // ajax function to pull in data and add it to the tooltip goes here
                        },
                        close: function(event, ui)
                        {
                            ui.tooltip.hover(function()
                                    {
                                        $(this).stop(true).fadeTo(300, 1);
                                    },
                                    function()
                                    {
                                        $(this).fadeOut('400', function()
                                        {
                                            $(this).remove();
                                        });
                                    });
                        }
                    });

                    var _hash_code = null;
                    var _status = 0;

                    $("#clients_dt > tbody  > tr").change(function(){
                        var selected =      $(this).find('select:first');
                        var value =         selected.val();
                        var values =        value.split(':');

                        _hash_code = values[0];

                        console.log(_hash_code);

                        switch (values[1]) {
                            case "view" :
                                window.location.href="/clients/view/"+ {{ $types["id"] }} +"/"+values[0];
                                break;
                            case "activate" :
                                _status = 3;
                                if(values.length > 2) {
                                    $('#activation_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Do you want to <span style='color: green;'>Activate</span> ( " + values[2] + " ) account?</h5>");
                                }
                                $('#ddlGroups').show();
                                $('#activation').show();
                                $('#reset_password').hide();
                                $('#modal_event').click();
                                break;
                            case "deactivate" :
                                _status = -3;
                                if(values.length > 2) {
                                    $('#activation_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Do you want to <span style='color: red;'>Deactivate</span> ( " + values[2] + " ) account?</h5>");
                                }
                                $('#ddlGroups').hide();
                                $('#activation').show();
                                $('#reset_password').hide();
                                $('#modal_event').click();
                                break;
                            case "reset_password" :
                                if(values.length > 2) {
                                    $('#reset_password_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Are you sure you want to reset the password?<br />If you clicked YES, new password will be sent to<br />this email ( " + values[2] + " )</h5>");
                                }
                                $('#activation').hide();
                                $('#reset_password').show();
                                $('#modal_event').click();
                                break;
                        }
                    });

                    $('#activationBtnSave').click(function() {
                        if(_hash_code == null) {
                            alert("Please reload the page.");
                            return false;
                        }

                        var groups = null;
                        if(_status > 0) {
                            groups = $('#ddlGroups').val();
                            if(groups == "0") {
                                alert("Please select a group.");
                                return false;
                            }
                        }

                        $.ajax({
                            url: "/activate/account/"+_hash_code+"?group="+groups+"&status="+_status,
                            dataType: "text",
                            beforeSend: function () {
                                $('#activationBtnSave').text("Please wait...");
                            },
                            success: function(response) {
                                var json = $.parseJSON(response);
                                if(json == null)
                                    return false;
                                if(json.status == 200) {
                                    swal({
                                        title: "Good job! Activation was successful!",
                                        text: "This page will automatically reload after you click OK.",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: "#337ab7",
                                        confirmButtonText: "Ok, Reload the Page!",
                                        closeOnConfirm: false
                                    },
                                    function(){
                                        location.reload();
                                    });
                                }
                                else if(json.status == 201) {
                                    swal("Nice try!", "Account already activated!", "info");
                                }
                                else {
                                    swal("Bad!", "Please try again!", "error");
                                }
                                $('#activationBtnSave').text("Yes");
                            }
                        });
                    })
                } );
            </script>

        </div>

    </div>
    <!--//faq-->
@endsection