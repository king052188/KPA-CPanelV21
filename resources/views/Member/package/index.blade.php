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