<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script>
    var selected_lang_id = '<?php echo $selected_lang->id;?>';

    //add product variation post
    $("#form_add_pengiriman").submit(function (event) {
        event.preventDefault();
        // var input_variation_label = $.trim($('#input_variation_label').val());
        // if (input_variation_label.length < 1) {
        //     $('#input_variation_label').addClass("is-invalid");
        //     return false;
        // } else {
        //     $('#input_variation_label').removeClass("is-invalid");
        // }
        // var form = $(this);
        // var serializedData = form.serializeArray();
        // serializedData.push({name: csfr_token_name, value: $.cookie(csfr_cookie_name)});

        var formData = new FormData(this);
        formData.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            url: base_url + "product_controller/add_product_ongkir",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#addPengirimanModal").modal('hide');
                document.getElementById("response_product_ongkir").innerHTML = response;
            }
        });
    });

    //edit product variation
    function edit_product_ongkir(common_id, product_id, lang_id) {
        $("#btn-ongkir-text-" + common_id).hide();
        $("#sp-" + common_id).css('display', 'inline-block');
        var data = {
            "common_id": common_id,
            "product_id": product_id,
            "lang_id": lang_id,
        };
        data[csfr_token_name] = $.cookie(csfr_cookie_name);
        $.ajax({
            url: base_url + "product_controller/edit_product_ongkir",
            type: "post",
            data: data,
            success: function (response) {
                document.getElementById("response_product_ongkir_edit").innerHTML = response;
                setTimeout(
                    function () {
                        $("#editOngkirModal").modal('show');
                        $("#sp-" + common_id).hide();
                        $("#btn-ongkir-text-" + common_id).show();
                    }, 500);
            }
        });
    }

    //edit product variation post
    $("#form_edit_product_ongkir").submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        formData.append(csfr_token_name, $.cookie(csfr_cookie_name));

        $.ajax({
            url: base_url + "product_controller/edit_product_ongkir_post",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".input-variation-label").val('');
                $("#editOngkirModal").modal('hide');
                document.getElementById("response_product_ongkir").innerHTML = response;
            }
        });
    });

    //delete product ongkir
    function delete_product_ongkir(common_id, product_id, message) {
        swal({
            text: message,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then(function (willDelete) {
                if (willDelete) {
                    var data = {
                        "common_id": common_id,
                        "product_id": product_id
                    };
                    data[csfr_token_name] = $.cookie(csfr_cookie_name);
                    $.ajax({
                        url: base_url + "product_controller/delete_product_ongkir",
                        type: "post",
                        data: data,
                        success: function (response) {
                            document.getElementById("response_product_ongkir").innerHTML = response;
                        }
                    });
                }
            });
    }

</script>

