$(document).ready(function() {
 
    $("#reg-form").submit(function(event){
        var passwd = $('#password').val();
        var cpasswd = $('#confirmpassword').val();
        if(passwd==cpasswd){
            return true;
        }
        else{
            $('#pass-error').show();
            return false;
        }
    });


});