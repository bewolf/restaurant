<div class="row">
    <div class="row ml-1"><h3>New order at table №</h3></div>
    <div class="row col-md-12 mb-4" id="tables">
        @foreach($tables as $table)
            <a href="{{ route('order.create', ['table' => $table->id]) }}"
               class="{{$table->is_available ? 'btn btn-success' : 'btn btn-danger'}} mr-1 mb-1">
                {{$table->id}}
            </a>
        @endforeach
    </div>

    @if($orders)
        <h3 class="row col-md-12">Current tables with order</h3>
        @foreach($orders as $order)
            <div class="current_orders">
                <form method="get" action="{{route('order.edit', $order->order_id)}}">
                    <input type="submit"
                           class="btn btn-info m-1"
                           value="{{$order->table_id}}">
                </form>
            </div>
        @endforeach
    @endif
</div>