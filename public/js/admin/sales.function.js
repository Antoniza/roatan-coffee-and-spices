// * GO AND OUT NEW SALE PANEL

$('.load_invoice').click(function (e) {
  $('.loading').css('display', 'flex');
  e.preventDefault();
  $('.invoice_preview').css('display', 'flex');
  $(".invoice_preview").load($(this).attr("href"));
  $('.invoice_preview_back').css('display', 'block');
  $('.loading').css('display', 'none');
  document.title = "Roatán Coffee & Spices - " + $(this).data('invoice');
});

$('.invoice_preview_back').click(function () {
  $('.invoice_preview').css('display', 'none');
  $('.invoice_preview_back').css('display', 'none');
  document.title = "Roatán Coffee & Spices";
});

$('#cancel-reprint').click(function () {
  $('.invoice_preview').css('display', 'none');
  $('.invoice_preview_back').css('display', 'none');
  $(".data-container").load('/dashboard/sales');
  document.title = "Roatán Coffee & Spices";
});

// * REPRINT BUTTON

$('#reprint_button').click(function () {
  $('#invoice').removeClass('invoice_preview');
  $('#invoice').addClass('invoice_preview_print');
  let invoice = $(".invoice").html();
  let panel = $("body").html();

  $("body").html(invoice);
  window.print();
  $("body").html(panel);
  $(".data-container").load('/dashboard/sales');

  $('#invoice').css('display', 'none');
  $('.invoice_preview_back').css('display', 'none');
  document.title = "Roatán Coffee & Spices";

  let darkMode = localStorage.getItem('darkMode');
  if (darkMode) {
    $('.sideBar').toggleClass('dark');
    $('.data-container').toggleClass('dark');
    $('header').toggleClass('dark');
    $('.light-theme').toggleClass('hide');
    $('.dark-theme').toggleClass('hide');
  }
});

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

          if (result.data.quantity <= 0) {
            swal("Elemento acabado", "Este elemento se ha acabado. Actualice el inventario.", "error", {
              button: "Entendido",
            });
          } else if (result.data.quantity < jQuery("#quantity").val()) {
            swal("Elemento insuficiente", "No hay suficiente cantidad de este elemento en inventario.", "warning", {
              button: "Entendido",
            });
          } else {
            jQuery("#item_id").val('');
            jQuery("#product_search").val('');
            jQuery("#quantity").val(1);
            jQuery("#product_search").focus();

            let data = result.data;

            let table = $('#sale-table tbody');

            let markup = '';

            if (data.second_price != 0) {
              markup = `
            <tr id='item' data-product_id=` + data.id + `>
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
            <tr id='item' data-product_id=` + data.id + `>
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

      let id = $(list[i]).data('product_id');

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
        id,
        quantity,
        name,
        price,
        total
      })
    }

    $('.form-client').css('display', 'block');

  });

  $('#cancel_sale').click(function () {
    $(".data-container").load('/dashboard/sales');
  });

  // TODO: FINISH SALE
  $('#continue_payment').click(function () {
    $('.form-client').css('display', 'none');
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
    if ($("input[name=pay_way]:checked").val() == "Dolares" && parseFloat(jQuery("#payment").val()) != 0 && (parseFloat(jQuery("#dolar_change").val()) * parseFloat(jQuery("#payment").val())) >= parseFloat($('#total').html())) {
      var today = new Date();
      var currentTime = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + ' ' + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
      var dataForm = {
        id_client: parseInt($("#client_id").val()) > 0 ? parseInt($("#client_id").val()) : 0,
        invoice_number: jQuery("#invoice_number").html(),
        shopping_details: details,
        shopping_date: currentTime,
        id_user: parseInt(jQuery("#user_id").val()),
        id_invoice_setting: parseInt(jQuery("#invoice_setting").val()),
        elements: parseInt($('#countElements').html()),
        pay_method: 'Efectivo',
        pay_way: $(
          "input[name=pay_way]:checked"
        ).val(),
        sub_total: parseFloat($('#subtotal').html()),
        sub_e: parseFloat($('#subtotalE').html()),
        sub_isv: parseFloat($('#subisv').html()),
        isv: parseFloat($('#isv').html()),
        total: parseFloat($('#total').html()),
        dolar_change: parseFloat(jQuery("#dolar_change").val()),
        words: $('#pay_text').html(),
        change_money: (parseFloat(jQuery("#payment").val()) * parseFloat(jQuery("#dolar_change").val())) - parseFloat($('#total').html()).toFixed(2)
      };

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

          if ($("input[name=pay_way]:checked").val() == "Dolares") {
            let dolars = parseFloat(jQuery("#payment").val()) * parseFloat(jQuery("#dolar_change").val());
            swal("Cambio: " + (dolars - dataForm.total).toFixed(2) + " Lps", "Imprimiendo...", "success", {
              button: "Hecho!",
            });
          } else {
            swal("Cambio: " + (parseFloat(jQuery("#payment").val()) - dataForm.total).toFixed(2) + " Lps", "Imprimiendo...", "success", {
              button: "Hecho!",
            });
          }

          document.title = "Roatán Coffee & Spices - " + jQuery("#invoice_number").html() + '- (' + currentTime + ')';
          $('.form-payment').css('display', 'none');
          $('.invoice_preview').css('display', 'flex');
          $(".invoice_preview").load('/dashboard/print-invoice');
          $('.invoice_preview_back').css('display', 'block');
          $('.loading').css('display', 'none');

        },
      })
    } else if (parseFloat(jQuery("#payment").val()) != 0 && parseFloat($('#total').html()) < parseFloat(jQuery("#payment").val())) {
      var today = new Date();
      var dataForm = {
        id_client: parseInt($("#client_id").val()) > 0 ? parseInt($("#client_id").val()) : 0,
        invoice_number: jQuery("#invoice_number").html(),
        shopping_details: details,
        shopping_date: today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + ' ' + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
        id_user: parseInt(jQuery("#user_id").val()),
        id_invoice_setting: parseInt(jQuery("#invoice_setting").val()),
        elements: parseInt($('#countElements').html()),
        pay_method: 'Efectivo',
        pay_way: $(
          "input[name=pay_way]:checked"
        ).val(),
        sub_total: parseFloat($('#subtotal').html()),
        sub_e: parseFloat($('#subtotalE').html()),
        sub_isv: parseFloat($('#subisv').html()),
        isv: parseFloat($('#isv').html()),
        total: parseFloat($('#total').html()),
        words: $('#pay_text').html(),
        change_money: parseFloat(jQuery("#payment").val()) - parseFloat($('#total').html()).toFixed(2)
      };

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

          $('.form-payment').css('display', 'none');
          $('.invoice_preview').css('display', 'flex');
          $(".invoice_preview").load('/dashboard/print-invoice');
          $('.invoice_preview_back').css('display', 'block');
          $('.loading').css('display', 'none');

        },
      })
    } else {
      swal("Error", "Ingrese un monto mayor al total para completar la factura.", "warning", {
        button: "Entendido",
      });
    }
  });

  $('#pay_with_card').click(function () {
    console.log('Card');
    var today = new Date();
    var dataForm = {
      id_client: parseInt($("#client_id").val()) > 0 ? parseInt($("#client_id").val()) : 0,
      invoice_number: jQuery("#invoice_number").html(),
      shopping_details: details,
      shopping_date: today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate() + ' ' + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
      id_user: parseInt(jQuery("#user_id").val()),
      id_invoice_setting: parseInt(jQuery("#invoice_setting").val()),
      elements: parseInt($('#countElements').html()),
      pay_method: 'Tarjeta',
      pay_way: 'Lempiras',
      sub_total: parseFloat($('#subtotal').html()),
      sub_e: parseFloat($('#subtotalE').html()),
      sub_isv: parseFloat($('#subisv').html()),
      isv: parseFloat($('#isv').html()),
      total: parseFloat($('#total').html()),
      words: $('#pay_text').html(),
      change_money: 0
    };

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

        swal("Pago con tarjeta realizado.", "Imprimiendo...", "success", {
          button: "Hecho!",
        });

        $('.form-payment').css('display', 'none');
        $('.invoice_preview').css('display', 'flex');
        $(".invoice_preview").load('/dashboard/print-invoice');
        $('.invoice_preview_back').css('display', 'block');
        $('.loading').css('display', 'none');

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