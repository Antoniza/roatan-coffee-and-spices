jQuery(document).ready(function () {

  $('#startRange').inputmask('999-999-99-99999999');
  $('#endRange').inputmask('999-999-99-99999999');
  $('#rtnCode').inputmask('9999-9999-99999-9');
  $('#caiCode').inputmask('******-******-******-******-******-**');

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
        $('.settings-alert').toggleClass('show');
        $("#settings-alert-message").html(result.message);
        $('.loading').css('display', 'none');
        $('.data-container').load('/dashboard/settings');
        $('.alert').css('display', 'flex');
        $(".alert-message").html("Factura Configurada exitosamente.");
      },
    });
  });

  jQuery("#updateCaiData").click(function (e) {
    $('.loading').css('display', 'flex');
    var dataForm = {
      cai: jQuery("#caiCode").val(),
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
        $('.settings-alert').addClass('show');
        $("#settings-alert-message").html(result.message);
        $('.loading').css('display', 'none');
        setTimeout(function () {
          $('.settings-alert').toggleClass('show');
        }, 5200);
      },
    });
  });
});
