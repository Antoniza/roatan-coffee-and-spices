jQuery(document).ready(function () {
  var todaysDate = new Date();
  var year = todaysDate.getFullYear();
  var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
  var day = ("0" + todaysDate.getDate()).slice(-2);

  var minDate = (year + "-" + month + "-" + day);
  $('#startDate').attr('min', minDate);
  $('#endDate').attr('min', minDate);

  // * SETTING INPUT MASK TO DO MORE EASY THE INPUT DATA

  $('#startRange').inputmask('999-999-99-99999999');
  $('#endRange').inputmask('999-999-99-99999999');
  $('#rtnCode').inputmask('99999999999999');
  $('#caiCode').inputmask('******-******-******-******-******-**');

  $('#invoice_phone').inputmask('+(999) 9999-9999');

  // * SAVE DATA OF CAI

  jQuery("#saveCaiData").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      cai: jQuery("#caiCode").val().toUpperCase(),
      rtn: jQuery("#rtnCode").val(),
      start_date: jQuery("#startDate").val(),
      end_date: jQuery("#endDate").val(),
      start_range: jQuery("#startRange").val(),
      end_range: jQuery("#endRange").val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    jQuery.ajax({
      url: "/dashboard/settings",
      method: "post",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');
        $('.data-container').load('/dashboard/settings');

        swal({
          title: "Exitoso",
          text: "Factura configurada exitosamente.",
          icon: "success",
          button: "¡Perfecto!",
        });
      },
    });
  });

  // * UPDATE CAI SETTING

  jQuery("#updateCaiData").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      cai: jQuery("#caiCode").val(),
      rtn: jQuery("#rtnCode").val(),
      start_date: jQuery("#startDate").val(),
      end_date: jQuery("#endDate").val(),
      start_range: jQuery("#startRange").val(),
      end_range: jQuery("#endRange").val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    let urlUpdate = "/dashboard/settings/" + jQuery("#id").val();
    jQuery.ajax({
      url: urlUpdate,
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');
        swal({
          title: "Exitoso",
          text: "Factura actualizada exitosamente.",
          icon: "success",
          button: "¡Perfecto!",
        });
      },
    });
  });

  // * UPDATE DOLAR CHANGE

  jQuery("#updateDolarChange").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      dolar_change: jQuery("#dolar_change").val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    let urlUpdate = "/dashboard/settings-dolar/" + jQuery("#id").val();
    jQuery.ajax({
      url: urlUpdate,
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');
        swal({
          title: "Exitoso",
          text: "Taza de cambio actualizada exitosamente.",
          icon: "success",
          button: "¡Perfecto!",
        });
      },
    });
  });

  // * UPDATE INVOICE HEADER

  jQuery("#updateInvoiceHeader").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      invoice_header: {
        invoice_location: jQuery("#invoice_location").val(),
        invoice_phone: jQuery("#invoice_phone").val(),
        invoice_email: jQuery("#invoice_email").val()
      }
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    let urlUpdate = "/dashboard/settings-invoice_header/" + jQuery("#id").val();
    jQuery.ajax({
      url: urlUpdate,
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');
        swal({
          title: "Exitoso",
          text: "Encabezado de factura actualizada exitosamente.",
          icon: "success",
          button: "¡Perfecto!",
        });
      },
    });
  });
});

$("#update_profile").click(function(){
  var dataForm = {
    name: jQuery("#user_name").val(),
    email: jQuery("#user_email").val(),
    phone: jQuery("#user_phone").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $(this).data("token"),
    },
  });
  jQuery
    .ajax({
      url: "/update-user/" + $('#user_id').val(),
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');

        swal({
          title: "Exitoso",
          text: "Información de usuario actualizada.",
          icon: "success",
          button: "¡Perfecto!",
        });

        $('#username').html(jQuery("#user_name").val());
        $(".main-body").load("/settings");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      alert('Ocurrio un error inesperado. Intente mas tarde.');
      $('.loading').css('display', 'none');
    });
});

// * CURRENT PASSWORD VISIBILITY

$('#show_current_password').click(function(){
  $('#current_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_current_password').css('display', 'block');
});

$('#hide_current_password').click(function(){
  $('#current_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_current_password').css('display', 'block');
});

// * NEW PASSWORD VISIBILITY

$('#show_new_password').click(function(){
  $('#new_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_new_password').css('display', 'block');
});

$('#hide_new_password').click(function(){
  $('#new_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_new_password').css('display', 'block');
});

// * CONFIRM PASSWORD VISIBILITY

$('#show_confirm_password').click(function(){
  $('#confirm_password').attr("type", "text");
  $(this).css('display', 'none');
  $('#hide_confirm_password').css('display', 'block');
});

$('#hide_confirm_password').click(function(){
  $('#confirm_password').attr("type", "password");
  $(this).css('display', 'none');
  $('#show_confirm_password').css('display', 'block');
});

$("#update_password").click(function(){
  var dataForm = {
    old_password: jQuery("#current_password").val(),
    new_password: jQuery("#new_password").val(),
    new_password_confirmation: jQuery("#confirm_password").val()
  };
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $(this).data("token"),
    },
  });
  jQuery
    .ajax({
      url: "/update-password/" + $('#user_id').val(),
      method: "patch",
      data: dataForm,
      success: function (result) {
        $('.loading').css('display', 'none');

        swal({
          title: "Exitoso",
          text: "Contraseña actualizada correctamente.",
          icon: "success",
          button: "¡Perfecto!",
        });

        $(".main-body").load("/settings");
      },
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.log(jqXHR.responseJSON.message);
      swal({
        title: "Error",
        text: jqXHR.responseJSON.message,
        icon: "error",
        button: "Entendido",
      });
      $('.loading').css('display', 'none');
    });
});