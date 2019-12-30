let products = [];

$(document).ready(function () {
    $('#product_types_filter').bind('click', function (event) {

        let type = event.target.id.replace(/\D/g, '');
        let products_type = 'products_from_type_' + type;

        if ($('#' + products_type).attr('hidden')) {
            $('#type_' + type).attr('class', 'btn btn-success float-left mr-1 mb-1')
            $('#' + products_type).removeAttr('hidden');
        } else {
            $('#type_' + type).attr('class', 'btn btn-danger float-left mr-1 mb-1');
            $('#' + products_type).attr('hidden', true);
        }
    });

    $('#displayed_products').bind('click', function (event) {

        if (event.target.type === 'submit') {
            let counter = 1;
            let product_id = event.target.id;
            let product_name = event.target.innerText;

            $('#product_for_cart').removeAttr('hidden');
            $('#current_product_for_cart').text(product_name).attr('name', 'product_id_' + product_id);
            $('#current_product_for_cart_quantity').text(counter);
        }
    });

    $('body').on('click', 'button.increase-in-order-form', function () {
        let new_value = parseInt($(this).siblings('input.quantity').val()) + 1;
        $(this).siblings('input.quantity').val(new_value);
    });

    $('body').on('click', 'button.decrease-in-order-form', function () {
        let new_value = parseInt($(this).siblings('input.quantity').val()) - 1;
        if (new_value < 1) {
            new_value = 1
        }
        $(this).siblings('input.quantity').val(new_value);
    });


});

window.increaseQuantity = function increaseQuantity() {
    let new_value = parseInt($('#current_product_for_cart_quantity').text()) + 1;
    $('#current_product_for_cart_quantity').text(new_value);
}

window.decreaseQuantity = function decreaseQuantity() {
    let new_value = parseInt($('#current_product_for_cart_quantity').text()) - 1;
    if (new_value < 1) {
        new_value = 1
    }
    $('#current_product_for_cart_quantity').text(new_value);
}


window.addOrderRow = function addOrderRow() {
    let product_name = $('#current_product_for_cart').text();

    if(! products.includes(product_name)) {
        products.push(product_name);
        let quantity = $('#current_product_for_cart_quantity').text();
        
        $('#order_form_body').append(' <div class="row">\n' +
            '                    <input class="form-control col-md-5 float-left" type="text" name="products[]" readonly\n' +
            '                           value="' + product_name + '">\n' +
            '                    <input class="form-control mb-2 col-md-2 float-left quantity" type="number" readonly\n' +
            '                           name="quantities[]"\n' +
            '                           value="' + quantity + '"\n' +
            '                           min="1"\n' +
            '                           step="1">\n' +
            '                    <button class="btn btn-success float-left mr-1 mb-2 increase-in-order-form"\n' +
            '                            id="quantity_increase_in_order_form"\n' +
            '                            type="button">+\n' +
            '                    </button>\n' +
            '                    <button class="btn btn-danger float-left mr-1 mb-2 decrease-in-order-form"\n' +
            '                            id="quantity_decrease_in_order_form"\n' +
            '                            type="button">-\n' +
            '                    </button>\n' +
            '                    <button class="btn btn-outline-info float-left mr-4 mb-2 "\n' +
            '                            id="remove_row"\n' +
            '                            onclick="$(this).parent().remove();"\n' +
            '                            type="button">Remove\n' +
            '                    </button>\n' +
            '\n' +
            '                </div>')
    }
}

