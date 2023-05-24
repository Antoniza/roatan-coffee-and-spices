jQuery(document).ready(function () {

  // * SETTING INPUT MASK TO DO MORE EASY THE INPUT DATA

  $('#startRange').inputmask('999-999-99-99999999');
  $('#endRange').inputmask('999-999-99-99999999');
  $('#rtnCode').inputmask('99999999999999');
  $('#caiCode').inputmask('******-******-******-******-******-**');

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
          text: "Factura Configurada exitosamente.",
          icon: "success",
          button: "¡Perfecto!",
        });
      },
    });
  });

  // * SAVE EDITED CAI SETTING

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
      method: "post",
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
});
