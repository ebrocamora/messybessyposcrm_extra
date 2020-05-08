<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('adminlte_css_pre')
    @yield('adminlte_css')
</head>
<body class="@yield('classes_body')" @yield('body_data')>

@yield('body')

<script src="{{ mix('js/app.js') }}"></script>
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-sm';
    window.axios.defaults.headers.common['Authorization'] = `Bearer {{session()->get("access_token")}}`
</script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('js/bravo.js') }}"></script>
<script src="{{ asset('js/ErrorHandler.js') }}"></script>
@yield('adminlte_js')
</body>
</html>
