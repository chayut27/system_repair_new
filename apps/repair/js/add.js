$(function () {
    // $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4',
        escapeMarkup: function (markup) { return markup; },
        "language": {
            "noResults": function(){
                return no_result;
            }
        },
    });
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
