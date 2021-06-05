$(document).ready(function() {
    $('#btn-next').click(function () {
             
    window.location.href = "./login.php";
    });

    $('#partner-div').click(function () {
             
        window.location.href = "./partner.php";
    });

    $('#blog-div').click(function () {
            
        window.location.href = "./blog.php";
    });
   
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
        var item=  "<option  val = '' selected>Choose Product/Service </option>";
        $('#prod').append(item);

        for (var prod of data) {
            var item=  "<option value = \""
            + prod['product_id']+"\">"+prod['product_name']+"</option>";
			$('#prod').append(item);
		}
    }
    var count = 0;
    var hT = 0;
    $(window).scroll(function() {
        hT = $('#an1').offset().top;
        var hH = $('#an1').outerHeight(),
            wH = $(window).height();
            wS = $(this).scrollTop();
        if ((wS > (hT+hH-wH) && count==0 && wS<(hT+hH))|| count==0){
            count=1;
            $("#transf-1").addClass("tranfclass");
            $("#transf-2").addClass("tranfclass");
            $("#transf-3").addClass("tranfclass");

        }
        if(wS<=20 || wS>(hT+hH-20))
        {
            $("#transf-1").removeClass("tranfclass");
            $("#transf-2").removeClass("tranfclass");
            $("#transf-3").removeClass("tranfclass");
            count =0;
        }
     });
     var count1 = 0;
    $(window).scroll(function() {
        var hT1 = $('#an2').offset().top,
            hH = $('#an2').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        if ((wS > (hT1+hH-wH) && count1==0 && wS>hT+40 && wS<(hT1+hH))|| count1==0){
            count1=1;
            $("#transf-4").addClass("tranfclass1");
            $("#transf-5").addClass("tranfclass1");
            $("#transf-6").addClass("tranfclass1");

        }
        if(wS<=20 || wS>(hT1+hH-20) || wS>(hT1-20) || wS<hT)
        {
            $("#transf-4").removeClass("tranfclass1");
            $("#transf-5").removeClass("tranfclass1");
            $("#transf-6").removeClass("tranfclass1");
            count1 = 0;
        }
     });
});