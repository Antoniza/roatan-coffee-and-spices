jQuery(document).ready(function () {
    $("#newProductButton").click(function () {
        $("#products-modal").addClass("show");
        $(".modal-shadow").addClass("show");
    });

    // * AUTOMATINC SETTING PRICES

    $("#product_first-price").change(function () {
        if ($("#product_g").prop("checked")) {
            let price = parseInt(jQuery(this).val());
            jQuery("#product_second-price").val(String(price + price * 0.15));
        }
    });

    $(".taxes_type").change(function () {
        if ($("#product_g").prop("checked")) {
            let price = parseInt(jQuery("#product_first-price").val());
            jQuery("#product_second-price").val(String(price + price * 0.15));
        } else {
            jQuery("#product_second-price").val(String(0));
        }
    });

    $("#edit_product_first-price").change(function () {
        if ($("#edit_product_g").prop("checked")) {
            let price = parseInt(jQuery(this).val());
            jQuery("#edit_product_second-price").val(
                String(price + price * 0.15)
            );
        }
    });

    $(".edit_taxes_type").change(function () {
        if ($("#edit_product_g").prop("checked")) {
            let price = parseInt(jQuery("#edit_product_first-price").val());
            jQuery("#edit_product_second-price").val(
                String(price + price * 0.15)
            );
        } else {
            jQuery("#edit_product_second-price").val(String(0));
        }
    });

    // * SAVE DATA OF NEW PRODUCT

    jQuery("#submit-button").click(function (e) {
        var dataForm = {
            name: jQuery("#product_name").val(),
            first_price: jQuery("#product_first-price").val(),
            second_price: jQuery("#product_second-price").val(),
            quantity: jQuery("#product_quantity").val(),
            discount: jQuery("#product_discount").val(),
            type_taxes: $(
                "input[name=product_type-taxes]:checked",
                "#productForm"
            ).val(),
        };
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val(),
            },
        });
        jQuery
            .ajax({
                url: "/dashboard/products",
                method: "post",
                data: dataForm,
                success: function (result) {
                    jQuery("#product_name").val(""),
                        jQuery("#product_first-price").val(""),
                        jQuery("#product_second-price").val("0"),
                        jQuery("#product_quantity").val("0"),
                        jQuery("#product_discount").val("0"),
                        $("#products-modal").removeClass("show");
                    $(".modal-shadow").removeClass("show");

                    swal({
                        title: "Exitoso",
                        text: result.message,
                        icon: "success",
                        button: "¡Perfecto!",
                    });

                    $(".data-container").load("/dashboard/products");

                    $(".loading").css("display", "none");

                    $("#product_name-error").html("");
                },
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                console.log(jqXHR.responseJSON.errors);
                if (jqXHR.responseJSON.errors.name) {
                    $("#product_name-error").html(
                        jqXHR.responseJSON.errors.name
                    );
                }

                if (jqXHR.responseJSON.errors.first_price) {
                    $("#first_price-error").html(
                        jqXHR.responseJSON.errors.first_price
                    );
                }

                if (jqXHR.responseJSON.errors.second_price) {
                    console.log(jqXHR.responseJSON.errors.email);
                    $("#second_price-error").html(
                        jqXHR.responseJSON.errors.second_price
                    );
                }

                if (jqXHR.responseJSON.errors.discount) {
                    console.log(jqXHR.responseJSON.errors.phone);
                    $("#discount-error").html(
                        jqXHR.responseJSON.errors.discount
                    );
                }

                if (jqXHR.responseJSON.errors.quantity) {
                    console.log(jqXHR.responseJSON.errors.phone);
                    $("#quantity-error").html(
                        jqXHR.responseJSON.errors.quantity
                    );
                }
            });
    });

    // * DELETE DATA OF PRODUCT

    $(".deleteProduct").click(function () {
        swal({
            title: "Eliminando",
            text: "Se borraran los datos de este producto. ¿Desea continuar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $(".loading").css("display", "flex");
                    var id = $(this).data("id");
                    var token = $(this).data("token");
                    $.ajax({
                        url: "dashboard/products/" + id,
                        type: "DELETE",
                        dataType: "JSON",
                        data: {
                            id: id,
                            _method: "DELETE",
                            _token: token,
                        },
                        success: function () {
                            $(".data-container").load("/dashboard/products");
                            $(".loading").css("display", "none");
                        },
                    });
                    swal("!Se eliminó el producto correctamente!", {
                        icon: "success",
                    });
                } else {
                    swal("Acción cancelada.");
                }
            });
    });
});

// * BUTTON TO OPEN EDIT PRODUCT PANEL

$(".edit-link").click(function (e) {
    e.preventDefault();
    $(".loading").css("display", "flex");
    $(".data-container").load($(this).attr("href"));
    $(".loading").css("display", "none");
});

// * SAVE EDITED DATA OF PRODUCT

jQuery("#edit-product-button").click(function (e) {
    $(".loading").css("display", "flex");
    let id = jQuery("#edit-product_id").val();
    var dataForm = {
        name: jQuery("#edit_product_name").val(),
        first_price: jQuery("#edit_product_first-price").val(),
        second_price: jQuery("#edit_product_second-price").val(),
        quantity: jQuery("#edit_product_quantity").val(),
        discount: jQuery("#edit_product_discount").val(),
        type_taxes: $(
            "input[name=edit_product_type-taxes]:checked",
            "#edit_productForm"
        ).val(),
    };
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('input[name="_token"]').val(),
        },
    });
    jQuery
        .ajax({
            url: "/dashboard/products/" + id,
            method: "patch",
            data: dataForm,
            success: function (result) {
                jQuery("#edit-client_id").val("");
                jQuery("#edit-client_full_name").val("");
                jQuery("#edit-client_rtn").val("");
                jQuery("#edit-client_email").val("");
                jQuery("#edit-client_phone").val("");

                $(".alert").css("display", "flex");
                $(".alert-message").html(result.message);

                $(".data-container").load("/dashboard/products");

                $(".loading").css("display", "none");
            },
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log(errorThrown);
            console.log(jqXHR.responseJSON.errors);
            if (jqXHR.responseJSON.errors.name) {
                $("#edit_product_name-error").html(
                    jqXHR.responseJSON.errors.name
                );
            }

            if (jqXHR.responseJSON.errors.first_price) {
                $("#edit_first_price-error").html(
                    jqXHR.responseJSON.errors.first_price
                );
            }

            if (jqXHR.responseJSON.errors.second_price) {
                console.log(jqXHR.responseJSON.errors.email);
                $("#edit_second_price-error").html(
                    jqXHR.responseJSON.errors.second_price
                );
            }

            if (jqXHR.responseJSON.errors.discount) {
                console.log(jqXHR.responseJSON.errors.phone);
                $("#edit_discount-error").html(
                    jqXHR.responseJSON.errors.discount
                );
            }

            if (jqXHR.responseJSON.errors.quantity) {
                console.log(jqXHR.responseJSON.errors.phone);
                $("#edit_quantity-error").html(
                    jqXHR.responseJSON.errors.quantity
                );
            }

            $(".loading").css("display", "none");
        });

    $("#edit_product_name-error").html("");
    $("#edit_first_price-error").html("");
    $("#edit_second_price-error").html("");
    $("#edit_discount-error").html("");
    $("#edit_quantity-error").html("");
});
