<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <title>Listian</title>
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">




    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    @stack('styles')
</head>

<body>


    <!--==========================
        NAVBAR PART START
    ===========================-->

    @include('frontend.layouts.navbar')

    <!--==========================
        NAVBAR PART START
    ===========================-->

    <!--==========================
        CONTENTS PART START
    ===========================-->

    @yield('contents')
    <!--==========================
        CONTENTS PART START
    ===========================-->


    <!--==========================
        FOOTER PART START
    ===========================-->
    @include('frontend.layouts.footer')
    <!--==========================
        FOOTER PART END
    ===========================-->


    <!--=============SCROLL BTN==============-->
    <div class="scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--=============SCROLL BTN==============-->


    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <!--slick js-->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!--venobox js-->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <!--counter js-->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <!--nice select js-->
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <!--isotope js-->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!--summer_note js-->
    <script src="{{ asset('frontend/js/summernote.min.js') }}"></script>
    <!--select js-->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="//cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>





    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>
    @stack('scripts')

</body>

</html>
