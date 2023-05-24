// * GO AND OUT NEW SALE PANEL

$(".edit-link").click(function (e) {
  e.preventDefault();
  $(".loading").css("display", "flex");
  $(".data-container").load($(this).attr("href"));
  $(".loading").css("display", "none");
});

$("#new-sale").click(function (e) {
  e.preventDefault();
  $(".loading").css("display", "flex");
  $(".data-container").load($(this).attr("href"));
  $(".loading").css("display", "none");
});

$('#cancel-continue').click(function () {
  $('.form-client').css('display', 'none');
});

// * SHORTCUT TO CREATE A NEW CLIENT
$('#newClientButton').click(function () {
  $('#clients-modal').addClass('show');
  $('.modal-shadow').addClass('show');
});

// * SEARCH PRODUCT FOR SALE
// TODO: PREPARING ENVIROMENT
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

$(document).ready(function () {

  // TODO: VERIFY ELEMENTS IN LIST
  let elements = $('#countElements').html();
  if (elements == 0) {
    $('#continue_sale').prop('disabled', true);
  } else {
    $('#continue_sale').prop('disabled', false);
  }

  // * LIVE SEARCHING PRODUCTS
  $("#product_search").autocomplete({
    source: function (request, response) {
      // Fetch data
      $.ajax({
        url: "/dashboard/search-products",
        type: "post",
        dataType: "json",
        data: {
          _token: CSRF_TOKEN,
          search: request.term,
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      $("#product_search").val(ui.item.label);
      $("#item_id").val(ui.item.value);
      return false;
    },
  });

  // * LIVE SEARCHING CLIENTS
  $("#rtn-search").autocomplete({
    source: function (request, response) {
      // Fetch data
      $.ajax({
        url: "/dashboard/search-clients",
        type: "post",
        dataType: "json",
        data: {
          _token: CSRF_TOKEN,
          search: request.term,
        },
        success: function (data) {
          response(data);
        },
      });
    },
    select: function (event, ui) {
      $("#rtn-search").val(ui.item.label);
      $("#client_id").val(ui.item.value);
      return false;
    },
  });

  // TODO: PRESS ENTER TO ADD NEW ITEM TO SALE DETAILS
  $('#quantity').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {

      var nFilas = $("#sale-table tr").length;
      $('#countElements').html(nFilas);

      var dataForm = {
        item: jQuery("#item_id").val(),
        quantity: jQuery("#quantity").val()
      };
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": CSRF_TOKEN
        },
      });
      jQuery.ajax({
        url: "/dashboard/get-product",
        method: "get",
        data: dataForm,
        success: function (result) {

          jQuery("#item_id").val('');
          jQuery("#product_search").val('');
          jQuery("#quantity").val(1);
          jQuery("#product_search").focus();

          let data = result.data;

          let table = $('#sale-table tbody');

          let markup = '';

          if (data.second_price != 0) {
            markup = `
            <tr id='item'>
              <td>` + result.quantity + `</td>
              <td>` + data.name + `</td>
              <td>` + (data.second_price).toFixed(2) + `</td>
              <td>` + (data.second_price * result.quantity).toFixed(2) + data.type_taxes + `</td>
            </tr>
          `;

            table.append(markup);

            let subtotal = parseFloat($('#subtotal').html());
            $('#subtotal').html((subtotal + (data.second_price * result.quantity)).toFixed(2) + ' Lps');

            let isv = parseFloat($('#isv').html());
            $('#isv').html((isv + (data.second_price - (data.second_price / 1.15)) * result.quantity).toFixed(2) + ' Lps');

            let subisv = parseFloat($('#subisv').html());
            $('#subisv').html((subisv + ((data.second_price / 1.15) * result.quantity)).toFixed(2) + ' Lps');

            let total = parseFloat($('#total').html());
            $('#total').html((total + (data.second_price * result.quantity)).toFixed(2) + ' Lps');

            $('#continue_sale').prop('disabled', false);

          } else {
            markup = `
            <tr id='item'>
              <td>` + result.quantity + `</td>
              <td>` + data.name + `</td>
              <td>` + (data.first_price).toFixed(2) + `</td>
              <td>` + (data.first_price * result.quantity).toFixed(2) + data.type_taxes + `</td>
            </tr>
          `;

            table.append(markup);

            let subtotal = parseFloat($('#subtotal').html());
            $('#subtotal').html((subtotal + (data.first_price * result.quantity)).toFixed(2) + ' Lps');

            let subtotalE = parseFloat($('#subtotalE').html());
            $('#subtotalE').html((subtotalE + (data.first_price * result.quantity)).toFixed(2) + ' Lps');

            let total = parseFloat($('#total').html());
            $('#total').html((total + (data.first_price * result.quantity)).toFixed(2) + ' Lps');

            $('#continue_sale').prop('disabled', false);
          }

          // TODO: DOUBLE CLICK IN ROW TO DELETE RECORD
          $("#sale-table tbody tr").dblclick(function (e) {

            let item = this;

            swal({
              title: "Eliminando elemento",
              text: "Se eliminara el elemento seleccionado",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
              .then((willDelete) => {
                if (willDelete) {
                  swal("¡Se eliminó con exito de la lista!", {
                    icon: "success",
                  });
                  // * GETTING QUANTITY OF THE PRODUCT IN ROW
                  let stringQuantity = String(item.innerHTML.split('\n')[1]);
                  let stringQuantityContent = stringQuantity.trim();
                  let quantity = stringQuantityContent.substring(4, stringQuantityContent.length - 5);

                  // * GETTING NAME OF THE PRODUCT IN ROW
                  let stringName = String(item.innerHTML.split('\n')[2]);
                  let stringNameContent = stringName.trim();
                  let name = stringNameContent.substring(4, stringNameContent.length - 5);

                  // * GETTING PRICES OF THE PRODUCT IN ROW
                  let stringPrice = String(item.innerHTML.split('\n')[3]);
                  let stringPriceContent = stringPrice.trim();
                  let price = stringPriceContent.substring(4, stringPriceContent.length - 5);

                  // * GETTING TOTAL OF PRODUCT IN ROW
                  let stringTotal = String(item.innerHTML.split('\n')[4]);
                  let stringTotalContent = stringTotal.trim();
                  let total = stringTotalContent.substring(4, stringTotalContent.length - 5);

                  if (total[total.length - 1] === 'E') {
                    let subtotalE = parseFloat($('#subtotalE').html());
                    $('#subtotalE').html((subtotalE - (quantity * price)).toFixed(2) + ' Lps');

                    let subtotal = parseFloat($('#subtotal').html());
                    $('#subtotal').html((subtotal - (quantity * price)).toFixed(2) + ' Lps');

                    let totalt = parseFloat($('#total').html());
                    $('#total').html((totalt - (quantity * price)).toFixed(2) + ' Lps');
                  }

                  if (total[total.length - 1] === 'G') {
                    let isv = parseFloat($('#isv').html());
                    $('#isv').html(Math.abs((isv - (price - (price / 1.15)) * quantity).toFixed(2)) + ' Lps');

                    let subisv = parseFloat($('#subisv').html());
                    $('#subisv').html(Math.abs((subisv - ((price / 1.15)) * quantity).toFixed(2)) + ' Lps');

                    let subtotal = parseFloat($('#subtotal').html());
                    $('#subtotal').html((subtotal - (quantity * price)).toFixed(2) + ' Lps');

                    let totalt = parseFloat($('#total').html());
                    $('#total').html((totalt - (quantity * price)).toFixed(2) + ' Lps');
                  }


                  $(this).remove();
                  var nFilas = $("#sale-table tr").length;
                  $('#countElements').html(nFilas - 1);

                  // TODO: VERIFY ELEMENTS IN LIST
                  let elements = $('#countElements').html();
                  if (elements == 0) {
                    $('#continue_sale').prop('disabled', true);
                  } else {
                    $('#continue_sale').prop('disabled', false);
                  }
                } else {
                  swal("Se cancelo la acción");
                }
              });
          });
        }
      })
    }
  });

  // * SALE DETAILS ARRAY
  var details = [];

  // * CONTINUE SALE BUTTON
  $('#continue_sale').click(function () {
    let list = $('#sale-table tbody tr');

    for (let i = 0; i < list.length; i++) {
      // * GETTING QUANTITY OF THE PRODUCT IN ROW
      let stringQuantity = String(list[i].innerHTML.split('\n')[1]);
      let stringQuantityContent = stringQuantity.trim();
      let quantity = stringQuantityContent.substring(4, stringQuantityContent.length - 5);

      // * GETTING NAME OF THE PRODUCT IN ROW
      let stringName = String(list[i].innerHTML.split('\n')[2]);
      let stringNameContent = stringName.trim();
      let name = stringNameContent.substring(4, stringNameContent.length - 5);

      // * GETTING PRICES OF THE PRODUCT IN ROW
      let stringPrice = String(list[i].innerHTML.split('\n')[3]);
      let stringPriceContent = stringPrice.trim();
      let price = stringPriceContent.substring(4, stringPriceContent.length - 5);

      // * GETTING TOTAL OF PRODUCT IN ROW
      let stringTotal = String(list[i].innerHTML.split('\n')[4]);
      let stringTotalContent = stringTotal.trim();
      let total = stringTotalContent.substring(4, stringTotalContent.length - 5);

      // * ADDING ROW TO SALE DETAIL
      details.push({
        quantity,
        name,
        price,
        total
      })
    }

    $('.form-client').css('display', 'block');

  });

  // TODO: FINISH SALE
  $('#continue_payment').click(function () {
    $('.form-payment').css('display', 'block');
    $('#pay_total').html('Total: ' + parseFloat($('#total').html()) + ' Lps');
    let coins = parseFloat($('#total').html()) - parseInt($('#total').html())
    if (coins > 0) {
      $('#pay_text').html(toWords(parseFloat($('#total').html())) + ' LEMPIRAS Y ' + coins.toFixed(2) + ' CENTAVOS');
    } else {
      $('#pay_text').html(toWords(parseFloat($('#total').html())) + ' LEMPIRAS');
    }
  });

  $('#finish_sale').click(function () {
    var dataForm = {
      id_client: parseInt($("#client_id").val()) > 0 ? parseInt($("#client_id").val()) : 0,
      invoice_number: jQuery("#invoice_number").html(),
      shopping_details: details,
      id_user: parseInt(jQuery("#user_id").val()),
      id_invoice_setting: parseInt(jQuery("#invoice_setting").val()),
      elements: parseInt($('#countElements').html()),
      pay_method: 'Efectivo',
      pay_way: 'Lempiras',
      sub_total: parseFloat($('#subtotal').html()),
      sub_e: parseFloat($('#subtotalE').html()),
      sub_isv: parseFloat($('#subisv').html()),
      isv: parseFloat($('#isv').html()),
      total: parseFloat($('#total').html()),
      words: $('#pay_text').html()
    };

    console.log(dataForm);

    $('.loading').css('display', 'flex');

    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": CSRF_TOKEN,
      },
    });
    jQuery.ajax({
      url: "/dashboard/sales",
      method: "post",
      data: dataForm,
      success: function (result) {

        $('.loading').css('display', 'none');

        swal("Cambio: " + (parseFloat(jQuery("#payment").val()) - dataForm.total).toFixed(2) + " Lps", "Imprimiendo...", "success", {
          button: "Hecho!",
        });

        $(".data-container").load('/dashboard/new-sales');

      },
    })
  });

});


// * CONVERTING NUMBERS TO WORDS
function toWords(n) {
  var num = parseInt((n * 100) + '');

  var centavos = num % 100;
  var numero = parseInt(n + '');

  var respuesta = '';

  if (numero > 999) {
    if ((numero + '').length > 6) {

      var residuo = parseInt((numero + '')) % 1000000;
      var x = parseInt(numero / 1000000);

      if (x == 1) {
        respuesta = ' UN MILLON ' + toWords(residuo);
      } else {
        respuesta = toWords(x) + ' MILLONES ' + toWords(residuo);
      }
    } else if ((numero + '').length > 3) {
      var residuo = parseInt((numero + '')) % 1000;
      var x = parseInt(numero / 1000);

      if (x == 1) {
        respuesta = ' MIL' + toWords(residuo);
      } else {
        respuesta = toWords(x) + ' MIL ' + toWords(residuo);
      }
    }
  } else {
    if (numero == 100) {
      respuesta = 'CIEN';
    } else if (numero > 100) {
      var cen = parseInt(numero / 100);
      var dec = numero % 100;

      respuesta = ' ' + centenas_nal(cen) + ' ' + toWords(dec);
    } else {
      var dec = numero % 100;

      if (dec < 20) {
        respuesta = ' ' + unidades_nal(dec);
      } else {
        var unis = dec % 10;
        var ddec = parseInt(dec / 10);

        if (unis != 0) {
          respuesta = ' ' + decenas_nal(ddec) + ' Y ' + unidades_nal(unis);
        } else {
          respuesta = ' ' + decenas_nal(ddec);
        }
      }
    }
  }

  return respuesta;
}

function unidades_nal(n) {
  if (n + '' == '1') {
    return 'UNO'
  }
  if (n + '' == '2') {
    return 'DOS'
  }
  if (n + '' == '3') {
    return 'TRES'
  }
  if (n + '' == '4') {
    return 'CUATRO'
  }
  if (n + '' == '5') {
    return 'CINCO'
  }
  if (n + '' == '6') {
    return 'SEIS'
  }
  if (n + '' == '7') {
    return 'SIETE'
  }
  if (n + '' == '8') {
    return 'OCHO'
  }
  if (n + '' == '9') {
    return 'NUEVE'
  }


  if (n + '' == '10') {
    return 'DIEZ'
  }
  if (n + '' == '11') {
    return 'ONCE'
  }
  if (n + '' == '12') {
    return 'DOCE'
  }
  if (n + '' == '13') {
    return 'TRECE'
  }
  if (n + '' == '14') {
    return 'CATORCE'
  }
  if (n + '' == '15') {
    return 'QUINCE'
  }
  if (n + '' == '16') {
    return 'DIECISEIS'
  }
  if (n + '' == '17') {
    return 'DIECISIETE'
  }
  if (n + '' == '18') {
    return 'DIECIOCHO'
  }
  if (n + '' == '19') {
    return 'DIECINUEVE'
  }

  return '';
}

function decenas_nal(n) {
  if (n + '' == '1') {
    return 'DIEZ'
  }
  if (n + '' == '2') {
    return 'VEINTE'
  }
  if (n + '' == '3') {
    return 'TREINTA'
  }
  if (n + '' == '4') {
    return 'CUARENTA'
  }
  if (n + '' == '5') {
    return 'CINCUENTA'
  }
  if (n + '' == '6') {
    return 'SESENTA'
  }
  if (n + '' == '7') {
    return 'SETENTA'
  }
  if (n + '' == '8') {
    return 'OCHENTA'
  }
  if (n + '' == '9') {
    return 'NOVENTA'
  }

  return '';
}

function centenas_nal(n) {
  if (n + '' == '1') {
    return 'CIENTO'
  }
  if (n + '' == '2') {
    return 'DOCIENTOS'
  }
  if (n + '' == '3') {
    return 'TRECIENTOS'
  }
  if (n + '' == '4') {
    return 'CUATROCIENTOS'
  }
  if (n + '' == '5') {
    return 'QUINIENTOS'
  }
  if (n + '' == '6') {
    return 'SEISCIENTOSD'
  }
  if (n + '' == '7') {
    return 'SETECIENTOS'
  }
  if (n + '' == '8') {
    return 'OCHOCIENTOS'
  }
  if (n + '' == '9') {
    return 'NOVECIENTOS'
  }

  return '';
}

// $('.loading').css('display', 'flex');
//     var dataForm = {
//       id_client: $("#client_id").val(),
//       invoice_number: jQuery("#invoice_number").val(),
//       shopping_details: details,
//       id_user: jQuery("#user_id").val(),
//       id_invoice_setting: jQuery("#invoice_setting").val(),
//       elements: $('#countElements').html(),
//     };
//     e.preventDefault();
//     $.ajaxSetup({
//       headers: {
//         "X-CSRF-TOKEN": $('input[name="_token"]').val(),
//       },
//     });
//     jQuery.ajax({
//       url: "/dashboard/clients",
//       method: "post",
//       data: dataForm,
//       success: function (result) {

//         jQuery("#client_full_name").val('');
//         jQuery("#client_rtn").val('');
//         jQuery("#client_email").val('');
//         jQuery("#client_phone").val('');

//         $('#clients-modal').removeClass('show');
//         $('.modal-shadow').removeClass('show');

//         swal({
//           title: "Exitoso",
//           text: result.message,
//           icon: "success",
//           button: "¡Perfecto!",
//         });

//         if(isInClients){
//           $('.data-container').load('/dashboard/clients');
//         }

//         $('.loading').css('display', 'none');
//       },
//     }).fail(function (jqXHR, textStatus, errorThrown) {
//       if (jqXHR.responseJSON.errors.rtn) {
//         $("#rtn-error").html(jqXHR.responseJSON.errors.rtn);
//       }

//       if (jqXHR.responseJSON.errors.full_name) {
//         $("#full_name-error").html(jqXHR.responseJSON.errors.full_name);
//       }

//       if (jqXHR.responseJSON.errors.email) {
//         console.log(jqXHR.responseJSON.errors.email);
//         $("#email-error").html(jqXHR.responseJSON.errors.email);
//       }

//       if (jqXHR.responseJSON.errors.phone) {
//         console.log(jqXHR.responseJSON.errors.phone);
//         $("#phone-error").html(jqXHR.responseJSON.errors.phone);
//       }

//       $('.loading').css('display', 'none');
//     });