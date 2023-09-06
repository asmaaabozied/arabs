@extends('dashboard::layouts.auth.main')
@section('content')
<div class=" col-12  bg-grey outer-div-login" style="padding-bottom:36%">
    <div class="inner-div-login" style="">
                <form action="" method="post">
                    @csrf
                    <div class="row" >
                        <div class="col-md-12 ">
                            <h1 class="text-primary text-center sign_in font_JF">Reset Password </h1>
                        </div>

                    </div>
                    <div class="input-group pt-3" >
                        <input type="password" name="password" required id="" class="form-control input_login password_input borderless p-3" placeholder="كلمة المرور" aria-describedby="helpId">
                    </div>

                    <div class="input-group pt-3" >
                        <input type="password" name="confirmed" required id="" class="form-control input_login password_input borderless p-3" placeholder="تاكيد كلمة المرور" aria-describedby="helpId">
                    </div>

                      <div class="form-group center_btn mt-4 ">
                        <button class="btn btn-outline p-3"  style="width: 100%; background-color:#EF626C; color:white;">إسترجاع كلمة المرور</button>
                      </div>

                </form>

    </div>
</div>
</div>
@endsection
<script>
    function togglePasswordVisibility() {
      var input = document.querySelector('.password_input');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
        }

</script>
