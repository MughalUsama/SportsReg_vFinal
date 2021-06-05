$(document).ready(function() {
    $("#contact-form").submit(function() {
    var name = $("#name").val();
    var email = $("#email").val();
    var telephone =$("#telephone").val();
    var msg = $("#description").val();
    var data = {
        "name" : name,
        "email": email,
        "telephone": telephone,
        "msg": msg
    }     
//    console.log(data);
    //send mail from here.
//     $.ajax(
//           {
//               url: 'getrequests.php',
//               type: 'POST',
//               dataType : 'json',
//               data: {admin:mail},
//               success: successfun,
//               error: function(err,errt){
//                   console.log(errt);
//               }
//           }
//       );
          
//   function successfun(data) {
//       }

        return false;
    });
});