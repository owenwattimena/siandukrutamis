<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ url('/') }}/assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ url('/') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ url('/') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ url('/') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/icons.css" rel="stylesheet">
    <title>Amdash - Bootstrap 5 Admin Template</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <h1>{{ env('APP_NAME') }}</h1>
                            <span>{{ env('APP_DESCRIPTION') }}</span>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Login</h3>
                                        <p>Masuk untuk memulai sesi
                                        </p>
                                    </div>

                                    <form class="row g-3" action="{{ route('login.do') }}" method="POST">
                                        <div class="form-body">
                                            @if(session('alert'))
                                            <div class="alert alert-{{ session('alert')['type'] }} bg-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
                                                <div class="text-white">{{ session('alert')['message'] }}</div>
                                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                            @endif
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="inputEmailAddress" placeholder="Masukan Username" name="username">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Masukan Password" name="password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a> --}}
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Login</button>
                                                </div>
                                            </div>
                                        </div>
                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });

    </script>
    <!--app JS-->
    <script src="{{ url('/') }}/assets/js/app.js"></script>
</body>

</html>
