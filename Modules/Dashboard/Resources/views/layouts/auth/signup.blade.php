<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <meta name="author" content="ArabWorkers | Mohammad Gamel">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>
        {{trans('employer::employer.panel')}}
    </title>
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

    <link rel="stylesheet" href="{{asset('assets/css/login/libs.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login/default.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/login/custom.css')}}">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

</head>
<body>

<div class="preloader preloader-1" id="preloader">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-light home-nav">
    <div class="container">

        <a class="navbar-brand" href="https://arabworkers.com/"><img src="http://127.0.0.1:8000/images/logo.png" class="brand-logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link link" href="http://127.0.0.1:8000/browse-tasks">تصفح المهام</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="http://127.0.0.1:8000/create-task">إنشاء مهمة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link" href="https://arabworkers.com/%d8%a7%d9%84%d8%aa%d8%b3%d9%88%d9%8a%d9%82-%d8%a8%d8%a7%d9%84%d8%b9%d9%85%d9%88%d9%84%d8%a9/">التسويق بالعمولة</a>
                </li>
            </ul>
            <div class="btn-group">

                <button onclick="window.location.href='http://127.0.0.1:8000/auth/login'" class="green-button">
                    <span id="logInText">حسابي</span>
                    <i class="fa-solid fa-user logInIcon"></i>
                </button>
            </div>
        </div>
    </div>
</nav>


<main class="page_main login-main">
    <div class="container">
        <div class="row">
            <div class="col-12 ">

                <div class="form_container  bg-white ">
                    <div class="heading text-center">
                        <h1 class="form-heading">اشتراك</h1>
                    </div>
                    <div class="login_form form-default">
                        <form id="reg_form" class="row g-4" method="POST" action="http://127.0.0.1:8000/auth/customRegistration">
                            <input type="hidden" name="_token" value="e0OplWT1VS9Bx6WMpI97SXI1DyWXtQ5IQhbEZbCJ">            <div class="col-md-12 relative">
                                <input type="text" class="form-control inputPlaceholder" placeholder="اسم" name="name" required id="name">
                                <img src="http://127.0.0.1:8000/images/user.png" class="input_img" width="20">
                            </div>

                            <div class="d-none" id="name-validation">
                                <span class='text-danger d-block' id="name-show"></span>
                            </div>


                            <div class="col-md-12 relative">
                                <input type="email" class="form-control inputPlaceholder" placeholder="البريد الإلكتروني" name="email" required id="email">
                                <img src="http://127.0.0.1:8000/images/mail.png" class="input_img" width="20">
                            </div>

                            <div class="d-none" id="email-validation">
                                <span class='text-danger d-block' id="email-show"></span>
                            </div>


                            <div class="col-md-12 relative">
                                <input type="Password" class="form-control inputPlaceholder" placeholder="كلمة المرور" name="password" required id="password">
                                <img src="http://127.0.0.1:8000/images/pass.png" class="input_img" id="myInput" width="16">
                                <div id="password-close-eye">
                                    <i type="button" class="fas fa-eye-slash" id="togglePassword" onclick="myFunction()"></i>
                                </div>
                                <div id="password-open-eye">
                                    <i type="button" class="fas fa-eye" id="togglePassword" onclick="myFunction()"></i>
                                </div>
                            </div>

                            <div class="d-none" id="password-validation">
                                <span class='text-danger d-block' id="match-pass"></span>
                                <span class='text-danger d-block' id="min-length"></span>
                                <span class='text-danger d-block' id="pass-show"></span>
                            </div>


                            <div class="col-md-12 relative">
                                <input type="Password" class="form-control inputPlaceholder" placeholder="تأكيد كلمة المرور" name="password_confirmation" required id="confirm-password">
                                <img src="http://127.0.0.1:8000/images/pass.png" class="input_img" id="myInput1" width="16">
                                <div id="confirm-close-eye">
                                    <i type="button" class="fas fa-eye-slash" id="togglePassword" onclick="myFunction1()"></i>
                                </div>
                                <div id="confirm-open-eye">
                                    <i type="button" class="fas fa-eye" id="togglePassword" onclick="myFunction1()"></i>
                                </div>
                            </div>

                            <div class="d-none" id="cpassword-validation">
                                <span class='text-danger d-block' id="cpass-show"></span>
                            </div>


                            <div class="col-md-12 relative">
                                <select class="form-select" aria-label="Default select example" name="country_id" required id="country-select">
                                    <option value="">حدد الدولة</option>
                                </select>
                            </div>

                            <div class="d-none" id="country-validation">
                                <span class='text-danger d-block' id="country-show"></span>
                            </div>


                            <div class="col-md-12 relative">
                                <select class="form-select" aria-label="Default select example" name="user_type" required id="user-type-select">
                                    <option value="">حدد نوع الحساب</option>
                                    <option value="employer">Employer</option>
                                    <option value="worker">Worker</option>
                                </select>
                            </div>

                            <div class="d-none" id="userType-validation">
                                <span class='text-danger d-block' id="userType-show"></span>
                            </div>


                            <div class="col-md-12">
                                <div class="check_boxx">
                                    <div class="form-check">
                                        <input class="form-check-input the-check-box" type="checkbox" value="" id="condition1" name="condition1" required>
                                        <label class="form-check-label" for="condition1">
                                            بالتسجيل للحصول على حساب فإنك توافق على الشروط والأحكام الخاصة بنا
                                        </label>
                                    </div>

                                    <div class="d-none" id="condition1-validation">
                                        <span class='text-danger d-block' id="condition1-show"></span>
                                    </div>


                                    <div class="form-check">
                                        <input class="form-check-input the-check-box" type="checkbox" value="" id="condition2" name="condition2">
                                        <label class="form-check-label" for="condition2">
                                            أرغب في الحصول على النشرة الإخبارية
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn w-100 theme_green font-28 pt-2 pb-2 mt-4 mb-3" onclick="reg_form_validation()">اشتراك</button>
                            </div>
                            <div class="col-md-12">
                                <p class="black-text font-20 text-center mt-3 mb-3">للدي حساب بالفعل؟   <a href="http://127.0.0.1:8000/auth/login" class="blu-text">تسجيل الدخول</a>  </p>
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-white footer">
    <div class="container ">
        <div class="row gy-4">
            <div class="col-lg-8 col-md-12">
                <div class="row gy-4">
                    <div class="col-12">
                        <img src="http://127.0.0.1:8000/images/logo_f.png" class="mb-2">
                    </div>
                    <!-- 1 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="f_links ps-5 ps-md-0">

                            <div class="f_links_bottom">
                                <ul>
                                    <li><a href="https://arabworkers.com/">الرئيسية</a></li>
                                    <li><a href="http://127.0.0.1:8000/browse-tasks"> تصفح المهام</a></li>
                                    <li><a
                                            href="http://127.0.0.1:8000/create-task">إنشاء
                                            مهمة
                                        </a></li>
                                    <li><a href="https://arabworkers.com/%d8%a7%d9%84%d8%aa%d8%b3%d9%88%d9%8a%d9%82-%d8%a8%d8%a7%d9%84%d8%b9%d9%85%d9%88%d9%84%d8%a9/"> التسويق بالعمولة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- 2 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="f_links_bottom">
                            <ul>
                                <li><a href="https://arabworkers.com/%d8%a7%d9%84%d8%a3%d8%b3%d8%a6%d9%84%d8%a9-%d8%a7%d9%84%d8%b4%d8%a7%d8%a6%d8%b9%d8%a9/"> الأسئلة الشائعة</a></li>
                                <li><a href="https://arabworkers.com/%d9%85%d9%86-%d9%86%d8%ad%d9%86/"> عن عرب وركرز</a></li>
                                <li><a
                                        href="https://arabworkers.com/%d8%b9%d9%85%d9%88%d9%84%d8%a9-%d8%b9%d8%b1%d8%a8-%d9%88%d8%b1%d9%83%d8%b1%d8%b2/">
                                        عمولة عرب وركرز</a></li>
                                <li><a
                                        href="https://arabworkers.com/%d8%aa%d9%88%d8%a7%d8%b5%d9%84-%d9%85%d8%b9%d9%86%d8%a7/">تواصل معنا
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- 3 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="f_links_bottom">
                            <ul>
                                <li><a href="https://arabworkers.com/blog/"> دروس ومقالات </a></li>
                                <li><a href="https://arabworkers.com/%d8%a7%d9%84%d8%a3%d8%b3%d8%a6%d9%84%d8%a9-%d8%a7%d9%84%d8%b4%d8%a7%d8%a6%d8%b9%d8%a9/"> الأسئلة الشائعة</a></li>
                                <li><a
                                        href="https://arabworkers.com/%d8%b4%d8%b1%d9%88%d8%b7-%d8%a7%d9%84%d8%a7%d8%b3%d8%aa%d8%ae%d8%af%d8%a7%d9%85/">
                                        شروط الاستخدام</a></li>
                                <li><a
                                        href="https://arabworkers.com/%d8%b3%d9%8a%d8%a7%d8%b3%d8%a9-%d8%a7%d9%84%d8%ae%d8%b5%d9%88%d8%b5%d9%8a%d8%a9/">سياسة الخصوصية
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 d-flex flex-column justify-content-center">
                <div class="f_links text-center">
                    <h4 style="font-size: 21px;" class="purple-text fw-bold">تواصل معنا</h4>
                    <div class="social_links mb-5 my-4">
                        <a style="color: #395185;" href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a style="color: #55ACEE;" href="#"><i class="fa-brands fa-twitter"></i>
                            <a style="color: #FF0000;" href="#"><i class="fa-brands fa-youtube"></i></a>
                            <a style="color: #0A66C2;" href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                    <h4 class="mb-4 purple-text fs-6 fw-bold">اشترك في النشرة البريدية</h4>
                    <div class="f-link_box ">
                        <form class="d-flex mb-2" role="search">
                            <input class="form-control footer-field" type="search" placeholder="البريد الالكتروني"
                                   aria-label="Search">
                            <button class="btn-1 footer-btn btn-radius" type="submit"><i class="fa-solid fa-arrow-left"></i></button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="copy_right">
                    <div class="pay_links text-center mb-3">
                        <img src="http://127.0.0.1:8000/images/p1.png" class="des-block">
                        <img src="http://127.0.0.1:8000/images/p2.png" class="des-block">
                        <img src="http://127.0.0.1:8000/images/p3.png" class="des-block">
                    </div>
                    <p class="text-center">عرب وركرز - منصة عربية مسجلة في وزارة الاستثمار المصرية - جميع الحقوق
                        محفوظة. 2020 - 2022 ©</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="http://127.0.0.1:8000/js/libs.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script type="text/javascript">

    // Select 2
    $(document).ready(function () {
        $('.select2').select2();

    });

    // Pre-loader function
    function preloader_on() {
        document.getElementById("preloader").style.display = "block";
    }
    function preloader_off() {
        document.getElementById("preloader").style.display = "none";
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


</script>

<script>

    // $("#reg_form").on("submit", function(e){
    //     let password         = $('#password').val();
    //     let confirm_password = $('#confirm-password').val();
    //     if(password == confirm_password && password.length >= 8){
    //         preloader_on();
    //         document.getElementById("reg_form").submit();
    //     }
    // })

    //***************************************************
    //Start of Registration Form Validaton
    //****************************************************
    function reg_form_validation(){
        let name             = $('#name').val();
        let email            = $('#email').val();
        let password         = $('#password').val();
        let confirm_password = $('#confirm-password').val();
        let country          = $('#country-select').val();
        let user_type        = $('#user-type-select').val();
        let number_of_error  = 0;

        if(name == ""){
            $('#name-validation').removeClass('d-none');
            document.getElementById('name-validation').display = 'block';
            document.getElementById("name-show").innerHTML = "لا يمكن ترك حقل الاسم فارغًا";
            number_of_error += 1;
        }
        else{
            $('#name-validation').addClass('d-none');
        }
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if(email == ""){
            $('#email-validation').removeClass('d-none');
            document.getElementById('email-validation').display = 'block';
            document.getElementById("email-show").innerHTML = "لا يمكن ترك حقل البريد الإلكتروني فارغًا";
            number_of_error += 1;
        }
        else{
            $('#email-validation').addClass('d-none');
        }
        if(email){
            if (!email.match(validRegex)) {
                $('#email-validation').removeClass('d-none');
                document.getElementById('email-validation').display = 'block';
                document.getElementById("email-show").innerHTML = "تنسيق بريد إلكتروني غير صالح";
                number_of_error += 1;
            }
            else{
                $('#email-validation').addClass('d-none');
            }
        }


        // Password Validation
        if(password == ""){
            $('#password-validation').removeClass('d-none');
            document.getElementById('password-validation').display = 'block';
            document.getElementById("pass-show").innerHTML = "لا يمكن ترك حقل كلمة المرور فارغًا";
            number_of_error += 1;
        }
        else{
            document.getElementById("pass-show").innerHTML = "";
            $('#password-validation').addClass('d-none');
            if(password.length < 8){
                $('#password-validation').removeClass('d-none');
                document.getElementById('password-validation').display = 'block';
                document.getElementById("min-length").innerHTML = "يجب ألا يقل طول كلمة المرور عن 8 أحرف";
                number_of_error += 1;
            }
            else{
                document.getElementById("min-length").innerHTML = "";
                $('#password-validation').addClass('d-none');
            }
        }

        if(confirm_password == ""){
            $('#cpassword-validation').removeClass('d-none');
            document.getElementById('cpassword-validation').display = 'block';
            document.getElementById("cpass-show").innerHTML = "لا يمكن ترك حقل تأكيد كلمة المرور فارغًا";
            number_of_error += 1;
        }
        else{
            $('#cpassword-validation').addClass('d-none');
            document.getElementById("cpass-show").innerHTML = "";

        }
        // password and confirm password match check
        if(password != '' && confirm_password != "" && password.length >= 8){
            if(password != confirm_password){
                $('#password-validation').removeClass('d-none');
                document.getElementById('password-validation').display = 'block';
                document.getElementById("match-pass").innerHTML = "كلمة المرور وتأكيد كلمة المرور غير متطابقين";
                number_of_error += 1;
            }
            else{
                document.getElementById("match-pass").innerHTML = "";
                $('#password-validation').addClass('d-none');

            }
        }

        // country validation
        if(country == ''){
            $('#country-validation').removeClass('d-none');
            document.getElementById('country-validation').display = 'block';
            document.getElementById("country-show").innerHTML = "لا يمكن ترك حقل البلد فارغًا";
            number_of_error += 1;
        }
        else{
            $('#country-validation').addClass('d-none');
        }

        // User Type validation
        if(user_type == ''){
            $('#userType-validation').removeClass('d-none');
            document.getElementById('userType-validation').display = 'block';
            document.getElementById("userType-show").innerHTML = "لا يمكن أن يكون حقل نوع المستخدم فارغًا";
            number_of_error += 1;
        }
        else{
            $('#userType-validation').addClass('d-none');
        }

        //Condition 1 validation
        if(document.getElementById('condition1').checked == false){
            $('#condition1-validation').removeClass('d-none');
            document.getElementById('condition1-validation').display = 'block';
            document.getElementById("condition1-show").innerHTML = "الرجاء قبول الشروط والأحكام";
            number_of_error += 1;
        }
        else{
            $('#condition1-validation').addClass('d-none');
        }

        // submit form
        if(number_of_error == 0){
            preloader_on();
            document.getElementById("reg_form").submit();
        }
    }
    //***************************************************
    //End of Registration Form Validaton
    //****************************************************

    $('#password-open-eye').hide();
    $('#confirm-open-eye').hide();

    function myFunction(){
        let input_type = $('#password').attr('type');
        if(input_type == 'password'){
            $('#password').prop('type', 'text');
            $('#password-open-eye').show();
            $('#password-close-eye').hide();
        }
        else{
            $('#password').prop('type', 'password');
            $('#password-open-eye').hide();
            $('#password-close-eye').show();
        }
    }

    function myFunction1(){
        let input_type = $('#confirm-password').attr('type');
        if(input_type == 'password'){
            $('#confirm-password').prop('type', 'text');
            $('#confirm-open-eye').show();
            $('#confirm-close-eye').hide();
        }
        else{
            $('#confirm-password').prop('type', 'password');
            $('#confirm-open-eye').hide();
            $('#confirm-close-eye').show();
        }
    }


</script>


</body>

</html>
