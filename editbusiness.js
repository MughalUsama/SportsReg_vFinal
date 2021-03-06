$(document).ready(function() {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#logo-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
      }
      
      $("#fileToUpload").change(function(){
        readURL(this);
      });
      
    var b_id = $("#bus-id").text();
    $.ajax(
        {
            url: 'getbusinessdata.php',
            type: 'POST',
            dataType : 'json',
            data: {bid:b_id},
            success: displayaccounts,
            error: function(err,errt){
                console.log(errt);
            }
            });
    function displayaccounts(data)
        {

            var cat = data["cat"];
            var pro = data["pro"];
            var county = data["county"];
        
            cat.forEach(function (arrayItem) {
            var id = arrayItem["category_id"]
                $("#category > option[value='"+ id +"']").attr("selected","selected");
                });
                $("#category").trigger("chosen:updated");
            pro.forEach(function (arrayItem) {
                var id = arrayItem["product_id"]
                $("#prod > option[value='"+ id +"']").attr("selected","selected");
                });

                $("#prod").trigger("chosen:updated");
            county.forEach(function (arrayItem) {
                var cname = arrayItem["county_name"]
                $("#county > option[value='"+ cname +"']").attr("selected","selected");
                });
                $("#county").trigger("chosen:updated");

                updateprod();
        }


        $('#category').chosen().on('change', updateprod);
        $('#sports').chosen().on('change', updateprod);
        function updateprod()  {
            if($('#category').val().length>0)
            {
                var cat = $('#category').val();
                displayoption();
                var sportsname = $('#sports').val();
                console.log(sportsname);
              for(var inde = 0; inde<sportsname.length;inde++){
                console.log(sportsname[inde]);
                for(var i of cat){
                  $.ajax(
                      {
                          url: 'getproducts.php',
                          type: 'POST',
                          dataType : 'json',
                          data: {category:i, sports:sportsname[inde]},
                          success: displayproducts,
                          error: function(err,errt){
                              console.log(errt);
                          }
                      }
                  );
                }  
              }
            }
            else{
              $('#prod').empty();
              $('#prod').prop('disabled', true);
              $("#prod").trigger("chosen:updated");
      
            }
      }


        function displayoption()
        {
          $('#prod').empty();
      
        }
        function displayproducts(data)
        {
           for (var prod of data) {
                  var item=  "<option value = \""+ prod['category_id']+ " " +
                  + prod['product_id']+"\">"+prod['product_name']+"</option>";
            $('#prod').append(item);
          }
          $('#prod').prop('disabled', false);
      
          $("#prod").trigger("chosen:updated");
      
        }
      
});