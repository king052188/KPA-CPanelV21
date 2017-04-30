@extends("layout.portal")

@section("content")
    <?php
    $url_secured = $helper["status"];
    ?>
    <script>
        $(document).ready(function() {

        })
    </script>

    <!--banner-->
    <div class="banner">
        <h2>
            <a href="/login">Home</a>
            <i class="fa fa-angle-right"></i>
            <span>Create Disk</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Create Disk </h3>
            <p style="margin: -2px 0 0 0; padding: 0;" id="notifier_msg"></p>

            <br />

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Disk Name</label>
                <input type="text" id="account" name="account" value="{{ $user[0]->username }}" disabled>
            </div>

            <div class="clearfix"> </div>

            <div class="col-md-12 form-group2 group-mail">
                <label class="control-label">Storage Size</label>
                <select id="quota" name="quota">
                    <option value="1">1 GB</option>
                    <option value="3">3 GB</option>
                    <option value="5">5 GB</option>
                    <option value="10">10 GB</option>
                    <option value="15">15 GB</option>
                    <option value="20">20 GB</option>
                    <option value="25">25 GB</option>
                    <option value="30">30 GB</option>
                    <option value="50">50 GB</option>
                </select>
            </div>

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