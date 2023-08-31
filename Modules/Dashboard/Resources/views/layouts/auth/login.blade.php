@extends('dashboard::layouts.auth.main')
@section('content')
    <div class="row">
        <div class="col-12 ">

            <div class="form_container  bg-white ">
                <div class="heading text-center">
                    <h1 class="form-heading">تسجيل الدخول</h1>
                </div>
                <div class="login_form form-default">
                    <div id="err" style="color: red">
                    </div>
                    <form class="row g-4" action="http://127.0.0.1:8000/auth/customLogIn" method="POST"
                          id="logIn_form">
                        <input type="hidden" name="_token" value="e0OplWT1VS9Bx6WMpI97SXI1DyWXtQ5IQhbEZbCJ">
                        <div class="col-md-12 relative">
                            <input type="email" class="form-control input-lg inputPlaceholder"
                                   placeholder="البريد الإلكتروني" name="email" required value="">
                            <img src="{{asset('assets/img/mail.png')}}" class="input_img" width="20">
                        </div>
                        <div class="col-md-12 relative">
                            <input type="Password" id="lpassword" class="form-control input-lg inputPlaceholder"
                                   placeholder="كلمة المرور" name="password" required>
                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput"
                                 width="16">
                            <div id="lpassword-close-eye">
                                <i type="button" class="fas fa-eye-slash" id="togglePassword"
                                   onclick="changePasswordType()"></i>
                            </div>
                            <div id="lpassword-open-eye">
                                <i type="button" class="fas fa-eye" id="togglePassword"
                                   onclick="changePasswordType()"></i>
                            </div>
                        </div>

                        <a class="text-red anchor-hover-color" href="http://127.0.0.1:8000/forgot-password">نسيت
                            رقمك السري؟</a>

                        <div class="col-md-12">
                            <button type="submit" class="btn w-100 theme_green font-28 pt-2 pb-2">تسجيل الدخول
                            </button>
                            <p class="black-text text-center mt-4   font-20 mb-0">ليس لديك حساب؟ <a
                                    href="http://127.0.0.1:8000/auth/registration"
                                    class="blu-text"> انشئ حساب</a></p>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.select2').select2();

        });

    </script>

    <script>

        $('#logIn_form').on('submit', function () {
            preloader_on();
        })

        $('#lpassword-open-eye').hide();

        function changePasswordType() {
            let input_type = $('#lpassword').attr('type');

            if (input_type == 'password') {
                $('#lpassword').prop('type', 'text');
                $('#lpassword-open-eye').show();
                $('#lpassword-close-eye').hide();
            } else {
                $('#lpassword').prop('type', 'password');
                $('#lpassword-open-eye').hide();
                $('#lpassword-close-eye').show();
            }
        }

    </script>

@endsection
