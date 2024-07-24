
function deleteLstorage(){
    localStorage.removeItem("UID");
    localStorage.removeItem("first_name");
    localStorage.removeItem("last_name");
    localStorage.removeItem("mobile_number");
    localStorage.removeItem("Transaction ID");
    localStorage.removeItem("rzp_device_id");
    localStorage.removeItem("rzp_id");
    localStorage.removeItem("Batch Fee");
    localStorage.removeItem("numericUID");
    localStorage.removeItem("mytime");
    localStorage.removeItem("rzp_checkout_anon_id");
    
}
    // JavaScript for country code and mobile number
    var phone_number = window.intlTelInput(document.querySelector("#phone_number"), {
        separateDialCode: true,
        preferredCountries: ["in"],
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });

    $("form").submit(function () {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone_number[full]'").val(full_number);
        $("#phone_number").val(full_number);
    });
    //code for dropdown selection
    function DoSomethingOnChange(selectBox) {
        if ($(selectBox).find(":selected").text().trim().toUpperCase() == "OTHER") {
            $('.other-input').show();
        }
        else {
            $('.other-input').hide();
            $('.other-input').val(""); //clear out the value if required
        }
    }

    var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?92856';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled": true,
        "chatButtonSetting": {
            "backgroundColor": "#00e785",
            "ctaText": "Chat with us",
            "borderRadius": "25",
            "marginLeft": "0",
            "marginRight": "20",
            "marginBottom": "20",
            "ctaIconWATI": false,
            "position": "right"
        },
        "brandSetting": {
            "brandName": "shreetech software development",
            "brandSubTitle": "undefined",
            "brandImg": "https://www.wati.io/wp-content/uploads/2023/04/Wati-logo.svg",
            "welcomeText": "Hi there!\nHow can I help you?",
            "messageText": "Hello, %0A I have a question about {{page_link}}",
            "backgroundColor": "#00e785",
            "ctaText": "Chat with us",
            "borderRadius": "25",
            "autoShow": false,
            "phoneNumber": "7057445099"
        }
    };
    s.onload = function () {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
 
    function calculateAge() {
        const dob = document.getElementById('inputDob').value;
        if (dob) {
            const [day, month, year] = dob.split('/');
            const dobDate = new Date(`${year}-${month}-${day}`);
            const today = new Date();
            let age = today.getFullYear() - dobDate.getFullYear();
            const monthDiff = today.getMonth() - dobDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            document.getElementById('result').value = ` ${age} ` + " " + "yrs";

            document.getElementById("dob").innerText = document.getElementById("inputDob").value;
        } else {
            document.getElementById('result').innerText = 'Please select your date of birth.';
        }
    }

