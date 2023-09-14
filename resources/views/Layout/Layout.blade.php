<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Document</title>
</head>

<body>
    <div class="header fixed-top bg-light">
        <div class="h-100 header-content d-flex justify-content-between">
            <div class="h-75 pt-1">
                <div class="h-100">
                    <a href>
                        <img class="w-auto h-100" src="{{ asset('assets/system_imgs/sv_logo_dashboard.png') }}" alt>
                    </a>
                </div>
            </div>
            <div class="header-left-content h-100 d-flex align-items-center justify-content-around">
                <a class="link-secondary text-decoration-none" href><ion-icon name="home"></ion-icon> Trang chủ</a>
                <a class="link-secondary text-decoration-none" href><ion-icon name="notifications-outline"></ion-icon>
                    Tin tức</a>
                <div class="d-flex">
                    <div class="avt-user">
                        <div class="w-100 rounded-circle overflow-hidden">
                            <img class="w-100" src="{{ asset('assets/system_imgs/avt_default.jpg') }}" alt>
                        </div>
                    </div>
                    <span class="mx-1 text-secondary">{{ $TenGV }}</span>
                </div>

                <a href="/dangxuat" class="link-danger text-decoration-none mb-1"> Đăng xuất</a>
            </div>
        </div>
        <div class="alert py-2 alert-success text-center fade" role="alert" id="successAlert">
            Thao tác thành công !
        </div>
    </div>

    <div class="page-content rounded bg-light">
        <div class="m-2" loading="lazy">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
