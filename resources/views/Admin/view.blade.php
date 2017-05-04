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
            <span>Client Information</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Client Information </h3>

            <br />

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Account Hash Code</label>
                <input type="text" id="streets" name="streets" placeholder="House No./Streets" value="{{ IsSet( $client[0]->hash_code ) ? $client[0]->hash_code : "" }}" required="">
            </div>

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Fullname (first, middle and last)</label>
                <?php
                $f_name = strtoupper($client[0]->first_name);
                $m_name = strtoupper($client[0]->middle_name);
                $l_name = strtoupper($client[0]->last_name);
                ?>
                <input type="text" id="streets" name="streets" placeholder="House No./Streets" value="{{ $f_name .', '. $m_name . ', ' . $l_name }}" required="">
            </div>

            <div class="vali-form">
                <div class="col-md-6 form-group1">
                    <label class="control-label">Email</label>
                    <input type="text" id="barangay" name="barangay" placeholder="Email" value="{{ IsSet( $client[0]->email ) ? $client[0]->email : "" }}" required="">
                </div>
                <div class="col-md-6 form-group1 form-last">
                    <label class="control-label">Mobile</label>
                    <input type="text" id="city" name="city" placeholder="Mobile" value="{{ IsSet( $client[0]->mobile ) ? $client[0]->mobile : "" }}" required="">
                </div>
            </div>

            <div class="clearfix"> </div>

            <br />

            <div class="col-md-12 form-group">
                <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                <button type="submit" id="btnSave" class="btn btn-warning">Hold Account</button>
            </div>

            <div class="clearfix"> </div>

        </div>

        <div class="validation-form">

            <h3> Plan Information </h3>

            <br />

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12 form-group1 group-mail">
                <label class="control-label">Plan</label>
                <?php
                    $usd = $client[0]->price_usd;
                    $php = $usd * $client[0]->price_ph;

                    $plan = IsSet( $client[0]->code_name ) ? $client[0]->code_name : "N/A";
                    $plan = $plan . " - $" . number_format($usd, 2) . " | ₱" . number_format($php, 2);
                ?>
                <input type="text" id="streets" name="streets" placeholder="House No./Streets" value="{{ $plan }}" required="">
            </div>

            <div class="vali-form">
                <div class="col-md-6 form-group1 form-last">
                    <label class="control-label">Web</label>
                    <input type="text" id="city" name="city" placeholder="Mobile" value="{{ IsSet( $client[0]->web ) ? $client[0]->web : "0" }} Site Credits" required="">
                </div>
                <div class="col-md-6 form-group1">
                    <label class="control-label">Storage</label>
                    <input type="text" id="barangay" name="barangay" placeholder="Email" value="{{ IsSet( $client[0]->disk ) ? number_format($client[0]->disk, 0) : "0" }} GB Disk" required="">
                </div>
            </div>

            <div class="clearfix"> </div>

            <div class="vali-form">
                <div class="col-md-6 form-group1">
                    <label class="control-label">MySQL</label>
                    <input type="text" id="barangay" name="barangay" placeholder="Email" value="{{ IsSet( $client[0]->mysql ) ? $client[0]->mysql : "0" }} Database Credits" required="">
                </div>
                <div class="col-md-6 form-group1 form-last">
                    <label class="control-label">FTP</label>
                    <input type="text" id="city" name="city" placeholder="Mobile" value="{{ IsSet( $client[0]->ftp ) ? $client[0]->ftp : "0" }} Account Credits" required="">
                </div>
            </div>

            <div class="clearfix"> </div>

            <div class="vali-form">
                <div class="col-md-6 form-group1">
                    <label class="control-label">Hostname</label>
                    <input type="text" id="barangay" name="barangay" placeholder="Email" value="{{ IsSet( $client[0]->hostname ) ? $client[0]->hostname : "0" }} Hostname Credits" required="">
                </div>
                <div class="col-md-6 form-group1 form-last">
                    <label class="control-label">Port</label>
                    <input type="text" id="city" name="city" placeholder="Mobile" value="{{ IsSet( $client[0]->port ) ? $client[0]->port : "0" }} Port Credits" required="">
                </div>
            </div>

            <div class="clearfix"> </div>

            <br />

            <div class="col-md-12 form-group">
                <button type="submit" id="btnSave" class="btn btn-primary">Upgrade Plan</button>
                <button type="submit" id="btnSave" class="btn btn-warning">Deactivate Plan</button>
            </div>

            <div class="clearfix"> </div>

        </div>

    </div>
    <!--//grid-->

@endsection