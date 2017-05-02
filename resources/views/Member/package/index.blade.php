@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>

    <script>
        var last_id = 0;
        var choose_id = 0;
        function event_click(id) {
            console.log(id);
            $(document).ready(function() {
                if(last_id == 0) {
                    last_id = parseInt(id);
                }
                else {
                    $('#btnChoose_'+last_id).removeAttr("class");
                    $('#btnChoose_'+last_id).attr("class", "btn btn-warning");
                    last_id = parseInt(id);
                }
                $('#btnChoose_'+id).removeAttr("class");
                $('#btnChoose_'+id).attr("class", "btn btn-success");
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

            <h3> Setup Package Plant </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Account Name</label>
                <input type="text" id="account" name="account" value="{{ $user[0]->username }}" disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Packages Plan</label>
                <select id="packages" name="packages">
                    <option value="0">-- Select Account --</option>
                    @for($i = 0; $i < COUNT($packages); $i++)
                        <option value="{{ $packages[$i]->code_name }}:{{ number_format($packages[$i]->disk, 2) }}:{{ $packages[$i]->web }}:{{ $packages[$i]->mysql }}:{{ $packages[$i]->ftp }}:{{ number_format($packages[$i]->price_usd, 2) }}:{{ number_format($packages[$i]->price_ph, 2) }}">{{ $packages[$i]->code_name }}</option>
                    @endfor

                </select>
            </div>

            <div class="clearfix"> </div>

            <div id="package_info" class="col-md-12 form-group1 group-mail" style="display: none;">
                <label class="control-label">Package Plan Information</label>
                <span id="package_info_msg" class="checking"></span>
            </div>

            <link rel="stylesheet" href="{{ asset('css/table-responsive.css') }}">
            <script src="http://zurb.com/playground/projects/responsive-tables/responsive-tables.js"></script>

            <div class="col-md-12 form-group1 group-mail">
                <table id="packages_plan" class="responsive" style="width: 100%;">
                    <tr>
                        <th style="text-align: right; width: 190px; border-bottom: 1px solid #F0F0F0;">Package</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Web Site</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">MySQL</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">FTP</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Storage</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Bandwidth</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">DDoS Protection</th>
                        <th id="usd_price_th" style="text-align: center; border-bottom: 1px solid #F0F0F0;">USD | <a href="#" id="show_php">PHP</a></th>
                        <th id="php_price_th" style="text-align: center; border-bottom: 1px solid #F0F0F0; display: none;"><a href="#" id="show_usd">USD</a> | PHP</th>
                        <th style="text-align: center; width: 150px; border-bottom: 1px solid #F0F0F0;">Action</th>
                    </tr>
                    @for($i = 0; $i < COUNT($packages); $i++)
                        <tr>
                            <td style="text-align: right; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->code_name }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->web }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->mysql }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ $packages[$i]->ftp }}</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">{{ number_format($packages[$i]->disk, 2) }} GB</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">Unmetered</td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;">YES</td>
                            <td id="usd_price_{{ $i }}" style="text-align: right; border-bottom: 1px solid #F0F0F0;">{{ number_format($packages[$i]->price_usd, 2) }}<span style="font-size: 13px; color: #C5C5C5;"> /month</span></td>
                            <td id="php_price_{{ $i }}" style="text-align: right; border-bottom: 1px solid #F0F0F0; display: none;">{{ number_format($packages[$i]->price_ph, 2) }}<span style="font-size: 13px; color: #C5C5C5;"> /month</span></td>
                            <td style="text-align: center; border-bottom: 1px solid #F0F0F0;"><button type="submit" onclick="event_click({{ $packages[$i]->Id }})" id="btnChoose_{{ $packages[$i]->Id }}" class="btn btn-warning">Choose</button></td>
                        </tr>
                    @endfor

                </table>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group">
                <button type="submit" id="btnSaveFTP" class="btn btn-primary">Continue</button>
                <a href="/logout" class="btn btn-default">Cancel</a>
            </div>

            <div class="clearfix"> </div>

        </div>

    </div>
    <!--//grid-->
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