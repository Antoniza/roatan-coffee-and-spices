jQuery(document).ready(function () {

    $('#newClientButton').click(function (){
        $('#clients-modal').toggleClass('show');
        $('.modal-shadow').toggleClass('show');
    });

    jQuery("#saveCaiData").click(function (e) {
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
      jQuery.ajax({
        url: "/dashboard/settings",
        method: "post",
        data: dataForm,
        success: function (result) {
          $('.settings-alert').addClass('show');
          $("#settings-alert-message").html(result.message);
        },
      });
    });
  
    jQuery("#updateCaiData").click(function (e) {
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
        },
      });
    });
  });
  