$(document).ready(function () {
    var i = 1;

    $('body').on('click', '#add', function () {
        i++;
        $('#invoice_form_input_fields').append('<div class="col-md-12 d-inline-block pl-0" id="row' + i + '">' +
            '<div class="form-group col-md-4 float-left pr-0 pl-0">' +
            '<input type="text" id="product_name" name="product_name[]" class="form-control" placeholder="Product name"required>' +
            '</div>' +
            '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
            '<select class="form-control" id="unit" name="unit[]">' +
            '<option disabled selected>Select unit</option>' +
            '<option value="kg">kg</option>' +
            '<option value="grams">grams</option>' +
            '<option value="qty.">qty.</option>' +
            '<option value="cm">cm</option>' +
            '<option value="liters">liters</option>' +
            '</select>' +
            '</div>' +
            '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
            '<input type="text" id="quantity" name="quantity[]" class="form-control"placeholder="Quantity"required>' +
            '</div>' +
            '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
            '<input type="text" id="unit_price" name="unit_price[]" class="form-control" placeholder="Price"required></div>' +
            '<div class="form-group col-md-1 float-left pr-0  pt-1 ">' +
            '<button type="button" class="btn" id="add" name="add"><i class="fas fa-plus"></i></button>' +
            '</div>' +
            '</div>');

        $("#row > div:nth-child(5)")
            .remove();
        $("#row")
            .append('<div class="form-group col-md-1 float-left pr-0 mt-1"><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>');

        $("#row" + (i - 1) + "> div:nth-child(5)")
            .remove();
        $("#row" + (i - 1))
            .append('<div class="form-group col-md-1 float-left pr-0  pt-1 "><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>')

    });
    $('#invoice_form_input_fields').on('click', '#remove', function () {
        $(this).parents().eq(1).remove();
    });
});