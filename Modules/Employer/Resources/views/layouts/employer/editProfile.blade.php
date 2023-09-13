@extends('dashboard::layouts.employer.master')
@section('content')
    <link id="pagestyle" href="{{asset('assets/css/panel/avatar-uploade.css')}}" rel="stylesheet"/>

    <div class="page-header min-height-300 border-radius-xl mt-4 "
         style="background-image:url({{asset('assets/img/curved-images/curved0.jpg')}}) ; background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>

    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n12 overflow-hidden">
        <div class="row profile-row">
                <div class="task-details-info task-sections">
                    <div class="task-details-table d-flex flex-wrap justify-content-between">
                        <h3 class="profile-info">{{trans('employer::employer.personalInformationDetails')}}</h3>

                        <div class="col-12 d-flex flex-wrap">
                            <table class="inherit-container-width col-8">

                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.Name')}}</td>
                                    <td class="table-details text-uppercase">

                                        <div class="col-12 relative">
                                            <input type="email" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.Name')}}" name="name" required value="{{$employer->name}}">
                                            <img src="{{asset('assets/img/name.png')}}" class="input_img" width="20" style="width: 28px!important; left: 25px!important;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.country')}}</td>
                                    <td class="table-details">
                                        @if($employer->country !=null)
                                            {{$employer->country->name}}
                                        @else
                                            <div class="col-md-12 relative">
                                                <select class="form-select" aria-label="Default select example" name="country" required
                                                        id="country-dropdown">
                                                    <option class="text-primary">{{trans('dashboard::auth.select_country')}}</option>
                                                    @if(count($countries) > 0)
                                                        @if(app()->getLocale() == "ar")
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->ar_name}}</option>
                                                            @endforeach
                                                        @else
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        <option>{{trans('dashboard::auth.NoCountryFound')}}</option>

                                                    @endif
                                                </select>
                                                <img src="{{asset('assets/img/default/map.png')}}" class="input_img" width="20">

                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.city')}}</td>
                                    <td class="table-details">
                                        @if($employer->city !=null)
                                            {{$employer->city->name}}
                                        @else
                                            <div class="col-md-12 relative">
                                                <select class="form-select" aria-label="Default select example" name="city" required
                                                        id="city-dropdown">
                                                    <option value="">{{trans('dashboard::auth.select_city')}}</option>
                                                </select>
                                                <img src="{{asset('assets/img/default/home.png')}}" class="input_img" width="20">

                                            </div>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.phone')}}</td>
                                    <td class="table-details">

                                        @if($employer->phone !=null)
                                            {{$employer->phone}}
                                        @else
                                            <div class="col-12 relative">
                                                <input type="tel" class="form-control input-lg inputPlaceholder"
                                                       placeholder="{{trans('employer::signIn.phone')}}" name="phone" required value="{{$employer->phone}}">
                                                <img src="{{asset('assets/img/default/phone.png')}}" class="input_img" width="20">
                                            </div>
                                        @endif


                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.address')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.address')}}" name="address" required value="{{$employer->address}}">
                                            <img src="{{asset('assets/img/address.png')}}" class="input_img" width="20">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.zip_code')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.zip_code')}}" name="zip_code" required value="{{$employer->zip_code}}">
                                            <img src="{{asset('assets/img/zipcode.png')}}" class="input_img" width="20">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.description')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.description')}}" name="description" required value="{{$employer->description}}">
                                            <img src="{{asset('assets/img/description.png')}}" class="input_img" width="20">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.gender')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <select class="form-select" aria-label="Default select example" name="registration_type"
                                                    required>
                                                @if($employer->gender == "male")
                                                    <option selected class="bg-primary"
                                                            value="male">{{trans('employer::employer.male')}}</option>
                                                    <option value="female">{{trans('employer::employer.female')}}</option>
                                                @elseif($employer->gender == "female")
                                                    <option selected class="bg-primary"
                                                            value="female">{{trans('employer::employer.female')}}</option>
                                                    <option value="male">{{trans('employer::employer.male')}}</option>
                                                @else
                                                    <option value="female">{{trans('employer::employer.female')}}</option>
                                                    <option value="male">{{trans('employer::employer.male')}}</option>
                                                @endif
                                            </select>
                                            <img src="{{asset('assets/img/default/type.png')}}" class="input_img" width="20">

                                        </div>
                                    </td>
                                </tr>
                              <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.New Password')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <input type="password" class="form-control inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.New Password')}}" name="new_password" required
                                                   id="password">
                                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput" width="16">

                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.Confirm Password')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <input type="password" class="form-control inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.Confirm Password')}}"
                                                   name="password_confirmation" required id="confirm-password">
                                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput1" width="16">
                                        </div>

                                    </td>
                                </tr>






                            </table>
                            <div class="inherit-container-width col-4">
                                <div class="row gx-4">

                                    <div class="col-auto">
                                        <div class="personal-image">
                                            @if($employer->google_id == null)
                                                <label class="label">
                                                    <input name="avatar" type="file" accept="image/*"
                                                           onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                    <figure class="personal-figure">

                                                        @if(isset($employer->avatar))
                                                            <img class="radius" id="output" src="{{Storage::url($employer->avatar)}}"
                                                                 width="120" height="120">
                                                        @else
                                                            <img class="radius" id="output" src="{{$default_avatar??''}}" width="120"
                                                                 height="120">
                                                        @endif
                                                        <figcaption class="personal-figcaption" style="text-align: center">
                                                            <img
                                                                src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                                        </figcaption>
                                                    </figure>
                                                </label>
                                            @else
                                                <img src="{{$employer->avatar}}"
                                                     class="w-100 border-radius-lg shadow-sm" alt="avatar">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h5 class="mb-1">
                                                {{$employer->name}}
                                            </h5>
                                            <p class="mb-0 font-weight-bold text-sm">

                                                {{$employer->employer_number}} / {{trans('employer::employer.'.$employer->level->name)}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                                        <div class="nav-wrapper position-relative end-0">
                                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <style>
        .input_img {
            width: 22px;
            left: 30px;
            position: absolute;
            top: 47%;
            transform: translateY(-50%);

        }
        #togglePassword {
            position: absolute;
            top: 19px;
            left: 19px;
            color: #2aa9fe;
            font-size: 25px;
        }

    </style>
    <div class="card card-body blur shadow-blur mx-4 mt-n12 overflow-hidden">
        <form method="POST" action="{{route('employer.update.my.profile')}}"

              enctype="multipart/form-data">
            @csrf
            <div class="row gx-4">

                <div class="col-auto">
                    <div class="personal-image">
                        @if($employer->google_id == null)
                            <label class="label">
                                <input name="avatar" type="file" accept="image/*"
                                       onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                <figure class="personal-figure">

                                    @if(isset($employer->avatar))
                                        <img class="radius" id="output" src="{{Storage::url($employer->avatar)}}"
                                             width="120" height="120">
                                    @else
                                        <img class="radius" id="output" src="{{$default_avatar??''}}" width="120"
                                             height="120">
                                    @endif
                                    <figcaption class="personal-figcaption" style="text-align: center">
                                        <img
                                            src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                    </figcaption>
                                </figure>
                            </label>
                        @else
                            <img src="{{$employer->avatar}}"
                                 class="w-100 border-radius-lg shadow-sm" alt="avatar">
                        @endif
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$employer->name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">

                            {{$employer->employer_number}} / {{trans('employer::employer.'.$employer->level->name)}}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                        </ul>
                    </div>
                </div>

            </div>
            <div class="row gx-4">

                @if($errors->has('name'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('name') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('address'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('address') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('zip_code'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('zip_code') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('description'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('description') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('gender'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('gender') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                @if($errors->has('avatar'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('avatar') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->has('phone'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('phone') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('country'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('country') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('city'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('city') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('new_password'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('new_password') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->has('password_confirmation'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('password_confirmation') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label for="example-search-input"
                               class="form-control-label">{{trans('employer::employer.Name')}}</label>

                        <input class="form-control" placeholder="{{trans('employer::employer.Name')}}" name="name"
                               type="text" value="{{$employer->name}}" id="example-search-input">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">
                        <label for="example-email-input"
                               class="form-control-label">{{trans('employer::employer.Email')}}</label>

                        <input class="form-control" type="email" name="email"
                               placeholder="{{trans('employer::employer.Email')}}" value="{{$employer->email}}"
                               id="example-email-input" disabled>
                    </div>


                    @if($employer->google_id !=null and $employer->phone ==null and $employer->country_id == null and $employer->city_id == null )
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="example-url-input"
                                   class="form-control-label">{{trans('employer::employer.country')}}</label>
                            <select id="country-dropdown" name="country"
                                    class="form-control font-elmessiry"
                                    required>
                                <option>{{trans('employer::signIn.pleas_select_your_country')}}</option>
                                @if(count($countries) > 0)
                                    @if(app()->getLocale() == "ar")
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}">{{$country->ar_name}}</option>
                                        @endforeach
                                    @else
                                        @foreach($countries as $country)
                                            <option
                                                value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    @endif
                                @else
                                    <option>{{trans('employer::signIn.NoCountryFound')}}</option>

                                @endif

                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="example-url-input"
                                   class="form-control-label">{{trans('employer::employer.city')}}</label>

                            <select name="city" id="city-dropdown" required
                                    class=" form-control font-elmessiry">
                                <option>{{trans('employer::signIn.pleas_select_country_to_fetch_cities')}}</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 col-lg-4">
                            <label for="example-url-input"
                                   class="form-control-label">{{trans('employer::employer.Mobile')}}</label>

                            <input name="phone" id="CallingCode" value="" type="text" class="form-control"
                                   placeholder="{{trans('employer::signIn.phone')}}"
                                   aria-label="phone" aria-describedby="phone-addon" required>
                        </div>
                    @endif

                    <div class="form-group  col-sm-12 col-md-6 col-lg-4">
                        <label for="example-url-input"
                               class="form-control-label">{{trans('employer::employer.address')}}</label>

                        <input class="form-control" type="text" placeholder="{{trans('employer::employer.address')}}"
                               name="address" value="{{$employer->address}}"
                               id="example-url-input">
                    </div>
                    <div class="form-group  col-sm-12 col-md-6 col-lg-2">
                        <label for="example-url-input"
                               class="form-control-label">{{trans('employer::employer.zip_code')}}</label>

                        <input class="form-control" type="text" placeholder="{{trans('employer::employer.zip_code')}}"
                               name="zip_code" value="{{$employer->zip_code}}"
                               id="example-url-input">
                    </div>
                    <div class="form-group  col-sm-12 col-md-6 col-lg-6">
                        <label for="example-url-input"
                               class="form-control-label">{{trans('employer::employer.description')}}</label>

                        <input class="form-control" type="text"
                               placeholder="{{trans('employer::employer.description')}}"
                               name="description" value="{{$employer->description}}"
                               id="example-url-input">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-4">

                        <label for="example-url-input"
                               class="form-control-label">{{trans('employer::employer.gender')}}</label>
                        <select name="gender"
                                class="form-control"
                                required>
                            <option>{{trans('employer::employer.pleas_select_your_gender')}}</option>
                            @if($employer->gender == "male")
                                <option selected class="bg-primary"
                                        value="male">{{trans('employer::employer.male')}}</option>
                                <option value="female">{{trans('employer::employer.female')}}</option>
                            @elseif($employer->gender == "female")
                                <option selected class="bg-primary"
                                        value="female">{{trans('employer::employer.female')}}</option>
                                <option value="male">{{trans('employer::employer.male')}}</option>
                            @else
                                <option value="female">{{trans('employer::employer.female')}}</option>
                                <option value="male">{{trans('employer::employer.male')}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="example-password-input"
                               class="form-control-label">{{trans('employer::employer.New Password')}}<span
                                class="text-primary"
                                style="font-size: 9px">{{trans('employer::employer.If you want to change your password, fill in this field')}}</span></label>
                        <input class="form-control" type="password" name="new_password" value=""
                               id="example-password-input">
                    </div>
                    <div class="form-group col-sm-12 col-md-6 col-lg-6">
                        <label for="example-password-input"
                               class="form-control-label">{{trans('employer::employer.Confirm Password')}}</label>
                        <input class="form-control" name="password_confirmation"
                               placeholder="{{trans('employer::employer.Confirm Password')}}" type="password" value=""
                               id="example-password-input">
                    </div>
                </div>

            </div>
            <button type="submit"
                    class="btn bg-gradient-primary w-100 mt-4 mb-0">{{trans('employer::employer.UpdateMyProfile')}}</button>
        </form>

        <div class="row">
            <a href="{{route('employer.show.my.profile')}}"
               class="btn bg-gradient-secondary w-100 mt-4 mb-0">{{trans('employer::employer.back')}}</a>

        </div>

    </div>


    @if($employer->google_id !=null and $employer->phone ==null and $employer->country_id == null and $employer->city_id == null)
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--fetch city by country-->
        <script>
            $(document).ready(function () {
                $('#country-dropdown').on('change', function () {
                    var idCountry = this.value;
                    $("#city-dropdown").html('');
                    $.ajax({
                        url: "{{route('employer.fetch.cities.when.update.profile')}}",
                        type: "POST",
                        data: {
                            country_id: idCountry,
                            _token: '{{csrf_token()}}'
                        },
                        dataType: 'json',
                        success: function (result) {
                            $('#city-dropdown').html('<option class="text-primary" value="">{{trans('employer::signIn.pleas select your city')}}</option>');
                            @if(app()->getLocale()=="ar")
                            $.each(result.cities, function (key, value) {
                                $("#city-dropdown").append('<option value="' + value
                                    .id + '">' + value.ar_name + '</option>');
                            });
                            @else
                            $.each(result.cities, function (key, value) {
                                $("#city-dropdown").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            @endif
                            // console.log(result['phone'].calling_code);
                            // var phone = document.getElementById("CallingCode").value;
                            document.getElementById("CallingCode").value = result['phone'].calling_code;
                            // phone = result['phone'].calling_code;
                            // $('#phone').innerText(result['phone'].calling_code);

                        }
                    });
                });
            });
        </script>
    @endif
@stop
