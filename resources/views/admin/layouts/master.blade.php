<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
    @trixassets
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            @include('admin.includes.header')


        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            @include('admin.includes.sidebar')

        </aside>

        <div class="content-wrapper">

            @yield('content')


        </div>

        <footer class="main-footer">
            @include('admin.includes.footer')
        </footer>
    </div>

    <script src="{{ asset('admin/js/app.js') }}"></script>
</body>

</html>