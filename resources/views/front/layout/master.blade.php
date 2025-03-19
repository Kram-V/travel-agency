<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>EscapeEase</title>

        <link rel="icon" type="image/png" href="uploads/favicon.png">

        <!-- All CSS -->
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/bootstrap-datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/meanmenu.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/spacing.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('dist-front/css/iziToast.min.css') }}">

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        @include('front.layout.navbar') 

        @yield('content')
        
        @include('front.layout.footer')

        <!-- All Javascripts -->
        <script src="{{ asset('dist-front/js/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/wow.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/select2.full.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/moment.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/counterup.min.js') }}"></script>
        <script src="{{ asset('dist-front/js/multi-countdown.js') }}"></script>
        <script src="{{ asset('dist-front/js/jquery.meanmenu.js') }}"></script>
        <script src="{{ asset('dist-front/js/custom.js') }}"></script>
        <script src="{{ asset('dist-front/js/iziToast.min.js') }}"></script>

        @if($errors->any())
          @foreach (array_reverse($errors->all()) as $error)
            <script>
              iziToast.show({
                  message: '{{ $error }}',
                  position: "topRight",
                  color: "red" 
              });
            </script>
          @endforeach
        @endif
      
        @if(session('success'))
          <script>
            iziToast.show({
                message: "{{ session('success') }}",
                position: "topRight",
                color: "green"
            });
          </script>
        @endif
      
        @if(session('error'))
          <script>
            iziToast.show({
                message: "{{ session('error') }}",
                position: "topRight",
                color: "red"
            });
          </script>
        @endif
    </body>
</html>
