@extends("layout.portal")

@section("content")

<!--banner-->
<div class="banner">
    <h2>
        <a href="index.html">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Member's {{ $sort_type["name"] }}</span>
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
                    <input type="search" name="search" id="search" placeholder="Enter name, email or mobile" style="width: 300px;" />
                </form>
            </div>
        </div>
        <table id="members_dt" class="footable table" data-sorting="true" data-page-size="10" data-limit-navigation="5">
            <thead>
            <tr>
                <th style="width: 320px;">Hash</th>
                <th>Name (Last, First Middle)</th>
                <th style="width: 110px;">Gender</th>
                <th style="width: 250px;">Email</th>
                <th style="width: 120px;">Mobile</th>
                <th style="width: 210px;">Date Registered</th>
                <th style="width: 100px;">Action</th>
            </tr>
            </thead>
            <tbody>
                @if(COUNT($members) > 0)
                    @for($i = 0; $i < COUNT($members); $i++)
                        <tr>
                            <td>{{ $members[$i]->hash_code }}</td>
                            <td>
                                <?php
                                    $f_name = preg_replace('/\s+/', '', strtoupper($members[$i]->first_name));
                                    $m_name = preg_replace('/\s+/', '', strtoupper($members[$i]->middle_name));
                                    $l_name = preg_replace('/\s+/', '', strtoupper($members[$i]->last_name));
                                ?>
                                <b>{{ $l_name }},</b> {{ $m_name }} {{ $m_name }}
                            </td>
                            <td>{{ $members[$i]->gender == 1 ? "Male" : "Female" }}</td>
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
                                <select>
                                    <option value="{{ $members[$i]->Id }}:select">-- select --</option>
                                    <optgroup label="Administrator">Administrator</optgroup>
                                    <option value="{{ $members[$i]->Id }}:view">View</option>
                                    <option value="{{ $members[$i]->Id }}:activate:{{ $f_name }}">Activate</option>
                                    <option value="{{ $members[$i]->Id }}:deactivate">Deactivated</option>
                                    <option value="{{ $members[$i]->Id }}:reset_password:{{ $email }}">Reset Password</option>
                                    <option value="{{ $members[$i]->Id }}:remove_account">Remove Account</option>
                                    @if($user[0]->role == 3)
                                        <optgroup label="Developer Mode">Developer Mode</optgroup>
                                        <option value="{{ $members[$i]->Id }}:make_admin">Make Admin</option>
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
                        <div id="activation_msg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="activationBtnSave" class="btn btn-primary">Yes</button>
                        <button type="submit" id="activationNtnNo" class="btn btn-default" >No</button>
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
                        <button type="submit" id="btnNo" class="btn btn-default" >No</button>
                    </div>
                </div>


            </div>
        </div>

        <script href="//code.jquery.com/jquery-3.2.0.min.js" ></script>
        <script>
            $(document).ready(function() {
                $('.footable').footable();
                var _uid = 0;
                $("#members_dt > tbody  > tr").change(function(){
                    var selected =      $(this).find('select:first');
                    var value =         selected.val();
                    var values =        value.split(':');
                    _uid = parseInt(values[0]);
                    switch (values[1]) {
                        case "view" :
                            window.location.href="/members/view/"+values[0];
                            break;
                        case "activate" :
                            if(values.length > 2) {
                                $('#activation_msg').empty().prepend("<h5 class='text-center' style='line-height: 20px;'>Do you want to activate ( " + values[2] + " ) account?</h5>");
                            }
                            $('#activation').show();
                            $('#reset_password').hide();
                            $('#modal_event').click();
                            break;
                        case "deactivate" :
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
                    if(_uid == 0) {
                        alert("Please reload the page.");
                        return false;
                    }
                    $.ajax({
                        url: "/activate/account/"+_uid,
                        dataType: "text",
                        beforeSend: function () {
                            $('#activationBtnSave').text("Please wait...");
                        },
                        success: function(response) {
                            var json = $.parseJSON(response);
                            if(json == null)
                                return false;

                            if(json.status == 200) {
                                alert("Activation was successful");
                                location.reload();
                            }
                        }
                    });
                })
            } );
        </script>

    </div>
</div>

<!--//faq-->

@endsection