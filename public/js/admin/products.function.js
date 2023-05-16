jQuery(document).ready(function () {

  $('#newProductButton').click(function () {
    $('#products-modal').addClass('show');
    $('.modal-shadow').addClass('show');
  });

  jQuery("#submit-button").click(function (e) {
    var dataForm = {
      name: jQuery("#product_name").val(),
      first_price: jQuery("#product_first-price").val(),
      second_price: jQuery("#product_second-price").val(),
      quantity: jQuery("#product_quantity").val(),
      discount: jQuery("#product_discount").val(),
      type_taxes: $('input[name=product_type-taxes]:checked', '#productForm').val()
    };
    e.preventDefault();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('input[name="_token"]').val(),
      },
    });
    jQuery.ajax({
      url: "/dashboard/products",
      method: "post",
      data: dataForm,
      success: function (result) {

        $('#products-modal').removeClass('show');
        $('.modal-shadow').removeClass('show');

        $('.alert').css('display', 'flex');
        $(".alert-message").html(result.message);

        $('.data-container').load('/dashboard/products');

        $('.loading').css('display', 'none');
      },
    }).fail(function (jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
      // if (jqXHR.responseJSON.errors.rtn) {
      //   $("#rtn-error").html(jqXHR.responseJSON.errors.rtn);
      // }

      // if (jqXHR.responseJSON.errors.full_name) {
      //   $("#full_name-error").html(jqXHR.responseJSON.errors.full_name);
      // }

      // if (jqXHR.responseJSON.errors.email) {
      //   console.log(jqXHR.responseJSON.errors.email);
      //   $("#email-error").html(jqXHR.responseJSON.errors.email);
      // }

      // if (jqXHR.responseJSON.errors.phone) {
      //   console.log(jqXHR.responseJSON.errors.phone);
      //   $("#phone-error").html(jqXHR.responseJSON.errors.phone);
      // }
    });
  });

  $(".deleteProduct").click(function () {
    let res = confirm('¿Esta seguro de eliminar este elemento?');

    if (res) {
      $('.loading').css('display', 'flex');
      var id = $(this).data("id");
      var token = $(this).data("token");
      $.ajax(
        {
          url: "dashboard/products/" + id,
          type: 'DELETE',
          dataType: "JSON",
          data: {
            "id": id,
            "_method": 'DELETE',
            "_token": token,
          },
          success: function () {
            $('.data-container').load('/dashboard/products');
            $('.loading').css('display', 'none');
          },

        });
    }
  });
});