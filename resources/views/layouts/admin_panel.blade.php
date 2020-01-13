<ul class="navbar-nav navbar-left float-left col-md-2 text-center">
    <div id="warehouse_panel" class="">
        <h3 class="toast-header justify-content-center mb-0">Invoices</h3>
        <a href="{{route('invoice.create')}}" class="list-group-item list-group-item-action ">Add new invoice</a>
        <a href="{{route('invoice.index')}}" class="list-group-item list-group-item-action">Show invoices </a>
        <a href="{{route('invoice-statistics')}}" class="list-group-item list-group-item-action">Search by criteria</a>
    </div>

    <div id="orders_panel">
        <h3 class="toast-header justify-content-center mb-0">Orders</h3>
        <a href="{{route('statistics.orders.today')}}" class="list-group-item list-group-item-action">Today</a>
        <a href="{{route('statistics.orders')}}" class="list-group-item list-group-item-action">Custom period</a>
    </div>

    @can('manager')
    <div id="stats_panel">
        <h3 class="toast-header justify-content-center mb-0">Statistics</h3>
        <a href="{{route('statistics.index')}}" class="list-group-item list-group-item-action">Daily</a>
        <a href="#" class="list-group-item list-group-item-action">Period</a>
        <a href="#" class="list-group-item list-group-item-action">Per user</a>
    </div>
    <div id="user_panel">
        <h3 class="toast-header justify-content-center mb-0">Staff actions</h3>
        <a href="{{route('user.index')}}" class="list-group-item list-group-item-action">Workers</a>
        <a href="{{route('user.create')}}" class="list-group-item list-group-item-action">Hire worker</a>
        <a href="#" class="list-group-item list-group-item-action">Worker stats</a>
    </div>
    @endcan
    <div id="user_panel">
        <h3 class="toast-header justify-content-center mb-0">Miscellaneous</h3>
        <a href="{{route('product-types.index')}}" class="list-group-item list-group-item-action">Product types</a>
        <a href="{{route('table.index')}}" class="list-group-item list-group-item-action">Tables</a>
    </div>
    <div id="warehouse_panel">
        <h3 class="toast-header justify-content-center mb-0">Warehouse</h3>
        <a href="{{route('products.index')}}" class="list-group-item list-group-item-action">Availability</a>
    </div>
</ul>