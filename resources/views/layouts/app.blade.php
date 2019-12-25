@include('layouts.header')

@include('layouts.nav')

<main class="container py-4">
    @yield('content')
</main>
</div>
@yield('scripts')
</body>
<footer>
    @yield('footer')
</footer>
</html>
