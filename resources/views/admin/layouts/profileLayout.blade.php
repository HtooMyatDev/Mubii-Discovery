<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('admin/img/svg/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    @include('sweetalert::alert')
    @yield('title')

    <style>
        body {
            font-family: "Roboto Mono", monospace
        }
    </style>
</head>

<body>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-2 offset-1">
                <div class="card shadow-sm" style="height: 85vh">
                    <div class="card-header bg-primary text-white fw-bold fs-5 p-4 text-center">
                        Admin Profile Panel
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin#profile') }}"
                            class="d-flex justify-content-start p-3 btn btn-outline-primary @if (Request::route()->getName() == 'admin#profile') active @endif w-100 my-2">
                            <i class="mx-3 fs-5 fa-solid fa-circle-user"></i> <span>Profile</span>
                        </a>
                        <a href="{{ route('admin#profile#change-password-page') }}"
                            class="d-flex justify-content-start p-3 btn btn-outline-primary @if (Request::route()->getName() == 'admin#profile#change-password-page') active @endif w-100 my-2">
                            <i class="mx-3 fs-5 fa-solid fa-lock"></i><span>Change Password</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-8">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin/plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('admin/plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('admin/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('jQuery')

    <script>
        function loadFile(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.querySelectorAll('.output')
                for (let index = 0; index < output.length; index++) {
                    output[index].src = reader.result
                }
            }
            reader.readAsDataURL(event.target.files[0])
        }
    </script>
</body>

</html>
