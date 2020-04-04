

$(function() {

  $('.select2bs4').select2({
    theme: 'bootstrap4',
    escapeMarkup: function (markup) { return markup; },
    "language": {
      "noResults": function(){
          return no_result;
      }
    },
  });

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
      title: '&nbsp;&nbsp;'+msg
    })

  }
});



$("#forminfo").validate({
  rules: {
      invent: "required",
      problem: "required",
      description: "required",
      technician: "required",
  },
  messages: {
    invent: msg_invent,
    problem: msg_problem,
    description: msg_description,
    technician: msg_technician,
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
      // $(element).addClass("is-valid").removeClass("is-invalid");
      $(element).removeClass("is-invalid");
  }
});



