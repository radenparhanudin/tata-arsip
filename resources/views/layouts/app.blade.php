<!DOCTYPE html>
<html>

@include('layouts.app.head')

<body class="theme-purple">
    @include('layouts.app.component')
    <!-- Top Bar -->
    @include('layouts.app.navbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        @include('layouts.app.left-sidebar')
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        @include('layouts.app.right-sidebar')

        <!-- #END# Right Sidebar -->
    </section>

    @yield('app-section')

    @include('layouts.app.foot')
</body>

</html>
