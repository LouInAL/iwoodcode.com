function initListener() {
    $("footer div button").click(function() {
        
        var url = "email.php";      // Destination for AJAX request
        
        var email_data = {          // Object containing data needed for email
            email_subject : "Inquiry From iWoodCode.com",
            email_name    : $("#name").val(),
            email_company : $("#company").val(),
            email_phone   : $("#phone").val(),
            email_email   : $("#email").val(),
            email_date    : $("#date").val()
        };

        // AJAX call to send email
        var data = $.getJSON(url, email_data, function(data) {
            
            $("footer div:nth-child(2)").html(data['message']);
            
            if (data['success']) {
                $("input").val("");
            }
        });
    });
}
