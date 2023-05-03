jQuery(document).ready(function () {
  jQuery("#saveButton").click(function (e) {
    var dataForm = {
      name: jQuery("#name").val(),
      email: jQuery("#email").val(),
      phone: jQuery("#phone").val(),
      password: jQuery("#password").val(),
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    jQuery.ajax({
      url: "/register",
      method: "post",
      data: dataForm,
      success: function (result) {
        $("#message").html(result.message);
        console.log(result.data);
        $("#names").append("<li>" + result.data.name + "</li>");

        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");
        $("#email").val("");
      },
    });
  });
});
