$(function () {
    $('#btnLogin').click(function() {
        var mobile = $('#mobile').val();
        var password = $('#password').val();
        if (mobile == null || mobile == "") {
            $('#a_mobile').show();
            return false;
        }
        if (password == null || password == "") {
            $('#a_mobile').hide();
            $('#a_password').show();
            return false;
        }
    });

    $('#btnSignUp').click(function() {
        $(function () {
            // $('#form').parsley().on('field:validated', function() {
            //     var ok = $('.parsley-error').length === 0;
            //     $('.bs-callout-info').toggleClass('hidden', !ok);
            //     $('.bs-callout-warning').toggleClass('hidden', ok);
            // })
            // .on('form:submit', function() {
            //     return false; // Don't submit form for this demo
            // });
        });
    });
});



// login callback
function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
        var code = response.code;
        var csrf = response.state;

        do_facebook_1(code, csrf);
    }
    else if (response.status === "NOT_AUTHENTICATED") {
        // handle authentication failure
        console.log("Return Status: " + response.status);
    }
    else if (response.status === "BAD_PARAMS") {
        // handle bad parameters
        console.log("Return Status: " + response.status);
    }
}

// phone form submission handler
function smsLogin() {
    AccountKit.login(
        'PHONE',
        { countryCode : '+63' }, // will use default values if not specified
        loginCallback
    );
}

// email form submission handler
function emailLogin() {
    AccountKit.login(
        'EMAIL',
        { },
        loginCallback
    );
}

function do_facebook_1(code, csrf) {
    var appId   = "239866523142614";
    var secret   = "99647c4751d6afe5a54cbc1d4c20773b";
    var version   = "v1.1";

    var url = "https://graph.accountkit.com/"+version+"/access_token?grant_type=authorization_code&code="+code+"&access_token=AA|"+appId+"|"+secret;
    $(document).ready( function() {
        $.ajax({
            url: url,
            dataType: "text",
            beforeSend: function () {
            },
            success: function(user) {
                var json = $.parseJSON(user);
                console.log(json);
                do_facebook_2(json.access_token, csrf);
            }
        });
    } )
}

function do_facebook_2(access_token, csrf) {
    $(document).ready( function() {
        $.ajax({
            url: "https://graph.accountkit.com/v1.1/me?access_token="+access_token,
            dataType: "text",
            beforeSend: function () {
            },
            success: function(user) {
                var json = $.parseJSON(user);
                console.log(json);
                $(json.phone).each(function(i, mobile){
                    // Send code to server to exchange for access token
                    document.getElementById("code").value = "0" + mobile.national_number;
                    document.getElementById("csrf").value = csrf;
                    document.getElementById("_token").value = csrf;
                    document.getElementById("login_success").submit();
                });
            }
        });
    } )
}

$(document).ready(function() {
    $( "#txt_date_of_birth" ).click(function() {
        $("#txt_date_of_birth").hide();
        $("#date_of_birth").show();
    });

    $( "#email" ).keyup(function() {
        validate("email",  $( "#email" ).val());
    });

    $( "#mobile" ).keyup(function() {

        var m = $( "#mobile" ).val();

        if(m.length != 11) {
            $("#span_mobile").show();
            $("#span_mobile").text("Please enter a valid mobile number");

            $("#form").removeAttr("action");
            $("#form").removeAttr("method");
            $("#btnSignUp").attr("disabled", "disabled");
            return false;
        }

        if(m.length > 11) {
            $("#span_mobile").show();
            $("#span_mobile").text("Please enter a valid mobile number");

            $("#form").removeAttr("action");
            $("#form").removeAttr("method");
            $("#btnSignUp").attr("disabled", "disabled");
            return false;
        }

        validate("mobile",  m);
    });

    function validate(type, value) {

        $("#span_" + type).show();

        $.ajax({
            url: "/validating/"+type+"/"+value,
            dataType: "text",
            beforeSend: function () {
                $("#span_" + type).show();
                $("#span_" + type).text("Checking...");
            },
            success: function(images) {
                var json = $.parseJSON(images);
                if(json == null)
                    return false;

                if(json.status == 500) {
                    $("#span_" + type).show();
                    $("#span_" + type).text(json.message);

                    $("#form").removeAttr("action");
                    $("#form").removeAttr("method");
                    $("#btnSignUp").attr("disabled", "disabled");
                }
                else {
                    $("#span_" + type).hide();
                    $("#span_" + type).text("");

                    $("#form").attr("action", "/sign-up/processing");
                    $("#form").attr("method", "POST");
                    $("#btnSignUp").removeAttr("disabled");
                }
            }
        });
    }
})