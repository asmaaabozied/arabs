<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="author" content="ArabWorkers | Mohammad Gamel">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>
        {{trans('worker::worker.panel')}}
    </title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('assets/css/panel/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/panel/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/panel/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/panel/responsive.css')}}">
    <!-- This file was causing some problems in displaying the font type in the project
I examined it and did not find any class in it that could help us in the project
If any error occurs later in the style of a page, please check this file -->
{{--    <link rel="stylesheet" href="{{asset('assets/css/panel/custom.css')}}">--}}
<!-- This file was causing some problems in displaying the font type in the project
I examined it and did not find any class in it that could help us in the project
If any error occurs later in the style of a page, please check this file -->
    <link rel="stylesheet" href="{{asset('assets/css/panel/dataTable.min.css')}}">
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
        <a class="navbar-brand" href="#"><img src="{{asset("assets/icons/arabWorkers/logo.png")}}"
                                              class="brand-logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-house text-primary"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link active-up-menu" href="#">تصفح المهمة</a>
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
                            <img src="{{asset('assets/img/marie.jpg')}}" class="profile">
                            <span class="me-2 text-primary">Worker Name</span>
                        </a>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >Logout</a></li>
                    </ul>
                    <form id="logout-form" action="{{ route('worker.logout') }}" method="POST"
                          class="d-none">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>
<div class="side_menu">
    <ul class="">
        <li class="side_menu_item active">
            <a class="nav-link nav-text  " href="http://127.0.0.1:8001/panel/employer">
                <i class="fa-solid fa fa-globe active-text"></i>
                <span class="nav-link-text m-2 fw-bold active-text">{{trans('worker::worker.panel')}}</span>
            </a>
        </li>
        <li class="side_menu_item">
            <a class="nav-link nav-text  " href="#">
                <i class="fa-solid fa-user"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.MyProfile')}}</span>
            </a>
        </li>
        <li class="side_menu_item">
            <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link nav-text collapsed"
               aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                <i class="fa-solid fa-tag"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.tasks')}}</span>
            </a>
            <div class="collapse" id="dashboardsExamples" style="">
                <ul class="nav ms-4 ps-3">
                    <li class=" ">
                        <a class="nav-link nav-text " href="#">
                            <span class="sidenav-normal">    {{trans('worker::worker.browseTask')}}  </span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text" href="#">
                            <span
                                class="sidenav-normal"> {{trans('worker::worker.Tasks_in_progress')}} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text " href="#">
                            <span class="sidenav-normal"> {{trans('worker::worker.done_tasks')}} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text " href="#">
                            <span class="sidenav-normal"> {{trans('worker::worker.completed_tasks')}}  </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-text " href="#">
                            <span class="sidenav-normal">  {{trans('worker::worker.rejected_tasks')}} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side_menu_item">
            <a data-bs-toggle="collapse" href="#FinancialAffairs" class="nav-link nav-text collapsed"
               aria-controls="FinancialAffairs" role="button" aria-expanded="false">
                <i class="fa-solid fa-credit-card"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.Financial Affairs')}}</span>
            </a>
            <div class="collapse" id="FinancialAffairs" style="">
                <ul class="nav ms-4 ps-3">

                    <li class="">
                        <a class="nav-link nav-text" href="#">
                            <span class="sidenav-normal">  {{trans('worker::worker.myProfits')}} </span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal">{{trans('worker::worker.TransferWorkerWalletBalanceToEmployer')}} </span>
                        </a>
                    </li>

                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span
                                class="sidenav-normal">{{trans('worker::worker.WalletHistory')}} </span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal">{{trans('worker::worker.WithdrawWalletBalance')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="side_menu_item">
            <a data-bs-toggle="collapse" href="#ManagementSection" class="nav-link nav-text"
               aria-controls="ManagementSection" role="button" aria-expanded="">
                <i class="fa fa-list-ol"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.ManagementSection')}}</span>
            </a>
            <div class="collapse" id="ManagementSection" style="">
                <ul class="nav ms-4 ps-3">

                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span
                                class="sidenav-normal"> {{trans('worker::worker.switchingAccountHistory')}} </span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal">  {{trans('worker::worker.PrivilegesHistory')}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal">{{trans('worker::worker.RuleOfPrivileges')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side_menu_item ">
            <a data-bs-toggle="collapse" href="#EmployerSupport" class="nav-link nav-text"
               aria-controls="EmployerSupport" role="button" aria-expanded="">
                <i class="fa-solid fa-headphones-simple"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.SupportSection')}}</span>

            </a>
            <div class="collapse" id="EmployerSupport" style="">
                <ul class="nav ms-4 ps-3">

                    <li class="">
                        <a class="nav-link nav-text" href="#">
                            <span class="sidenav-normal "> {{trans('worker::worker.myTickets')}} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="side_menu_item">
            <a data-bs-toggle="collapse" href="#AppLanguage" class="nav-link nav-text" aria-controls="AppLanguage"
               role="button" aria-expanded="">
                <i class="fa-solid fa fa-globe"></i>

                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.AppLanguage')}}</span>
            </a>
            <div class="collapse" id="AppLanguage" style="">
                <ul class="nav ms-4 ps-3">
                    <li class="">
                        <a class="nav-link nav-text active-select-nav"
                           href="#">
                            <span class="sidenav-normal"> {{trans('worker::worker.ArabicLang')}}   </span>
                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal"> {{trans('worker::worker.EnglishLang')}}   </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="side_menu_item">
            <a data-bs-toggle="collapse" href="#SelectedCurrency" class="nav-link nav-text"
               aria-controls="SelectedCurrency" role="button" aria-expanded="">
                <i class="fa fa-usd"></i>
                <span class="nav-link-text m-2 fw-bold">{{trans('worker::worker.Currencies')}}</span>
            </a>
            <div class="collapse " id="SelectedCurrency" style="">
                <ul class="nav ms-4 ps-3">
                    <li class="">
                        <a class="nav-link nav-text active-select-nav"
                           href="#">
                            <span class="sidenav-normal"> دولار أمريكي  </span>

                        </a>
                    </li>
                    <li class="">
                        <a class="nav-link nav-text"
                           href="#">
                            <span class="sidenav-normal"> جنيه مصري  </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <div class=" side_menu_item ">
            <div class="d-flex justify-content-around col-auto pt-2 pb-2 ">
                <div class="form-check form-switch my-auto">
                    <input class="form-check-input features" style="cursor: pointer" onclick="ShowSwal()" type="checkbox">
                </div>
                <div class="">
                    <div class="h-100">
                        <h5 class="mb-0 fw-bold">{{trans('worker::worker.switchToEmployerAccount')}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </ul>
</div>


<div class="page_continer">
    <div class="container-fluid min-vh-93">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                {{--                <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                {{--                <li class="breadcrumb-item "><a href="#">Library</a></li>--}}
                <li class="breadcrumb-item text-primary font-26" aria-current="page">لوحة التحكم</li>
            </ol>
        </nav>
        @yield('content')
    </div>
    <footer class="bg-body footer">
        <div class="container ">
            <div class="row gy-4">
                <div class="col-12">
                    <div class="copy_right">
                        <div class="copyright text-center text-sm text-muted">
                            <a href="https://arabworkers.com/" class="font-weight-bold" target="_blank">
                                {{trans('admin::admin.company_name')}}
                            </a> {{trans('admin::admin.company_description')}}
                            {{trans('admin::admin.allRightsAreSave')}}
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>

                        </div>
                        <div class="f_links text-center">
                            <div class="social_links mb-1 my-1">
                                <a style="color: #395185;" href="#">
                                    <svg class="svg-inline--fa fa-facebook" aria-hidden="true" focusable="false"
                                         data-prefix="fab" data-icon="facebook" role="img"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                    </svg><!-- <i class="fa-brands fa-facebook"></i> Font Awesome fontawesome.com -->
                                </a>
                                <a style="color: #55ACEE;" href="#">
                                    <svg class="svg-inline--fa fa-twitter" aria-hidden="true" focusable="false"
                                         data-prefix="fab" data-icon="twitter" role="img"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                                    </svg><!-- <i class="fa-brands fa-twitter"></i> Font Awesome fontawesome.com -->
                                </a><a style="color: #FF0000;" href="#">
                                    <svg class="svg-inline--fa fa-youtube" aria-hidden="true" focusable="false"
                                         data-prefix="fab" data-icon="youtube" role="img"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 576 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path>
                                    </svg><!-- <i class="fa-brands fa-youtube"></i> Font Awesome fontawesome.com --></a>
                                <a style="color: #0A66C2;" href="#">
                                    <svg class="svg-inline--fa fa-linkedin" aria-hidden="true" focusable="false"
                                         data-prefix="fab" data-icon="linkedin" role="img"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                              d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
                                    </svg><!-- <i class="fa-brands fa-linkedin"></i> Font Awesome fontawesome.com -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="swal-overlay swal-overlay--show-modal d-none" id="CustomSwal" tabindex="-1">
    <div class="swal-modal" role="dialog" aria-modal="true">
        <div class="swal-icon swal-icon--info"></div>
        <div class="swal-title">{{trans('worker::worker.switchAccountToEmployerTitle')}}</div>
        <div class="swal-text text-center">
            {{trans('worker::worker.switchAccountToEmployerText')}}
        </div>
        <div class="swal-footer">
            <div class="swal-button-container d-flex justify-content-between">
                <a onclick="event.preventDefault(); document.getElementById('switch-account-form').submit();"
                   class="btn bg-success text-white w-auto m-4 ">{{trans('worker::worker.switchBtn')}}</a>
                <button class="btn bg-dark text-white w-auto m-4"
                        onclick="hideSwal()">{{trans('worker::worker.cancelBtn')}}</button>
            </div>
            <form id="switch-account-form" action="{{route('worker.switch.account.to.employer')}}" method="POST"
                  class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

    function ShowSwal() {
        document.getElementById('CustomSwal').classList.remove('d-none')
    }

    function hideSwal() {
        document.getElementById('CustomSwal').classList.add('d-none');
        $("input[type=checkbox]").prop("checked", false);
    }
</script>
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables-ar.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".hamburger").click(function () {
            $(".side_menu").toggleClass("display");
        });
    });

    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 130) {
                $('.side_menu').addClass("fixed");
            } else if ($(window).scrollTop() < 130) {
                $('.side_menu').removeClass("fixed");
            }
        });
    });
</script>
@include('sweetalert::alert')
</body>

</html>


