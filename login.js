$(document).ready(function() {
 
    //$("#login-form").submit(function(event){
        
    ///});
    $("#reset-btn").on('click', function() {
        var mail = $("#useremail").val();
        $.ajax(
            {
                url: 'mail.php',
                type: 'POST',
                dataType : 'json',
                data: {email:mail},
                success: successfn,
                error: function(err,errt){
                    console.log(errt);
                }
            }
        );
            
    })
    function successfn(data) {
        console.log("OK.")
    }

    $("#nextpass-btn").on('click', function() {
        var rcode = $("#resetcode").val();
        $.ajax(
            {
                url: 'resetcode.php',
                type: 'POST',
                dataType : 'text',
                data: {code:rcode},
                success: newpass,
                error: function(err,errt){
                    console.log(errt);
                }
            }
        );
        function newpass(data) {
            if (data == "OK") {
                $("#newpassmodal").modal("show");                
            }
            else{
                alert("Wrong reset code. Please try again.");
            }
        }
    })

    $("#change-btn").on('click', function() {
        var passwd = $("#newpass").val();
        $.ajax(
            {
                url: 'changepassword.php',
                type: 'POST',
                dataType : 'text',
                data: {password:passwd},
                success: changed,
                error: function(err,errt){
                    console.log(errt);
                }
            }
        );
    })
    function changed(data) {
        if (data == "OK") {
           alert("Password changed successfully!");                
       }
       else{
           alert("Password update failed. Please try again.");
       }
   }
   $("#userregister").on('click', function() {
    window.location.href = "./register.php";
   });

});