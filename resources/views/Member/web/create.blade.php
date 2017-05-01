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

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Create Website </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Manage Host (required)</label>
                <select id="manage" name="manage">
                    <option value="0">-- Select Account --</option>
                    <optgroup label="Free hostname">Free hostname</optgroup>
                    <option value="cpv21-host.ddns.net">cpv21-host.ddns.net</option>
                    <option value="cpv21-host.servehttp.com">cpv21-host.servehttp.com</option>
                    <option value="cpv21-host.freedynamicdns.org">cpv21-host.freedynamicdns.org</option>
                    <optgroup label="Use my own domain">Use my own domain</optgroup>
                    <option value="1">Use My Own Domain</option>
                </select>
            </div>

            <div class="clearfix"> </div>

            <div id="domain_a" class="col-md-12 form-group1 group-mail" style="display: none;">
                <label class="control-label">Domain name</label>
                <input type="text" id="domain" name="domain" placeholder="Domain I.e.: google.com" required>
                <span class="checking" id="span_domain" style="display: none;">Checking...</span>
            </div>

            <div id="domain_b" class="col-md-12 form-group1 group-mail" style="display: none;">
                <label class="control-label">Host name</label>
                <input type="text" id="hostname" name="hostname" placeholder="Hostname I.e.: blog-free" required>
                <span class="checking" id="span_hostname" style="display: none;">Checking...</span>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Port number (default is 80)</label>
                <input type="text" id="account" name="account" placeholder="Port number I.e.: 80 or 8080" >
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Protocol</label>
                <input type="text" id="account" name="account" value="HTTP" disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Location path</label>
                <input type="text" id="location" name="location"  disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group">
                <button type="submit" id="btnSaveDisk" class="btn btn-primary">Save</button>
                <a href="/ftp/create" class="btn btn-default">Cancel</a>
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

    <script>

        var root_path = "\\{{ $user[0]->username }}\\";
        var manage ;

        $(document).ready(function() {

            $( "#manage" ).change(function() {
                manage = $( "#manage" ).val();
                if(manage == "0") {
                    $( "#domain_a" ).hide();
                    $( "#domain_b" ).hide();
                    return false;
                }

                if(manage != "1") {
                    $( "#domain_a" ).hide();
                    $( "#domain_b" ).show();
                }
                else {
                    $( "#domain_a" ).show();
                    $( "#domain_b" ).hide();
                }
            });

            $('#domain').on('keyup', function(){
                var domain = $(this).val();
                if(!validateDomain(domain)){
                    $('#span_domain').show();
                    $('#span_domain').empty().prepend('<p style=" margin: 10px 0 0 0;"><span style="color: #DD3A3A;">-> Invalid domain, Please a valid domain.</span></p>');
                }else{
                    $('#span_domain').show();

                    var text = '<p style=" margin: 10px 0 0 0;">';
                    text += '-> Your default domain: <span style=" color: #3FD64B;"><a href="http://' + domain + '" target="_blank">' + domain + '</a></span> <span style="color: #B3AEAE;">|</span> <span style=" color: #3FD64B;"><a href="http://www.' + domain + '" target="_blank">www.' + domain + '</a></span></span> <br />';
                    text += '-> NOTE: Please create HOST <span style=" color: #3FD64B;">A</span> RECORD <span style="color: #B3AEAE;">in your DNS pointed to this IP Address: </span> <span style=" color: #3FD64B;">69.4.84.226</span></span> <br />';
                    text += '-> Ex.: <span style=" color: #3FD64B;">' + domain + '</span> <span style="color: #B3AEAE;"> = </span> <span style=" color: #3FD64B;">69.4.84.226</span></span> and ';
                    text += '<span style=" color: #3FD64B;">www.' + domain + '</span> <span style="color: #B3AEAE;"> = </span> <span style=" color: #3FD64B;">69.4.84.226</span></span>';
                    text += '</p>';

                    $('#span_domain').empty().prepend(text);
                }
                var location_path = root_path + domain + "\\wwwroot\\public"

                $('#location').val(location_path);
            });

            $('#hostname').on('keyup', function(){

                var hostname = $('#hostname').val() +"."+ manage;

                var text = '<p style=" margin: 10px 0 0 0;">';
                text += '-> Your hostname: <span style=" color: #3FD64B;"><a href="http://' + hostname + '" target="_blank">' + hostname + '</a></span> <br />';
                text += '-> In the future, you might want to use your own domain. No problem. <br />';
                text += '-> Just create a <span style=" color: #3FD64B;">CNAME</span> RECORD <span style="color: #B3AEAE;">in your DNS pointed to this hostname: </span> <span style=" color: #3FD64B;">' + hostname + '</span></span>';
                text += '</p>';

                $('#span_hostname').show();
                $('#span_hostname').empty().prepend(text);

                var location_path = root_path + hostname + "\\wwwroot\\public";

                $('#location').val(location_path);
            });

            function validateDomain(the_domain)
            {
                // strip off "http://" and/or "www."
                the_domain = the_domain.replace("http://","");
                the_domain = the_domain.replace("www.","");

                var reg = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/;
                return reg.test(the_domain);
            } // end validateDomain()
        })
    </script>

@endsection