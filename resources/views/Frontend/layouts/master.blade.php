@include('Frontend.layouts.header')

@yield('content')

@include('Frontend.layouts.footer')
<script type="text/javascript">
    $(".alert").delay(2000).slideUp(200, function () {
        $(this).alert('close');
    });
</script>