$(document).ready(function() {

    $('#sports2').on('change', function()  {
        if($('#remcategory').val()!=-1 &&  $('#sports2').val()!=-1)
        {
            var cat = $('#remcategory').val();
            var sportsname = $('#sports2').val();

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

    $('#remcategory').on('change', function()  {
        if($('#remcategory').val()!=-1)
        {
            var cat = $('#remcategory').val();
            var sportsname = $('#sports2').val();

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
        var item=  "<option  val = '' selected>Choose Product/Service </option>";
        $('#prod').append(item);

        for (var prod of data) {
            var item=  "<option value = \""
            + prod['product_id']+"\">"+prod['product_name']+"</option>";
			$('#prod').append(item);
		}
    }

});