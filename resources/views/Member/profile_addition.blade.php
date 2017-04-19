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
            <span>Beneficiary Information</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Beneficiary Information </h3>

            <br />

            <script>
                $(document).ready(function() {
                    var b_id = {{ IsSet( $beneficiary_info->Id ) ? $beneficiary_info->Id : 0 }};
                    var same_with_primary = {{ IsSet( $beneficiary_info->same_with_primary ) ? $beneficiary_info->same_with_primary : 0 }};
                    if(b_id == 0) {
                        $('#btnSave').text("Save and Go to Payment");
                    }
                    else {
                        $('#btnNext').show();
                    }

                    if(same_with_primary > 0) {
                        $( "#same_with_primary" ).attr('checked','checked');
                    }

                    $( "#same_with_primary" ).change(function() {
                        var $input = $( this );
                        if($input.is( ":checked" )) {
                            $('#streets').removeAttr('required');
                            $('#barangay').removeAttr('required');
                            $('#city').removeAttr('required');
                            $('#province').removeAttr('required');
                            $('#zip_code').removeAttr('required');
                            $('#mobile').removeAttr('required');

                            $('#streets').attr('disabled', '');
                            $('#barangay').attr('disabled', '');
                            $('#city').attr('disabled', '');
                            $('#province').attr('disabled', '');
                            $('#zip_code').attr('disabled', '');
                            $('#mobile').attr('disabled', '');
                            $('#telephone').attr('disabled', '');
                            $('#email').attr('disabled', '');
                        }
                        else {
                            $('#streets').attr('required', '');
                            $('#barangay').attr('required', '');
                            $('#city').attr('required', '');
                            $('#province').attr('required', '');
                            $('#zip_code').attr('required', '');
                            $('#mobile').attr('required', '');

                            $('#streets').removeAttr('disabled');
                            $('#barangay').removeAttr('disabled');
                            $('#city').removeAttr('disabled');
                            $('#province').removeAttr('disabled');
                            $('#zip_code').removeAttr('disabled');
                            $('#mobile').removeAttr('disabled');
                            $('#telephone').removeAttr('disabled');
                            $('#email').removeAttr('disabled');
                        }
                    }).change();
                })
            </script>

            <form method="POST" action="/edit-profile/beneficiary/execute">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <p></p>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Name of Beneficiary (required)</label>
                    <input type="text" id="name_of_beneficiary" name="name_of_beneficiary" placeholder="Name of Beneficiary" value="{{ IsSet( $beneficiary_info->name_of_beneficiary ) ? $beneficiary_info->name_of_beneficiary : "" }}" >
                </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Use my contact information in Previous Form</label>
                    <input type="checkbox" id="same_with_primary" name="same_with_primary">
                </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">House No./Streets (required)</label>
                    <input type="text" id="streets" name="streets" placeholder="House No./Streets" value="{{ IsSet( $beneficiary_info->streets ) ? $beneficiary_info->streets : "" }}" required="">
                </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Barangay (required)</label>
                        <input type="text" id="barangay" name="barangay" placeholder="Barangay" value="{{ IsSet( $beneficiary_info->barangay ) ? $beneficiary_info->barangay : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">City/Municipality (required)</label>
                        <input type="text" id="city" name="city" placeholder="City/Municipality" value="{{ IsSet( $beneficiary_info->city ) ? $beneficiary_info->city : "" }}" required="">
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Province (required)</label>
                        <input type="text" id="province" name="province" placeholder="Province" value="{{ IsSet( $beneficiary_info->province ) ? $beneficiary_info->province : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Zip Code (required)</label>
                        <input type="text" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{ IsSet( $beneficiary_info->zip_code ) ? $beneficiary_info->zip_code : "" }}" required="">
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Telephone No. (If Any)</label>
                        <input type="text" id="telephone" name="telephone" placeholder="Home Phone No." value="{{ IsSet( $beneficiary_info->telephone ) ? $beneficiary_info->telephone : "" }}">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Mobile No.</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Other Mobile No." value="{{ IsSet( $beneficiary_info->mobile ) ? $beneficiary_info->mobile : "" }}" required="">
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Email (optional)</label>
                    <input type="text" id="email" name="email" placeholder="Email Address" value="{{ IsSet( $beneficiary_info->email ) ? $beneficiary_info->email : "" }}">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group">
                    <a href="/edit-profile?page=basic" class="btn btn-default">Previous Step</a>
                    <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                </div>

                <div class="clearfix"> </div>


            </form>

        </div>

    </div>
    <!--//grid-->

@endsection