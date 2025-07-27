<!DOCTYPE html>
<html lang="en">
<head>
<title>
    @if(Auth::check())
        @yield('title', ucfirst(Auth::user()->role))
    @else
        @yield('title', 'Login')
    @endif
</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Admin Dashboard" />
    <meta name="keywords" content="admin, dashboard" />
    <meta name="author" content="Your Company">
    <link rel="icon" href="{{ asset('back-end/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('back-end/css/bootstrap/css/bootstrap.min.css') }}">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('back-end/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/icon/icofont/css/icofont.css') }}">

    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/css/jquery.mCustomScrollbar.css') }}">
</head>
<body>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-container navbar-wrapper">

            {{-- Navbar section --}}
            @yield('navbar')

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                    {{-- Sidebar section --}}
                    @yield('sidebar')

                    <!-- Main Content -->
                    <div class="pcoded-content">
                        @yield('content')
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('back-end/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('back-end/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ asset('back-end/pages/widget/amchart/serial.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/chart.js/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/pages/todo/todo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/pages/dashboard/custom-dashboard.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('back-end/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('back-end/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('back-end/js/vartical-demo.js') }}"></script>
    <script src="{{ asset('back-end/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.btn-delete');
    
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');
    
                    Swal.fire({
                        title: "Apakah kamu yakin?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, hapus saja!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    

</body>
</html>
