@extends('dashboard::layouts.worker.master')
@section('content')
    <link id="pagestyle" href="{{asset('assets/css/panel/avatar-uploade.css')}}" rel="stylesheet"/>

    <div class="page-header min-height-300 border-radius-xl mt-4 "
         style="background-image:url({{asset('assets/img/curved-images/curved0.jpg')}}) ; background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>

    </div>
    <div class="card card-body blur shadow-blur overflow-hidden">
        @if($errors->has('name'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('name') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('address'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('address') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('zip_code'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('zip_code') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('description'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('description') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('gender'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('gender') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif


        @if($errors->has('avatar'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('avatar') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif

        @if($errors->has('paypal_account'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('paypal_account') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('phone'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('phone') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('country'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('country') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('city'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('city') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('new_password'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('new_password') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        @if($errors->has('password_confirmation'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('password_confirmation') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>
        @endif
        <div class="row profile-row">
            <h3 class="profile-info">{{trans('employer::employer.personalInformationDetails')}}</h3>
            <div class="task-details-info task-sections">
                <div class="task-details-table d-flex flex-wrap justify-content-between">
                    <form class="w-100" method="POST" action="{{route('worker.update.my.profile')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 d-flex flex-wrap justify-content-between">
                            <div class="inherit-container-width col-lg-5 col-md-5 col-12">
                                <div class="row gx-4 flex-wrap justify-content-center">
                                    <div class="col-auto">
                                        <div class="personal-image">
                                            @if($worker->google_id == null)
                                                <label class="label">
                                                    <input name="avatar" type="file" accept="image/*"
                                                           onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                                    <figure class="personal-figure">

                                                        @if(isset($worker->avatar))
                                                            <img class="radius" id="output"
                                                                 src="{{Storage::url($worker->avatar)}}"
                                                                 width="120" height="120">
                                                        @else
                                                            <img class="radius" id="output"
                                                                 src="{{$default_avatar}}"
                                                                 width="120"
                                                                 height="120">
                                                        @endif
                                                        <figcaption class="personal-figcaption"
                                                                    style="text-align: center">
                                                            <img
                                                                src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                                        </figcaption>
                                                    </figure>
                                                </label>
                                            @else
                                                <img src="{{$worker->avatar}}"
                                                     class="w-100 border-radius-lg shadow-sm" alt="avatar">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-auto my-auto">
                                        <div class="h-100">
                                            <h5 class="mb-1 text-uppercase">
                                                {{$worker->name}}
                                            </h5>
                                            <p class="mb-0 font-weight-bold text-sm text-purple">

                                                {{$worker->worker_number}}
                                                / {{trans('employer::employer.'.$worker->level->name)}}
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row gx-4 flex-wrap justify-content-center">
                                    <div class="col-lg-12">
                                        <div class="row mt-4">
                                            <div class="col-12 my-2">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <div class="numbers mx-3">
                                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::employer.wallet_balance')}}</p>
                                                                    <h5 class="font-weight-bolder text-primary mb-0">
                                                                        {{ number_format(convertCurrency($worker->wallet_balance, $worker->current_currency),2) }}
                                                                        <span
                                                                            class="text-xxs">{{$worker->current_currency}}</span>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-start">
                                                                <i class="ni ni-credit-card text-2rem text-primary opacity-10"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="col-12 my-2">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <div class="numbers mx-3">
                                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::workers.worker_level')}}</p>
                                                                    <h5 class="font-weight-bolder text-primary mb-0">
                                                                        <span
                                                                            class="text-lg worker_level_{{$worker->level->name}}">{{trans('worker::worker.'.$worker->level->name)}}</span>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-start">
                                                                <i class="fa fa-gauge-high text-2rem text-primary opacity-10"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 my-2">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <div class="numbers mx-3">
                                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('employer::employer.employer_privileges')}}</p>
                                                                    <h5 class="font-weight-bolder text-primary mb-0">
                                                                        <a class="text-secondary"
                                                                           href="#">{{array_sum($total)}}</a>

                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-start">
                                                                <i class="ni ni-diamond text-2rem text-primary opacity-10"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 my-2">
                                                <div class="card">
                                                    <div class="card-body p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-8">
                                                                <div class="numbers mx-3">
                                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::employer.employer_status')}}</p>
                                                                    @if($worker->status == "enable")
                                                                        <h5 class="font-weight-bolder  {{"text_worker_".$worker->status}} mb-0">
                                                                            {{trans('admin::employer.'.$worker->status)}}
                                                                        </h5>
                                                                    @else
                                                                        <h6 class="font-weight-bolder  {{"text_worker_".$worker->status}} mb-0">
                                                                            {{trans('admin::employer.'.$worker->status)}}
                                                                            ({{$worker->suspend_days}} {{trans('employer::employer.suspend_days')}}
                                                                            )
                                                                        </h6>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-start">
                                                                <i class="ni ni-ui-04 text-2rem text-primary opacity-10"
                                                                   aria-hidden="true"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="inherit-container-width col-lg-7 col-md-7 col-12">
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.Name')}}</td>
                                    <td class="table-details text-uppercase">

                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.Name')}}" name="name"
                                                   required
                                                   value="{{$worker->name}}">
                                            <img src="{{asset('assets/img/name.png')}}" class="input_img" width="20"
                                                 style="width: 28px!important; left: 6px!important;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('worker::worker.paypal')}}</td>
                                    <td class="table-details text-uppercase">

                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('worker::worker.paypal')}}" name="paypal_account"
                                                   required
                                                   value="{{$worker->paypal_account}}">
                                            <img src="{{asset('assets/img/paypal.png')}}" class="input_img" width="20"
                                                 style="width: 28px!important; left: 6px!important;">
                                        </div>
                                    </td>
                                </tr>

                                @if($worker->google_id !=null and $worker->phone ==null and $worker->country_id == null and $worker->city_id == null )
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.country')}}</td>
                                    <td class="table-details">
                                        @if($worker->country !=null)
                                            {{$worker->country->name}}
                                        @else
                                            <div class="col-md-12 relative">
                                                <select class="form-select" aria-label="Default select example"
                                                        name="country" required
                                                        id="country-dropdown">
                                                    <option
                                                        class="text-primary">{{trans('dashboard::auth.select_country')}}</option>
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
                                                        <option>{{trans('dashboard::auth.NoCountryFound')}}</option>

                                                    @endif
                                                </select>
                                                <img src="{{asset('assets/img/default/map.png')}}" class="input_img"
                                                     width="20">

                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.city')}}</td>
                                    <td class="table-details">
                                        @if($worker->city !=null)
                                            {{$worker->city->name}}
                                        @else
                                            <div class="col-md-12 relative">
                                                <select class="form-select" aria-label="Default select example"
                                                        name="city"
                                                        required
                                                        id="city-dropdown">
                                                    <option value="">{{trans('dashboard::auth.select_city')}}</option>
                                                </select>
                                                <img src="{{asset('assets/img/default/home.png')}}" class="input_img"
                                                     width="20">

                                            </div>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.phone')}}</td>
                                    <td class="table-details">

                                        @if($worker->phone !=null)
                                            {{$worker->phone}}
                                        @else
                                            <div class="col-12 relative">
                                                <input type="text" class="form-control input-lg inputPlaceholder"
                                                       placeholder="{{trans('employer::signIn.phone')}}" id="CallingCode" name="phone"
                                                       required value="{{$worker->phone}}">
                                                <img src="{{asset('assets/img/default/phone.png')}}" class="input_img"
                                                     width="20">
                                            </div>
                                        @endif


                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.address')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.address')}}" name="address"
                                                   required value="{{$worker->address}}">
                                            <img src="{{asset('assets/img/address.png')}}" class="input_img" width="20">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.zip_code')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.zip_code')}}"
                                                   name="zip_code"
                                                   required value="{{$worker->zip_code}}">
                                            <img src="{{asset('assets/img/zip-code.png')}}" class="input_img"
                                                 width="20">
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.description')}}</td>
                                    <td class="table-details col-8">
                                        <div class="col-12 relative">
                                            <input type="text" class="form-control input-lg inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.description')}}"
                                                   name="description"  value="{{$worker->description}}" required>
                                            <img src="{{asset('assets/img/description.png')}}" class="input_img"
                                                 width="20" >
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.gender')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <select class="form-select" aria-label="Default select example"
                                                    name="gender"
                                                    required>
                                                @if($worker->gender == "male")
                                                    <option selected class="bg-primary"
                                                            value="male">{{trans('employer::employer.male')}}</option>
                                                    <option
                                                        value="female">{{trans('employer::employer.female')}}</option>
                                                @elseif($worker->gender == "female")
                                                    <option selected class="bg-primary"
                                                            value="female">{{trans('employer::employer.female')}}</option>
                                                    <option value="male">{{trans('employer::employer.male')}}</option>
                                                @else
                                                    <option
                                                        value="female">{{trans('employer::employer.female')}}</option>
                                                    <option value="male">{{trans('employer::employer.male')}}</option>
                                                @endif
                                            </select>
                                            <img src="{{asset('assets/img/gender.png')}}" class="input_img" width="20">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.New Password')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <input type="password" class="form-control inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.New Password')}}"
                                                   name="new_password"
                                                   id="password">
                                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput"
                                                 width="16">

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.Confirm Password')}}</td>
                                    <td class="table-details">
                                        <div class="col-md-12 relative">
                                            <input type="password" class="form-control inputPlaceholder"
                                                   placeholder="{{trans('employer::employer.Confirm Password')}}"
                                                   name="password_confirmation" id="confirm-password">
                                            <img src="{{asset('assets/img/pass.png')}}" class="input_img" id="myInput1"
                                                 width="16">
                                        </div>

                                    </td>
                                </tr>


                            </table>
                        </div>
                        <button type="submit"
                                class="btn bg-gradient-primary text-white w-100 mt-4 mb-0">{{trans('employer::employer.UpdateMyProfile')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        .input_img {
            width: 22px;
            left: 10px;
            position: absolute;
            top: 47%;
            transform: translateY(-50%);

        }

    </style>

    @if($worker->google_id !=null and $worker->phone ==null and $worker->country_id == null and $worker->city_id == null)
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--fetch city by country-->
        <script>
            $(document).ready(function () {
                $('#country-dropdown').on('change', function () {
                    var idCountry = this.value;
                    $("#city-dropdown").html('');
                    $.ajax({
                        url: "{{route('worker.fetch.cities.when.update.profile')}}",
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
                            document.getElementById("CallingCode").value = result['phone'].calling_code;
                        }
                    });
                });
            });
        </script>
    @endif

@stop
