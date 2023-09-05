@extends('dashboard::layouts.employer.master')
@section('content')

<ul class="breadcrumb">
    <li><a href="/dashboard">Dashboard</a></li>
    <li>Workers Profile</li>
  </ul>

    <div class="row">
        <div class="col-xl-1 col-md-3 mb-4">
            <a class="img logo rounded-circle mb-5" href="#"><img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="hugenerd" width="100" height="100" class="rounded-circle"></a>
        </div>

        <div class="col-md-3 col-md-3">
            <h2>Employer Name</h2>
            <span class="mr-4">Membership levels</span>
        </div>
        <div class="col-md-3 col-md-3"></div>

        <div class="col-md-5 col-md-3">
            <div class="d-inline" >
                <h2 class="pl-4">Status <button class="btn btn-primary m-2">Active</button></h2>

        </div>

        </div>

    </div>
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <label for="profile_img"><svg  style="background-color: #09F;margin:5px;" width="32" height="32" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.17 11.053L11.18 15.315C10.8416 15.6932 10.3599 15.9119 9.85236 15.9178C9.34487 15.9237 8.85821 15.7162 8.51104 15.346C7.74412 14.5454 7.757 13.2788 8.54004 12.494L13.899 6.763C14.4902 6.10491 15.3315 5.72677 16.2161 5.72163C17.1006 5.71649 17.9463 6.08482 18.545 6.736C19.8222 8.14736 19.8131 10.2995 18.524 11.7L12.842 17.771C12.0334 18.5827 10.9265 19.0261 9.78113 18.9971C8.63575 18.9682 7.55268 18.4695 6.78604 17.618C5.0337 15.6414 5.07705 12.6549 6.88604 10.73L12.253 5" stroke="#ffffff" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>Attach Img</label>
                     <input type="file" class="" name="avatar" style="display: none;" accept="image/*" name="profile_picture" id="profile_img">
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="d-inline p-3 m-3">
                    <button class="btn active_btn">Profile Information</button>
                    <button class="btn border">Payment Info</button>
                    <button class="btn border">Change password</button>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row p-3">
            <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" id="">
            </div>
            <div class="col-md-3">
                <input type="tel" name="phone" class="form-control" placeholder="Phone" id="">
            </div>
            <div class="col-md-3">
                <select name="gender" class="form-select" id="gender">
                    <option value="">Gender</option>
                    <option value="">Male</option>
                    <option value="">Female</option>
                </select>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-12">
                    <input type="text" name="address" class="form-control" placeholder="Address" id="">
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-4">
                    <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" id="">
            </div>
            <div class="col-md-4">
                <select name="country" class="form-select" id="country">
                    <option value="">Country</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="city" class="form-select" id="city" >
                    <option value="">City</option>
                </select>
            </div>

        </div>
        <div class="row p-3">
            <div class="col-md-12">
                    <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="About"></textarea>
            </div>

        </div>
        <div class="row p-3">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary" style="background-color: #09F;">Update Information</button>
            </div>
        </div>
    </form>
<br>
<br>
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="d-inline p-3 m-3">
                    <button class="btn border" >Profile Information</button>
                    <button class="btn border">Payment Info</button>
                    <button class="btn active_btn ">Change password</button>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-md-4">
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password" id="">
            </div>
            <div class="col-md-4">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="">
            </div>
        </div>
        <div class="row p-3">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary" style="background-color: #09F;">Update Information</button>
            </div>
        </div>

    </form>

</div>
@endsection


