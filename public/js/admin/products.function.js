jQuery(document).ready(function () {

    $('#newProductButton').click(function () {
      $('#products-modal').addClass('show');
      $('.modal-shadow').addClass('show');
    });
  
    $('#client_phone').inputmask('+(999)-9999-9999');
    $('#client_dni').inputmask('9999-9999-99999');
  
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
  
          jQuery("#client_full_name").val('');
          jQuery("#client_dni").val('');
          jQuery("#client_email").val('');
          jQuery("#client_phone").val('');
  
          $('.form-alert').removeClass('show');
          $('#clients-modal').removeClass('show');
          $('.modal-shadow').removeClass('show');
  
          $('.data-container').load('/dashboard/clients');
        },
      }).fail(function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.responseJSON.errors.dni) {
          $("#dni-error").html(jqXHR.responseJSON.errors.dni);
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
      });
  
      $("#dni-error").html("");
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
  });