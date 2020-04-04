
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

// window.setTimeout(function() {
//   $(".alert").fadeTo(700, 0).slideUp(1000, function() {
//       $(this).remove()
//   })
// }, 5000);

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
      alert(es + extall);
      $("#photo").val("").focus();
      // $("#photo_profile").attr("src", "../../img/profile-default.png");
      return false;
  }


  return true;
}

$("#forminfo").validate({
  rules: {
    username: {
      minlength: 5,
        required: true,
        remote: {
            url: "apps/profile/do_profile.php?action=check_username",
            type: "post",
            data: {
                username: function () {
                    return $("#username").val();
                }
            }
        }
    },
    email: {
      required: true,
      remote: {
          url: "apps/profile/do_profile.php?action=check_email",
          type: "post",
          data: {
              email: function () {
                  return $("#email").val();
              }
          }
      }
  },
    first_name: "required",
    last_name: "required",
  },
  messages: {
    username: {
        required: required_username,
    },
    email: required_email,
    first_name: required_first_name,
    last_name: required_last_name,
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

$("#formpassword").validate({
  rules: {
    current_password: {
        minlength: 6,
        required: true,
        remote: {
            url: "apps/profile/do_profile.php?action=check_password",
            type: "post",
            data: {
                current_password: function () {
                    return $("#current_password").val();
                }
            }
        }
    },
    new_password: {
      minlength: 6,
      required: true,
    },
    confirm_password: {
      equalTo: "#new_password",
      minlength: 6,
      required: true,
    }
    
  },
  messages: {
    current_password: {
        required: required_current_password
    },
    new_password: {
        required: required_new_password,
        minlength: required_password_len
    },
    confirm_password: {
        required: required_confirm_password,
        minlength: required_password_len,
        equalTo: required_equalto_password
    },
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