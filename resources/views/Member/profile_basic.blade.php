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
            <span>Basic Information</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Basic Information </h3>

            <br />

            <script>
                $(document).ready(function() {
                    var b_id = {{ IsSet( $basic_info->Id ) ? $basic_info->Id : 0 }};
                    if(b_id == 0) {
                        $('#btnSave').text("Save and Go to Next Step");
                    }
                    else {
                        $('#btnNext').show();
                    }
                    $("#education_attainment").val({{ IsSet( $basic_info->education_attainment ) ? $basic_info->education_attainment : 0 }});
                    $("#civil_status").val({{ IsSet( $basic_info->civil_status ) ? $basic_info->civil_status : 0 }});
                })
            </script>

            <form method="POST" action="/edit-profile/basic/execute">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">House No./Streets (required)</label>
                    <input type="text" id="streets" name="streets" placeholder="House No./Streets" value="{{ IsSet( $basic_info->streets ) ? $basic_info->streets : "" }}" required="">
                </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Barangay (required)</label>
                        <input type="text" id="barangay" name="barangay" placeholder="Barangay" value="{{ IsSet( $basic_info->barangay ) ? $basic_info->barangay : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">City/Municipality (required)</label>
                        <input type="text" id="city" name="city" placeholder="City/Municipality" value="{{ IsSet( $basic_info->city ) ? $basic_info->city : "" }}" required="">
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Province (required)</label>
                        <input type="text" id="province" name="province" placeholder="Province" value="{{ IsSet( $basic_info->province ) ? $basic_info->province : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Zip Code (required)</label>
                        <input type="text" id="zip_code" name="zip_code" placeholder="Zip Code" value="{{ IsSet( $basic_info->zip_code ) ? $basic_info->zip_code : "" }}" required="">
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Home Phone No.</label>
                        <input type="text" id="telephone" name="telephone" placeholder="Home Phone No." value="{{ IsSet( $basic_info->telephone ) ? $basic_info->telephone : "" }}">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Other Mobile No.</label>
                        <input type="text" id="mobile" name="mobile" placeholder="Other Mobile No." value="{{ IsSet( $basic_info->mobile ) ? $basic_info->mobile : "" }}" required="">
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Educational Attainment (required)</label>
                    <select id="education_attainment" name="education_attainment">
                        <option value="0">-- Select --</option>
                        <option value="1">Primary</option>
                        <option value="2">Secondary</option>
                        <option value="3">College</option>
                        <option value="4">Others</option>
                    </select>
                </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Profession/Occupation (required)</label>
                        <input type="text" id="profession" name="profession" placeholder="Profession/Occupation" value="{{ IsSet( $basic_info->profession ) ? $basic_info->profession : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Skills/Talent (required)</label>
                        <input type="text" id="skills" name="skills" placeholder="Skills/Talent" value="{{ IsSet( $basic_info->skills ) ? $basic_info->skills : "" }}" required="">
                    </div>
                </div>

                <div class="clearfix"> </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">Citizenship (required)</label>
                        <input type="text" id="citizenship" name="citizenship" placeholder="Citizenship" value="{{ IsSet( $basic_info->citizenship ) ? $basic_info->citizenship : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">Blood Type (required)</label>
                        <input type="text" id="blood_type" name="blood_type" placeholder="Blood Type" value="{{ IsSet( $basic_info->blood_type ) ? $basic_info->blood_type : "" }}" required="">
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Civil Status (required)</label>
                    <select id="civil_status" name="civil_status">
                        <option value="0">-- Select --</option>
                        <option value="1">Single</option>
                        <option value="2">Married</option>
                        <option value="3">Widowed</option>
                        <option value="4">Legally Separated</option>
                        <option value="5">Others</option>
                    </select>
                </div>

                <div class="vali-form">
                    <div class="col-md-6 form-group1">
                        <label class="control-label">SSS/GSIS (required)</label>
                        <input type="text" id="sss_no" name="sss_no" placeholder="SSS/GSIS" value="{{ IsSet( $basic_info->sss_no ) ? $basic_info->sss_no : "" }}" required="">
                    </div>
                    <div class="col-md-6 form-group1 form-last">
                        <label class="control-label">TIN (required)</label>
                        <input type="text" id="tin_no" name="tin_no" placeholder="TIN" value="{{ IsSet( $basic_info->tin_no ) ? $basic_info->tin_no : "" }}" required="">
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="col-md-12 form-group">
                    <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                    <a href="/edit-profile?page=beneficiary" id="btnNext" class="btn btn-default" style="display: none;;">Next</a>
                </div>

                <div class="clearfix"> </div>
            </form>

        </div>

    </div>
    <!--//grid-->

@endsection