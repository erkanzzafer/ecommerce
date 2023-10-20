
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title>@yield('title')</title>
  <link rel="icon" type="image/png" href="images/favicon.png">
  <link rel="stylesheet" href="{{ asset('/front/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/jquery.nice-number.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/jquery.calendar.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/add_row_custon.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/mobile_menu.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/jquery.exzoom.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/multiple-image-video.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/ranger_style.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/jquery.classycountdown.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/venobox.min.css') }}">

  <link rel="stylesheet" href="{{ asset('/front/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('/front/css/responsive.css') }}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>


  <!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="images/dashboard_user.jpg" alt="img" class="img-fluid">
      <p>anik roy</p>
    </div>
  </div>
  <!--=============================
    DASHBOARD MENU END
  ==============================-->


  <!--=============================
    DASHBOARD START
  ==============================-->
@yield('content')
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  <script src="{{ asset('/front/js/jquery-3.6.0.min.js') }}"></script>
  <!--bootstrap js-->
  <script src="{{ asset('/front/js/bootstrap.bundle.min.js') }}"></script>
  <!--font-awesome js-->
  <script src="{{ asset('/front/js/Font-Awesome.js') }}"></script>
  <!--select2 js-->
  <script src="{{ asset('/front/js/select2.min.js') }}"></script>
  <!--slick slider js-->
  <script src="{{ asset('/front/js/slick.min.js') }}"></script>
  <!--simplyCountdown js-->
  <script src="{{ asset('/front/js/simplyCountdown.js') }}"></script>
  <!--product zoomer js-->
  <script src="{{ asset('/front/js/jquery.exzoom.js') }}"></script>
  <!--nice-number js-->
  <script src="{{ asset('/front/js/jquery.nice-number.min.js') }}"></script>
  <!--counter js-->
  <script src="{{ asset('/front/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('/front/js/jquery.countup.min.js') }}"></script>
  <!--add row js-->
  <script src="{{ asset('/front/js/add_row_custon.js') }}"></script>
  <!--multiple-image-video js-->
  <script src="{{ asset('/front/js/multiple-image-video.js') }}"></script>
  <!--sticky sidebar js-->
  <script src="{{ asset('/front/js/sticky_sidebar.js') }}"></script>
  <!--price ranger js-->
  <script src="{{ asset('/front/js/ranger_jquery-ui.min.js') }}"></script>
  <script src="{{ asset('/front/js/ranger_slider.js') }}"></script>
  <!--isotope js-->
  <script src="{{ asset('/front/js/isotope.pkgd.min.js') }}"></script>
  <!--venobox js-->
  <script src="{{ asset('/front/js/venobox.min.js') }}"></script>
  <!--classycountdown js-->
  <script src="{{ asset('/front/js/jquery.classycountdown.js') }}"></script>

  <!--main/custom js-->
  <script src="{{ asset('/front/js/main.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  @if ($errors->any())
    @foreach ($errors->all() as $error)
        <span class="alert alert-danger">
            @php
            toastr()->error( $error);
            @endphp
        </span>
    @endforeach
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $('body').on('click', '.delete-item', function(event) {
       event.preventDefault();
       let deleteUrl = $(this).attr('href');
       Swal.fire({
           title: 'Silmek istediğinize Emin misiniz?',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Evet',
           cancelButtonText: 'Hayır'
       }).then((result) => {
           if (result.isConfirmed) {
               $.ajax({
                   type: 'DELETE',
                   url: deleteUrl,
                   success: function(data) {
                       if (data.status=='success'){
                           swal.fire(
                           'İşlem Başarılı!',
                           data.message,
                           'success'
                           )
                           window.location.reload();
                       }else if(data.status=='error'){
                           swal.fire(
                               'İşlem başarısız',
                               data.message,
                               'error'
                           )
                       }
                   },
                   error: function(xhr, status, error) {
                       swal.fire(
                               'cant Delete',
                               error,
                               'error'
                           )
                   }
               })
           }
       });
   });
});
</script>
@stack('scripts')
</body>

</html>
