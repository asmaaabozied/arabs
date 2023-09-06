@extends('dashboard::layouts.auth.main')
@section('content')
    <div class="row">
        <div class="col-12 ">

            <div class="form_container  bg-white ">
                <div class="heading text-center">
                    <h1 class="form-heading">{{trans('dashboard::auth.Sign in')}}</h1>
                </div>
                <div class="col-12 center-align mb-2">
                    <a class="btn bg-primary d-flex justify-content-between flex-row-reverse " href="#" style="text-transform:none">
                        <div class="">
                            <img width="50px" style="margin-top:0px; margin-right:0px"
                                 alt="Google sign-in"
                                 src="{{asset('assets/img/Google5.png')}}"/>
                        </div>
                        <span class="mt-2 font-20 text-white">{{trans('employer::signIn.SignIn Using Google Account')}}</span>

                    </a>
                </div>

                <!-- In the callback, you would hide the gSignInWrapper element on a successful sign in -->
                  <div id="gSignInWrapper" class="center_btn mt-3 mb-3">
                      <div id="customBtn" class="customGPlusSignIn">
                          <span class=""></span>
                    </div>
                </div>
                <div id="name"></div>
                <div class="login_form form-default">
                    <div id="err" style="color: red">
                    </div>
                    <form class="row g-4" action="#" method="POST" id="logIn_form">
                        @csrf
                        <div class="col-md-12 relative">
                            <input type="email" class="form-control input-lg inputPlaceholder"
                                   placeholder="{{trans('dashboard::auth.email')}}" name="email" required value="">
                            <img src="{{asset('assets/img/mail.png')}}" class="input_img" width="20">
                        </div>
                        <div class="col-md-12 relative">
                            <input type="Password" id="lpassword" class="form-control input-lg inputPlaceholder"
                                   placeholder="{{trans('dashboard::auth.password')}}" name="password" required>
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


                        <div class="col-md-12 relative">
                            <input type="text" id="captcha" class="form-control input-lg inputPlaceholder"
                                   placeholder="{{trans('employer::signIn.captcha_code')}}" name="captcha" required>
                            <img src="{{asset('assets/img/default/captcha.png')}}" class="input_captcha" width="20">
                            <div>
                                <i type="button" class="fas fa-rotate refresh-button" id="toggleCapatch"
                                   onclick=""></i>
                            </div>
                            <span class="captcha-image">{!! Captcha::img() !!}</span> &nbsp;&nbsp;

                        </div>

                        <a class="text-red anchor-hover-color" href="#">{{trans('dashboard::auth.are_you_forget_password')}}</a>

                        <div class="col-md-12">
                            <button type="submit" class="btn w-100 theme_green font-28 pt-2 pb-2">{{trans('dashboard::auth.Sign in')}}
                            </button>
                            <p class="black-text text-center mt-4   font-20 mb-0">{{trans('dashboard::auth.not_have_account')}} <a
                                    href="#"
                                    class="blu-text"> {{trans('dashboard::auth.GoToRegisterForm')}}</a></p>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.refresh-button').click(function () {
                $.ajax({
                    type: 'get',
                    url: '{{ route('refreshCaptcha') }}',
                    success: function (data) {
                        $('.captcha-image').html(data.captcha);
                    }
                });
            });
        });
    </script>

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
