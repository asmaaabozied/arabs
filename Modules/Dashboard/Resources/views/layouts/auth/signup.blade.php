@extends('dashboard::layouts.auth.main')
@section('content')
    <div class="row">
        <div class="col-12 ">

            <div class="form_container  bg-white ">
                <div class="heading text-center">
                    <h1 class="form-heading">{{trans('admin::signup.register')}}</h1>
                </div>
                  <!-- In the callback, you would hide the gSignInWrapper element on a successful sign in -->
                  <div id="gSignInWrapper" class="center_btn mt-3 mb-3">
                    <div id="customBtn" class="customGPlusSignIn">
                        <span class=""></span>
                  <span class="buttonText">{{trans('admin::signIn.google_sigin_in')}}</span>
                  </div>
              </div>
                <div class="login_form form-default">
                    <form id="reg_form" class="row g-4" method="POST" action="http://127.0.0.1:8000/auth/customRegistration">
                        <input type="hidden" name="_token" value="e0OplWT1VS9Bx6WMpI97SXI1DyWXtQ5IQhbEZbCJ">            <div class="col-md-12 relative">
                            <input type="text" class="form-control inputPlaceholder" placeholder="{{trans('admin::signup.name')}}" name="name" required id="name">
                            <img src="{{asset('assets/img/user.png')}}" class="input_img" width="20">
                        </div>

                        <div class="d-none" id="name-validation">
                            <span class='text-danger d-block' id="name-show"></span>
                        </div>


                        <div class="col-md-12 relative">
                            <input type="email" class="form-control inputPlaceholder" placeholder="{{trans('admin::signup.email')}}" name="email" required id="email">
                            <img src="{{asset('assets/img/mail.png')}}" class="input_img" width="20">
                        </div>

                        <div class="d-none" id="email-validation">
                            <span class='text-danger d-block' id="email-show"></span>
                        </div>


                        <div class="col-md-12 relative">
                            <input type="Password" class="form-control inputPlaceholder" placeholder="{{trans('admin::signup.password')}}" name="password" required id="password">
                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput" width="16">
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
                            <input type="Password" class="form-control inputPlaceholder" placeholder="{{trans('admin::signup.confirm_password')}}" name="password_confirmation" required id="confirm-password">
                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput1" width="16">
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
                                <option value="">{{trans('admin::signup.select_country')}}</option>
                            </select>
                        </div>

                        <div class="d-none" id="country-validation">
                            <span class='text-danger d-block' id="country-show"></span>
                        </div>



                        <div class="col-md-12 relative">
                            <select class="form-select" aria-label="Default select example" name="city_id" required id="city-select">
                                <option value="">{{trans('admin::signup.select_city')}}</option>
                            </select>
                        </div>

                        <div class="d-none" id="country-validation">
                            <span class='text-danger d-block' id="country-show"></span>
                        </div>


                        <div class="col-md-12 relative">
                            <select class="form-select" aria-label="Default select example" name="user_type" required id="user-type-select">
                                <option value="">{{trans('admin::signup.account_type')}}</option>
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
                                    <label class="form-check-label" for="condition1">{{trans('admin::signup.confirm_condition')}}</label>
                                </div>

                                <div class="d-none" id="condition1-validation">
                                    <span class='text-danger d-block' id="condition1-show"></span>
                                </div>


                                <div class="form-check">
                                    <input class="form-check-input the-check-box" type="checkbox" value="" id="condition2" name="condition2">
                                    <label class="form-check-label" for="condition2">{{trans('admin::signup.news_letter')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn w-100 theme_green font-28 pt-2 pb-2 mt-4 mb-3" onclick="reg_form_validation()">{{ trans('admin::signup.register') }}</button>
                        </div>
                        <div class="col-md-12">
                            <p class="black-text font-20 text-center mt-3 mb-3">{{trans('admin::signup.have_account')}}  <a href="http://127.0.0.1:8000/auth/login" class="blu-text">{{ trans('admin::signup.login') }}</a>  </p>
                        </div>
                    </form>

                </div>
            </div>


        </div>
    </div>
    <script>

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
@endsection
