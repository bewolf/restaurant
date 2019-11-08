<div class="row justify-content-center">
    <div id="warehouse_panel" class="list-group col-md-3 border float-left mr-2">
        <h3 class="toast-header justify-content-center">Invoices</h3>
        <a href="{{route('invoice.create')}}" class="list-group-item list-group-item-action">Add new invoice</a>
        <a href="{{route('invoice.index')}}" class="list-group-item list-group-item-action">Show invoices </a>
        <a href="#" class="list-group-item list-group-item-action">Search by criteria</a>
    </div>

    <div id="warehouse_panel" class="list-group col-md-3 border float-left mr-2">
        <h3 class="toast-header justify-content-center">Foods</h3>
        <a href="#" class="list-group-item list-group-item-action">Add new food</a>
        <a href="#" class="list-group-item list-group-item-action">Show foods</a>
        <a href="#" class="list-group-item list-group-item-action">Search by criteria</a>
    </div>

    <div id="warehouse_panel" class="list-group col-md-3 border float-left">
        <h3 class="toast-header justify-content-center">Drinks</h3>
        <a href="#" class="list-group-item list-group-item-action">Add new drink</a>
        <a href="#" class="list-group-item list-group-item-action">Show foods</a>
        <a href="#" class="list-group-item list-group-item-action">Search by criteria</a>
    </div>

    <div id="stats_panel" class="list-group col-md-3 border float-left mt-4">
        <h3 class="toast-header justify-content-center">Statistics</h3>
        <a href="#" class="list-group-item list-group-item-action">Daily</a>
        <a href="#" class="list-group-item list-group-item-action">Period</a>
        <a href="#" class="list-group-item list-group-item-action">Per user</a>
    </div>

    <div id="user_panel" class="list-group col-md-3 border float-left ml-2 mt-4">
        <h3 class="toast-header justify-content-center">Workers actions</h3>
        <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">Workers</a>
        <a href="{{route('user.create')}}" class="list-group-item list-group-item-action">Hire worker</a>
        <a href="{{route('user.destroy')}}" class="list-group-item list-group-item-action">Fire worker</a>
        <a href="#" class="list-group-item list-group-item-action">Worker stats</a>
    </div>

    <div id="warehouse_panel" class="list-group col-md-3 border float-left ml-2 mt-4">
        <h3 class="toast-header justify-content-center">Warehouse</h3>
        <a href="{{route('products.index')}}" class="list-group-item list-group-item-action">Availability</a>
    </div>

</div>