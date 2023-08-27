<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>العمال العرب - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/custom.css') }}">
    <script>
        !function (Gleap, t, i) {
            if (!(Gleap = window.Gleap = window.Gleap || []).invoked) {
                for (window.GleapActions = [], Gleap.invoked = !0, Gleap.methods = ["identify", "clearIdentity", "attachCustomData", "setCustomData", "removeCustomData", "clearCustomData", "registerCustomAction", "logEvent", "log", "preFillForm", "sendSilentCrashReport", "startFeedbackFlow", "setAppBuildNumber", "setAppVersionCode", "preFillForm", "setApiUrl", "setFrameUrl", "isOpened", "open", "close", "on", "setLanguage", "setOfflineMode", "initialize"], Gleap.f = function (e) {
                    return function () {
                        var t = Array.prototype.slice.call(arguments);
                        window.GleapActions.push({e: e, a: t})
                    }
                }, t = 0; t < Gleap.methods.length; t++) Gleap[i = Gleap.methods[t]] = Gleap.f(i);
                Gleap.load = function () {
                    var t = document.getElementsByTagName("head")[0], i = document.createElement("script");
                    i.type = "text/javascript", i.async = !0, i.src = "https://sdk.gleap.io/latest/index.js", t.appendChild(i)
                }, Gleap.load(),
                    Gleap.initialize("v6mNN8YE1g0YeNFUUaAPjlLqK7xklDqz")
            }
        }();
    </script>

</head>

<body>

<div class="preloader preloader-1" id="preloader">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-light dashboard-nav">
    <div class="container-lg">
        <li class="nav-item hamburger">
            <a class=" ms-2  profile_name hamburger-color" href="#"><i class="fa-solid fa-bars"></i></a>
        </li>
        <a class="navbar-brand" href="#"><img src="{{ asset("images/logo.png") }}" class="brand-logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-house"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link active" aria-current="page" href="{{ url('https://arabworkers.com/') }}">مسكن</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="#">تصفح المهمة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="#">قم بإنشاء مهمة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="#">دليل الإحالات</a>
                </li>
            </ul>
            <div class="nav-item admin-nav">
                <div class="dropdown dashboard-profile-dropdown">
                    <button class="dropdown-toggle profile-dropdown" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <a class="user-name profile_name" href="#">
                            <img src="{{ asset('assets/images/public-profile.png') }}" class="profile">
                            <span class="me-2">Auth User Name</span>
                        </a>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">LogOut</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</nav>

<div class="side_menu">
    <a href="#" class="active_menu"><i class="fa-solid fa-chart-line"></i> <span>لوحة القيادة</span> </a>

    <a href="#" class="active_menu"><i class="fa-solid fa-user"></i> <span>الملف الشخصي</span> </a>

    <a href="#" class="active_menu"><i class="fa-solid fa-tag"></i> <span>مهمتي</span> </a>

    <a href="#"><i class="fa-solid fa-plus"></i> <span>قم بإنشاء مهمة</span> </a>

    <a href="#" class="active_menu"><i class="fa-solid fa-credit-card"></i> <span>عملية</span> </a>

    <a href="#"><i class="fa-solid fa-headphones-simple"></i> <span>طلب دعم</span> </a>

    <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i> <span>تسجيل خروج</span> </a>
</div>


<div class="page_continer">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-5">
                    <h1><span class="purul">مرحبًا، </span>
                        <span class="purul">
                 Auth USer NAme
                </span></h1>
                </div>
            </div>
        </div>
        <div class="row dash-stats ">
            <div class="col-md-12">
                <div class="heading mb-4">
                    <h4>معلومات المهمة</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row box_row gy-4">
                    <!-- box-1  -->
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-green">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">المهام النشطة</p>
                                    <p class="mb-0 para">1212</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- box-2  -->
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-green-2">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">المهام المكتملة</p>
                                    <p class="mb-0 para">555</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- box 3 --}}
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-yellow">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">المهام العالقة</p>
                                    <p class="mb-0 para">55415</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- box 4 --}}
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-rose">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">المهام الملغاة</p>
                                    <p class="mb-0 para">554</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- box 5 --}}
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-light-green">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">كل المهام</p>
                                    <p class="mb-0 para">55</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row dash-stats ">
            <div class="col-md-12">
                <div class="heading mb-4">
                    <h4>معلومات المحفظة</h4>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row box_row gy-4">
                    <!-- box-1  -->
                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-green-2">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">رصيد المحفظة</p>
                                    <p class="mb-0 para">200</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col col-sm-6 col-lg-6 col-xxl-4 col-xxxl-3">
                        <div class="box box-yellow">
                            <div class="content d-flex align-items-center justify-content-between">
                                <div class="left">
                                    <p class="mb-0 blue-text">إجمالي الإنفاق</p>
                                    <p class="mb-0 para">$2500</p>
                                </div>
                                <div class="right">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@include('sweetalert::alert')
</body>

</html>



