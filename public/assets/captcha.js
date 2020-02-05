var onloadCallback = function () {
    grecaptcha.render('html_element', {
        'sitekey': '6Ld79NUUAAAAAJl3JeWDMZps3clvNxwFETGMc5ca',
        'callback': 'enableSubmitBtn',
    });
};

function enableSubmitBtn(){
    document.getElementById('submit-button').disabled = false;
}

if (grecaptcha.getResponse() === true) {
    document.getElementById('submit-button').disabled = false;
}

function checkReCaptcha() {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
        //reCAPTCHA not verified
        console.log("CAPTCHA non vérifié");
    }
}

function backend_API_challenge() {
    var response = grecaptcha.getResponse();
    $.ajax({
        type: "POST",
        url: 'https://www.google.com/recaptcha/api/siteverify',
        data: {
            "secret": "(6Ld79NUUAAAAACHtrjE94_FSusESBPZYhbv0s_kU)",
            "response": response,
            "remoteip": "localhost"
        },
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            console.log(data);
        }
    });
}