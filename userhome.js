
$(document).ready(function() {
 
    $("#username").text($("#clubname").text());

//filling products option
    $('#sports').on('change', function()  {
    if($('#category').val()!=-1 &&  $('#sports').val()!=-1)
    {
        var cat = $('#category').val();
        var sportsname = $('#sports').val();
        $.ajax(
            {
                url: 'getproducts.php',
                type: 'POST',
                dataType : 'json',
                data: {category:cat, sports:sportsname},
                success: displayproducts,
                error: function(err,errt){
                    console.log(errt);
                }
            }
        );
    }
    });


    $('#category').on('change', function()  {
        if($('#category').val()!=-1)
        {
            var cat = $('#category').val();
            var sportsname = $('#sports').val();
            $.ajax(
                {
                    url: 'getproducts.php',
                    type: 'POST',
                    dataType : 'json',
                    data: {category:cat, sports:sportsname},
                    success: displayproducts,
                    error: function(err,errt){
                        console.log(errt);
                    }
                }
            );
        }
    });


function displayproducts(data)
{
    $('#prod').empty();
    var item=  "<option  value = '' selected>Choose Product/Service </option>";
    $('#prod').append(item);

    for (var prod of data) {
        var item=  "<option value = \""
        + prod['product_id']+"\">"+prod['product_name']+"</option>";
        $('#prod').append(item);
    }
}
});