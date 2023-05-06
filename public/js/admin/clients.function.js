jQuery(document).ready(function () {

  $('#newClientButton').click(function () {
    $('#clients-modal').toggleClass('show');
    $('.modal-shadow').toggleClass('show');
  });

  jQuery("#submit-button").click(function (e) {
    var dataForm = {
      full_name: jQuery("#client_full_name").val(),
      dni: jQuery("#client_dni").val(),
      email: jQuery("#client_email").val(),
      phone: jQuery("#client_phone").val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    jQuery.ajax({
      url: "/dashboard/clients",
      method: "post",
      data: dataForm,
      success: function (result) {
        $('.form-alert').addClass('show');
        $("#form-alert-message").html(result.message);
      },
    });
  });
});