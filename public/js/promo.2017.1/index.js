// initialize Account Kit with CSRF protection
AccountKit_OnInteractive = function(){
    AccountKit.init(
        {
            appId:"1968789146737360",
            state:_csrf_token,
            version:"v1.1",
            debug: true
        }
    );
};

// login callback
$("#btnContinue").hide();
function loginCallback(response) {
    if (response.status === "PARTIALLY_AUTHENTICATED") {
        _code = response.code;
        _csrf = response.state;
        console.log(_code + " | " + _csrf);

        $('.success').addClass("fold-up");
        $('.final').removeClass("folded");
        $('.final').css("marginTop", 0);

        $('#tag_line').empty().text("Thank you for registering.");
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
    var _phoneNumber = $('#mobile').val();
    AccountKit.login(
        'PHONE',
        { countryCode : '+63', phoneNumber : _phoneNumber },
        loginCallback
    );
}

$('.mobile').on("change keyup paste",
    function(){
        if($(this).val()){
            $('.icon-paper-plane').addClass("next");
        } else {
            $('.icon-paper-plane').removeClass("next");
        }
    }
);

$('.next-button').hover(
    function(){
        $(this).css('cursor', 'pointer');
    }
);

$('.next-button.mobile').click(
    function(){
        console.log("Something");
        $('.success').css("marginTop", 0);
        smsLogin();
    }
);

$('#btnProceed').click(
    function(){
        var data = { code : _code, csrf : _csrf };
        console.log(data);
        ajax_execute(data, "/account/kit-2/execute", "btnProceed")
    }
);

function ajax_execute(data, url, button_id) {
    $(document).ready(function() {
        $.ajax({
            dataType: 'json',
            type:'GET',
            url: url,
            data: data,
            beforeSend: function () {
                $("#"+button_id).text("Please wait....");
            }
        }).done(function(data){
            console.log(data);
            if(data.access_token != "") {
                window.location.href="/account/kit-2/access/"+ data.id + "/" + data.access_token;
            }
        });
    })
}

