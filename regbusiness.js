$(document).ready(function() {
    $(".chosen").chosen({
        search_contains: true,
      inherit_select_classes: true
    });


    $('#sports').chosen().on('change', function()  {
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
  });

    $('#category').chosen().on('change', function()  {
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
  });

  function displayoption()
  {
    $('#prod').empty();

  }
  function displayproducts(data)
  {
    console.log(data);
     for (var prod of data) {
            var item=  "<option value = \""+ prod['category_id']+ " " +
            + prod['product_id']+"\">"+prod['product_name']+"</option>";
      $('#prod').append(item);
    }
    $('#prod').prop('disabled', false);

    $("#prod").trigger("chosen:updated");

  }

  
  $('#breg-form').submit(function(){  
    var image_name = $('#fileToUpload').val();  
    if(image_name == '')  
    {  
         alert("Please Select Image");  
         return false;  
    }  
    else  
    {  
         var extension = $('#fileToUpload').val().split('.').pop().toLowerCase();  
         if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
         {  
              alert('Invalid Image File');  
              $('#fileToUpload').val('');  
              return false;  
         }  
    }  
});
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function (e) {
          $("table").attr("CELLPADDING","0");
          $('#logo-img').removeClass("d-none");
          $('#logo-img').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]);
  }
}

$("#fileToUpload").change(function(){
  readURL(this);
});




});
