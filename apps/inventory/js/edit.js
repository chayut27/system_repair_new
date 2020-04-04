
$(document).ready(function () {
  bsCustomFileInput.init()
})

$("#photo").on("change", function(){
  var photo = $(this).val();
  if(photo == ""){
    $(".btn-upload").prop("disabled", true);
  }else{
    $(".btn-upload").prop("disabled", false);
  }
});

$(function() {
  var type_txt;
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


    
  if(msg){

      if(status == true){
          type_txt = "success";
      }else{
          type_txt = "error";
      }

  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });


    Toast.fire({
      type: type_txt,
      title: "&nbsp;&nbsp;"+msg
    })

  }
});

function readURL(input) {
  OnUploadCheck();
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#photo_profile").attr("src", e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

function OnUploadCheck() {
  var extall = "jpg,jpeg,png";
  file = $("#photo").val();
  ext = file.split('.').pop().toLowerCase();
  if (parseInt(extall.indexOf(ext)) < 0) {
      alert(ex + extall);
      $("#photo").val("").focus();
      return false;
  }


  return true;
}

$("#forminfo").validate({
  rules: {
    name: "required",
    serial_number: "required",
    category: "required",
    type: "required",
    brand: "required",
  },
  messages: {
    name: required_name,
    serial_number: required_serial_number,
    category: required_category,
    type: required_type,
    brand: required_brand,
  },
  errorElement: "em",
  errorPlacement: function (error, element) {
      // Add the `invalid-feedback` class to the error element
      error.addClass("invalid-feedback");
      error.insertAfter(element);
      

  },
  highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
  },
  unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
  }
});

$(function() {

  for(x in arr_cate){
    var cate_selected = "";
    if(category == arr_cate[x]["id"]){
      cate_selected = "selected";
    }
  
    var cate_txt;
    cate_txt += '<option value='+arr_cate[x]["id"]+' '+cate_selected+'>'+arr_cate[x]["name"]+'</option>';
  }
  
  $("#category").append(cate_txt);
  
  for(x in arr_type){
    var type_txt;
    if(arr_type[x]["category"] == category){
      type_txt += '<option value='+arr_type[x]["id"]+'>'+arr_type[x]["name"]+'</option>';
    }
   
  }
  
  $("#type").append(type_txt);
  $("#type").val(type);
  
  /////////////////////////////////////
  
  for(x in arr_brand){
    var brand_txt;
    if(arr_brand[x]["type"] == type){
      brand_txt += '<option value='+arr_brand[x]["id"]+'>'+arr_brand[x]["name"]+'</option>';
    }
   
  }
  
  $("#brand").append(brand_txt);
  $("#brand").val(brand);
  
  /////////////////////////////////////
  
  $("#category").on("change", function(){
  
    $("#type option").not(":first").remove();
    $("#brand option").not(":first").remove();
  
    for(x in arr_type){
  
  
      var type_txt;
      if(arr_type[x]["category"] == $(this).val()){
        type_txt += '<option value='+arr_type[x]["id"]+'>'+arr_type[x]["name"]+'</option>';
      }
     
    }
    
    $("#type").append(type_txt);
  })
  
  
  $("#type").on("change", function(){
  
    $("#brand option").not(":first").remove();
  
    for(x in arr_brand){
      var brand_txt;
      if(arr_brand[x]["type"] == $(this).val()){
        brand_txt += '<option value='+arr_brand[x]["id"]+'>'+arr_brand[x]["name"]+'</option>';
      }
     
    }
    
    $("#brand").append(brand_txt);
  })
  
  
  });