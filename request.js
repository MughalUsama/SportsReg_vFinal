$(document).ready(function() {

    var scount = 0;
    $("#detail-form").submit(function(e) {
        if(scount==0)
        {
            e.preventDefault();
        }
        else{
            scount = 0;
            return true;
        }
        scount = 1;
        $("#exampleModalScrollable0").modal('show');
        $('#exampleModalScrollable0').on('hidden.bs.modal', function () {
            $("#detail-form").submit();    
        });
        
    // var quantity = $("#quantity").val();
    // var color = $("#color").val();
    // var size = $("#size").val();
    // var description = $("#description").val();
    // var details = {
    //     "quantity": quantity,
    //     "color" : color,
    //     "size" : size,
    //     "description" : description
    // };

    // var xhr = $.ajax(
    //     {
    //         url: 'mailrequests.php',
    //         type: 'POST',
    //         dataType : 'json',
    //         data: {detail:details},
    //     }
    // );
    // xhr.abort();    

    // alert("Request Sent!");
    // loadUrl = "./userhome.php";
    
    // return false;
    });
});