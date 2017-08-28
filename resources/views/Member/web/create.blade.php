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
                <select id="host" name="host">
                    <option value="0">-- Select Account --</option>
                    <optgroup label="Free hostname">Free hostname</optgroup>
                    @for($i = 0; $i < COUNT($configs["IIS_Hosts"]); $i++)
                        <option value="{{ $configs["IIS_Hosts"][$i] }}">{{ $configs["IIS_Hosts"][$i] }}</option>
                    @endfor
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
                <input type="text" id="port" name="port" placeholder="Port number I.e.: 80 or 8080" >
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Protocol</label>
                <input type="text" id="protocol" name="protocol" value="HTTP" disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Location path</label>
                <input type="text" id="location" name="location"  disabled>
            </div>

            <div class="clearfix"> </div>

            @if($web["available"] > 0)
                <div class="col-md-12 form-group">
                    <button type="submit" id="btnWebSite" class="btn btn-primary">Save</button>
                    <a href="/web/sites" class="btn btn-default">Cancel</a>
                </div>
            @else
                <div class="col-md-12 form-group">
                    <span class="btn btn-danger">Oops, No Available Website Credits</span>
                    <a href="/dashboard" class="btn btn-default">Cancel</a>
                </div>
            @endif

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
        var host;
        var cname = "{{ $configs["CName"] }}";
        $(document).ready(function() {
            $( "#host" ).change(function() {
                host = $( "#host" ).val();
                if(host == "0") {
                    $( "#domain_a" ).hide();
                    $( "#domain_b" ).hide();
                    return false;
                }
                if(host != "1") {
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
                    text += '-> NOTE: Please create a <span style=" color: #3FD64B;">CNAME</span> record <span style="color: #B3AEAE;">in your DNS and point this hostname: </span> <span style=" color: #3FD64B;">'+cname+'</span></span> <br />';
                    text += '-> Ex.: <span style=" color: #3FD64B;">' + domain + '</span> <span style="color: #B3AEAE;"> value is </span> <span style=" color: #3FD64B;">'+cname+'</span></span> and ';
                    text += '<span style=" color: #3FD64B;">www.' + domain + '</span> <span style="color: #B3AEAE;"> value is </span> <span style=" color: #3FD64B;">'+cname+'</span></span>';
                    text += '</p>';
                    $('#span_domain').empty().prepend(text);
                }
                var location_path = root_path + domain + "\\wwwroot\\public"
                $('#location').val(location_path);
            });
            $('#hostname').on('keyup', function(){
                var hostname = $('#hostname').val() +"."+ host;
                var text = '<p style=" margin: 10px 0 0 0;">';
                text += '-> Your hostname: <span style=" color: #3FD64B;"><a href="http://' + hostname + '" target="_blank">' + hostname + '</a></span> <br />';
                text += '-> In the future, you might want to use your own domain. That\'s no problem. <br />';
                text += '-> Just create a <span style=" color: #3FD64B;">CNAME</span> record <span style="color: #B3AEAE;">in your DNS and point this hostname: </span> <span style=" color: #3FD64B;">' + hostname + '</span></span><br />';
                text += '-> Ex.: <span style=" color: #3FD64B;">YOUR-DOMAIN.com</span> <span style="color: #B3AEAE;"> value is </span> <span style=" color: #3FD64B;">'+cname+'</span></span> and ';
                text += '<span style=" color: #3FD64B;">www.YOUR-DOMAIN.com</span> <span style="color: #B3AEAE;"> value is </span> <span style=" color: #3FD64B;">'+cname+'</span></span>';
                text += '</p>';
                $('#span_hostname').show();
                $('#span_hostname').empty().prepend(text);
                var location_path = root_path + hostname + "\\wwwroot\\public";
                $('#location').val(location_path);
            });
            function validateDomain_1(the_domain)
            {
                the_domain = the_domain.replace("http://","");
                the_domain = the_domain.replace("www.","");
                var reg = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/;
                return reg.test(the_domain);
            }
            function validateDomain(the_domain) {
                var val = the_domain;
                val = the_domain.replace("http://","");
                val = the_domain.replace("www.","");
                if (/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(val)){
                    return true;
                }
                else
                {
                    val.name.focus();
                    return false;
                }
            }
        })
    </script>
@endsection