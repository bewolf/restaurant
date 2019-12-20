{{--@can('manager')--}}

    {{--<li class=" nav-item">--}}
        {{--<a class="nav-link nav" href="#">Manager nav item test</a>--}}
    {{--</li>--}}
{{--@endcan--}}

{{--@can('shift_manager')--}}

    {{--<li class=" nav-item">--}}
        {{--<a class="nav-link nav" href="#">Shift Manager nav item test</a>--}}
    {{--</li>--}}

{{--@endcan--}}

{{--@canany(['waiter', 'bartender', 'cook'])--}}
    {{--<li class=" nav-item">--}}
        {{--<a class="nav-link nav font-weight-bold" href="#">waiter, bartender and cook test menu item</a>--}}
    {{--</li>--}}
{{--@endcanany--}}

{{--@canany(['waiter', 'bartender'])--}}
    {{--<li class=" nav-item">--}}
        {{--<a class="nav-link nav font-weight-bold" href="{{route('order.create')}}">New order</a>--}}
    {{--</li>--}}
{{--@endcanany--}}