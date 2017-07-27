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
            <span>WordPress WebApp</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> WordPress WebApp </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Hostname (required)</label>
                <select id="host" name="host">
                    <option value="0">-- Select Account --</option>
                    @for($i = 0; $i < COUNT($web); $i++)
                        <option value="{{ $web[$i]->binding_hostname }}">{{ $web[$i]->binding_hostname }}</option>
                    @endfor
                </select>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Location path</label>
                <input type="text" id="location" name="location"  disabled>
            </div>

            <div class="clearfix"> </div>

            {{--@if($web["available"] > 0)--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--<button type="submit" id="btnWebSite" class="btn btn-primary">Save</button>--}}
                    {{--<a href="/ftp/create" class="btn btn-default">Cancel</a>--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div class="col-md-12 form-group">--}}
                    {{--<span class="btn btn-danger">Oops, No Available Website Credits</span>--}}
                    {{--<a href="/dashboard" class="btn btn-default">Cancel</a>--}}
                {{--</div>--}}
            {{--@endif--}}

            <div id="button_install" class="col-md-12 form-group" style="display: none;">
                <button type="submit" id="btnWebAppWordPress" class="btn btn-primary">Install</button>
                <a href="/dashboard" class="btn btn-default">Cancel</a>
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
        var host;
        var cname = "{{ $configs["CName"] }}";
        $(document).ready(function() {
            $( "#host" ).change(function() {
                host = $( "#host" ).val();
                if(host == "0") {
                    return false;
                }

                var location_path = root_path + host + "\\wwwroot\\public";
                $('#location').val(location_path);
                $('#button_install').show();
            });
        })
    </script>
@endsection