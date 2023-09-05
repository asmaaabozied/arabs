
@extends('dashboard::layouts.auth.main')
@section('content')
<div class=" col-12 " style="background: var(--bg, #FBFBFB);padding-top:7%;padding-bottom:7%">
    <div class="text-center"  >
    <h1 class="err_text">404 </h1>
    <h2 class="text-center pt-3">Page Not Found </h2>
    <p class="text_err_des">The page you are looking for doesn’t exist or an</p>
    <p class="text_err_des">other error occurred, go back to home page.</p>
        <div class="form-group center_btn" >
            <button class="btn btn-success" style="background: var(--blue, #09F);border-radius: 27.5px;padding: 18px 57px;gap: 10px;">Back to Home</button>
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
