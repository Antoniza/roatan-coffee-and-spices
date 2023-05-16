jQuery(document).ready(function () {

  $('#newClientButton').click(function () {
    $('#clients-modal').addClass('show');
    $('.modal-shadow').addClass('show');
  });

  $('#client_phone').inputmask('+(999) 9999-9999');
  $('#client_rtn').inputmask('9999-9999-99999-9');

  jQuery("#submit-client-button").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      full_name: jQuery("#client_full_name").val(),
      rtn: jQuery("#client_rtn").val(),
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

        jQuery("#client_full_name").val('');
        jQuery("#client_rtn").val('');
        jQuery("#client_email").val('');
        jQuery("#client_phone").val('');

        $('#clients-modal').removeClass('show');
        $('.modal-shadow').removeClass('show');

        $('.alert').css('display', 'flex');
        $(".alert-message").html(result.message);

        $('.data-container').load('/dashboard/clients');

        $('.loading').css('display', 'none');
      },
    }).fail(function (jqXHR, textStatus, errorThrown) {
      if (jqXHR.responseJSON.errors.rtn) {
        $("#rtn-error").html(jqXHR.responseJSON.errors.rtn);
      }

      if (jqXHR.responseJSON.errors.full_name) {
        $("#full_name-error").html(jqXHR.responseJSON.errors.full_name);
      }

      if (jqXHR.responseJSON.errors.email) {
        console.log(jqXHR.responseJSON.errors.email);
        $("#email-error").html(jqXHR.responseJSON.errors.email);
      }

      if (jqXHR.responseJSON.errors.phone) {
        console.log(jqXHR.responseJSON.errors.phone);
        $("#phone-error").html(jqXHR.responseJSON.errors.phone);
      }

      $('.loading').css('display', 'none');
    });

    $("#rtn-error").html("");
    $("#full_name-error").html("");
    $("#email-error").html("");
    $("#phone-error").html("");
  });

  $(".deleteClient").click(function () {
    let res = confirm('¿Esta seguro de eliminar este elemento?');

    if (res) {
      $('.loading').css('display', 'flex');
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax(
        {
          url: "dashboard/clients/" + id,
          type: 'DELETE',
          dataType: "JSON",
          data: {
            "id": id,
            "_method": 'DELETE',
            "_token": token,
          },
          success: function () {
            $('.data-container').load('/dashboard/clients');
            $('.loading').css('display', 'none');
          },

        });
    }
  });

  $('.edit-link').click(function (e) {
    e.preventDefault();
    $('.loading').css('display', 'flex');
    $('.data-container').load($(this).attr('href'));
    $('.loading').css('display', 'none');
  });

  jQuery("#edit-client-button").click(function (e) {
    $('.loading').css('display', 'flex');
    let id = jQuery("#edit-client_id").val();
    var dataForm = {
      full_name: jQuery("#edit-client_full_name").val(),
      rtn: jQuery("#edit-client_rtn").val(),
      email: jQuery("#edit-client_email").val(),
      phone: jQuery("#edit-client_phone").val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    jQuery.ajax({
      url: "/dashboard/clients/" + id,
      method: "patch",
      data: dataForm,
      success: function (result) {

        jQuery("#edit-client_id").val('');
        jQuery("#edit-client_full_name").val('');
        jQuery("#edit-client_rtn").val('');
        jQuery("#edit-client_email").val('');
        jQuery("#edit-client_phone").val('');

        $('.alert').css('display', 'flex');
        $(".alert-message").html(result.message);

        $('.data-container').load('/dashboard/clients');

        $('.loading').css('display', 'none');
      },
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
      if (jqXHR.responseJSON.errors.rtn) {
        $("#edit-rtn-error").html(jqXHR.responseJSON.errors.rtn);
      }

      if (jqXHR.responseJSON.errors.full_name) {
        $("#edit-full_name-error").html(jqXHR.responseJSON.errors.full_name);
      }

      if (jqXHR.responseJSON.errors.email) {
        console.log(jqXHR.responseJSON.errors.email);
        $("#edit-email-error").html(jqXHR.responseJSON.errors.email);
      }

      if (jqXHR.responseJSON.errors.phone) {
        console.log(jqXHR.responseJSON.errors.phone);
        $("#edit-phone-error").html(jqXHR.responseJSON.errors.phone);
      }

      $('.loading').css('display', 'none');
    });

    $("#edit-rtn-error").html("");
    $("#edit-full_name-error").html("");
    $("#edit-email-error").html("");
    $("#edit-phone-error").html("");
  });
});