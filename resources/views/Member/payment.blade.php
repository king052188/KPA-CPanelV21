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
            <span>Payment Information</span>
        </h2>
    </div>
    <!--//banner-->

    <!--grid-->
    <div class="validation-system">

        <div class="validation-form">

            <h3> Payment Information </h3>

            <br />

            <form method="POST" action="/payment/execute">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Member Type (required)</label>
                    <select id="p_member_type" name="p_member_type">
                        <option value="0">-- Select --</option>
                        <option value="1">FBI Associate</option>
                        <option value="2">FBI Regular</option>
                        <option value="3">FBI SR. Regular</option>
                    </select>
                </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Mode of Payment (required)</label>
                    <select id="mode_of_payment" name="mode_of_payment">
                        <option value="0">-- Select --</option>
                        <option value="1">Via Specialist</option>
                        <option value="2">Via BPI Bank - 9019-0757-77</option>
                        <option value="2">Via Coins.ph - 37bz492NKw5qWjLvx5zJPMrDxRVt1kpUey</option>
                        <option value="3">Express Money Sender</option>
                    </select>
                </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Amount (required)</label>
                    <input type="text" id="p_amount" name="p_amount" placeholder="Amount" required="" disabled="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Proof of payment: Write name of the Specialist or Send a link of print-screen (<a href="https://prnt.sc/" target="_blank">https://prnt.sc/</a>) when using coins.ph or any express money senders</label>
                    <input type="text" id="proof_of_payment_url" name="proof_of_payment_url" placeholder="Proof of payment here..." required="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">1x1 ID Picture, Send a link of print-screen (<a href="https://prnt.sc/" target="_blank">https://prnt.sc/</a>)</label>
                    <input type="text" id="id_picture" name="id_picture" placeholder="1x1 ID picture here..." required="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Signature, Send a link of print-screen (<a href="https://prnt.sc/" target="_blank">https://prnt.sc/</a>)</label>
                    <input type="text" id="signature" name="signature" placeholder="Signature here..." required="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group1 group-mail">
                    <label class="control-label">Valid ID, Send a link of print-screen (<a href="https://prnt.sc/" target="_blank">https://prnt.sc/</a>)</label>
                    <input type="text" id="valid_id" name="valid_id" placeholder="Valid ID here..." required="">
                </div>

                <div class="clearfix"> </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Do you hereby authorize the company to deduct from your rewards and virtual wallet account all payments and charges that will be incurred your my participation and availment of the company’s program and services.</label>
                    <br />
                    <br />
                    <label class="control-label"><input type="radio" id="confirming_a_yes" name="confirming_a" value="1" checked>YES</label>
                    <label class="control-label"><input type="radio" id="confirming_a_no" name="confirming_a" value="0">NO</label>
                </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">In pursuance to the realization of its mission, you further give your consent to receive SMS BROADCAST relating to public information and interest and within the bounds of the welfare of the general membership and the organization as a whole.</label>
                    <br />
                    <br />
                    <label class="control-label"><input type="radio" id="confirming_b_yes" name="confirming_b" value="1" checked>YES</label>
                    <label class="control-label"><input type="radio" id="confirming_b_no" name="confirming_b" value="0">NO</label>
                </div>

                <div class="col-md-12 form-group2 group-mail">
                    <label class="control-label">Do certify to the correctness of the foregoing information and statements and affirm your membership to the FILIPINO BAYANIHAN and allow to adhere and propagate the ideals, mission and vision especially in the service to your fellowmen and countrymen.</label>
                    <br />
                    <br />
                    <label class="control-label"><input type="radio" id="confirming_c_yes" name="confirming_c" value="1" checked>YES</label>
                    <label class="control-label"><input type="radio" id="confirming_c_no" name="confirming_c" value="0">NO</label>
                </div>

                <div class="col-md-12 form-group">
                    <a href="/edit-profile?page=beneficiary" class="btn btn-default">Previous Step</a>
                    <button type="submit" class="btn btn-primary">Payment's Done</button>
                </div>

                <div class="clearfix"> </div>
            </form>

        </div>


    </div>
    <!--//grid-->

    <script>
        $(document).ready(function(){

            $('#p_member_type').on('change', function() {
                if( parseInt(this.value) == 1 ) {
                    $('#p_amount').val("500.00");
                }
                if( parseInt(this.value) == 2 ) {
                    $('#p_amount').val("1,500.00");
                }
                if( parseInt(this.value) == 3 ) {
                    $('#p_amount').val("1,500.00");
                }
            })

            $('#btnIDUpload').click(function() {
                window.open("http://localhost:8001/demo/demo.html", "mywindow", "location=1,status=1,scrollbars=1,width=472,height=220");

            })
        });
    </script>

@endsection