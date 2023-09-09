@extends('dashboard::layouts.employer.master')
@section('content')
    <div class="container-fluid">

        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative ">
                    @if($employer->google_id == null)
                        @if($employer->avatar != Null)
                            <img src="{{Storage::url($employer->avatar)}}" class="w-100 border-radius-lg shadow-sm"
                                 alt="avatar">
                        @else
                            <img src="{{asset('assets/img/default/default-avatar.svg')}}"
                                 class="w-100 border-radius-lg shadow-sm" alt="avatar">
                        @endif
                    @else
                        <img src="{{$employer->avatar}}"
                             class="w-100 border-radius-lg shadow-sm" alt="avatar">
                    @endif
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1 text-uppercase">
                      {{$employer->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        <span class="mb-0 font-weight-bold text-sm text-primary">{{trans('admin::employer.Joined_at')}}: {{$employer->created_at->format('d-m-Y')}}</span>
                    </p>
                </div>
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers mx-3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::employer.wallet_balance')}}</p>
                                    <h5 class="font-weight-bolder text-primary mb-0">
                                        {{ number_format(convertCurrency($employer->wallet_balance, $employer->current_currency),2) }}
                                        <span class="text-xxs">{{$employer->current_currency}}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-3 text-start">
                                <i class="ni ni-credit-card text-2rem text-primary opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers mx-3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::employer.total_spends')}}</p>
                                    <h5 class="font-weight-bolder text-primary mb-0">
                                        {{ number_format(convertCurrency($employer->total_spends, $employer->current_currency),2) }}
                                        <span class="text-xxs">{{$employer->current_currency}}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-3 text-start">
                                <i class="ni ni-money-coins text-2rem text-success opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers mx-3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('employer::employer.employer_privileges')}}</p>
                                    <h5 class="font-weight-bolder text-primary mb-0">
                                        <a class="text-secondary" href="#">  {{array_sum($total)}}</a>

                                    </h5>
                                </div>
                            </div>
                            <div class="col-3 text-start">
                                <i class="ni ni-diamond text-2rem text-info opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-3 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="numbers mx-3">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('admin::employer.employer_status')}}</p>
                                    @if($employer->status == "enable")
                                        <h5 class="font-weight-bolder  {{"text_worker_".$employer->status}} mb-0">
                                            {{trans('admin::employer.'.$employer->status)}}
                                        </h5>
                                    @else
                                        <h6 class="font-weight-bolder  {{"text_worker_".$employer->status}} mb-0">
                                            {{trans('admin::employer.'.$employer->status)}}
                                            ({{$employer->suspend_days}} {{trans('employer::employer.suspend_days')}})
                                        </h6>
                                    @endif
                                </div>
                            </div>
                            <div class="col-3 text-start">
                                <i class="ni ni-ui-04 text-2rem text-primary opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Employer Profile Information --}}
        <div class="row profile-row">
            <div class="col-12">
                <div class="task-details-info task-sections">
                    <div class="task-details-table d-flex flex-wrap justify-content-between">
                        <div class="col-12 col-lg-6 col-md-6">
                            <h3 class="profile-info">{{trans('employer::employer.personalInformationDetails')}}</h3>
                            <table class="inherit-container-width">

                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.full_name')}}</td>
                                    <td class="table-details text-uppercase">{{$employer->name}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.email')}}</td>
                                    <td class="table-details">{{$employer->email}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.phone')}}</td>
                                    <td class="table-details">

                                        @if($employer->phone !=null)
                                            {{$employer->phone}}
                                        @else
                                            <span
                                                class="text-warning">{{trans('employer::employer.phone_not_set')}}</span>
                                        @endif


                                    </td>
                                </tr>

                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.country')}}</td>
                                    <td class="table-details">
                                        @if($employer->country !=null)
                                            {{$employer->country->name}}
                                        @else
                                            <span
                                                class="text-warning"> {{trans('employer::employer.country_not_set')}}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.city')}}</td>
                                    <td class="table-details">
                                        @if($employer->city !=null)
                                            {{$employer->city->name}}
                                        @else
                                            <span
                                                class="text-warning">{{trans('employer::employer.city_not_set')}}</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.gender')}}</td>
                                    <td class="table-details">{{trans('employer::employer.'.$employer->gender)}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.address')}}</td>
                                    <td class="table-details">
                                        @if($employer->address !=null)
                                            {{$employer->address}}
                                        @else
                                            <span
                                                class="text-warning">{{trans('employer::employer.addressNotSetYet')}}</span>
                                        @endif


                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.zip_code')}}</td>
                                    <td class="table-details">
                                        @if($employer->zip_code !=null)
                                            {{$employer->zip_code}}
                                        @else
                                            <span
                                                class="text-warning">{{trans('employer::employer.ZipCodeNotSetYet')}}</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.description')}}</td>
                                    <td class="table-details">
                                        @if($employer->description !=null)
                                            {{$employer->description}}
                                        @else
                                            <span
                                                class="text-warning">{{trans('employer::employer.ZipCodeNotSetYet')}}</span>
                                        @endif

                                    </td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6">
                            <h3 class="profile-info">{{trans('employer::employer.accountInformationDetails')}}</h3>
                            <table class="inherit-container-width">

                                <tr>
                                    <td class="name-td text-purple">{{trans('admin::employer.Joined_at')}}</td>
                                    <td class="table-details">{{$employer->created_at->format('d-m-Y')}}</td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.join_method')}}</td>
                                    <td class="table-details">

                                        @if($employer->google_id == null)
                                            <span>{{trans('employer::employer.joined_using_signup_form')}}</span>
                                        @else
                                            <span>{{trans('employer::employer.joined_using_google_account')}}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.wallet_balance')}}</td>
                                    <td class="table-details">
                                        {{ number_format(convertCurrency($employer->wallet_balance, $employer->current_currency),2) }}
                                        <span class="text-xxs">{{$employer->current_currency}}</span>

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.total_spends')}}</td>
                                    <td class="table-details">
                                        {{ number_format(convertCurrency($employer->total_spends, $employer->current_currency),2) }}
                                        <span class="text-xxs">{{$employer->current_currency}}</span>

                                    </td>
                                </tr>

                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.count_of_employer_privileges')}}</td>
                                    <td class="table-details">
                                        {{array_sum($total)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.employer_status')}}</td>
                                    <td class="table-details">
                                        @if($employer->status == "enable")
                                            <h5 class="font-weight-bolder  {{"text_worker_".$employer->status}} mb-0">
                                                {{trans('admin::employer.'.$employer->status)}}
                                            </h5>
                                        @else
                                            <h6 class="font-weight-bolder  {{"text_worker_".$employer->status}} mb-0">
                                                {{trans('admin::employer.'.$employer->status)}}
                                                ({{$employer->suspend_days}} {{trans('employer::employer.suspend_days')}}
                                                )
                                            </h6>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.default_currency')}}</td>
                                    <td class="table-details">
                                        {{$employer->current_currency}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.is_email_verified')}}</td>
                                    <td class="table-details">
                                        @if($employer->email_verified_at == null)
                                            <a class="text-warning"
                                               href="#">{{trans('employer::employer.Not confirmed yet, click here to confirm')}}</a>
                                        @else
                                            <span
                                                class=" text-success">  {{trans('employer::employer.EmailVerifiedAt:')}} {{$employer->email_verified_at}}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-td text-purple">{{trans('employer::employer.is_mobile_verified')}}</td>
                                    <td class="table-details">
                                        @if($employer->mobile_verified_at == null)

                                            <a class="text-warning"
                                               href="#">{{trans('employer::employer.Not confirmed yet, click here to confirm')}}</a>
                                        @else
                                            <span
                                                class=" text-success">{{trans('employer::employer.EmailVerifiedAt:')}}{{$employer->mobile_verified_at}}</span>

                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="profile-info">{{trans('employer::employer.EmployerTaskDetails')}}</h3>
        <div class="card-body px-0 pb-0 bg-white">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-list">
                    <thead class="thead-light">
                    <tr class="bg-table">
                        <th> #</th>
                        <th>{{trans('admin::employer.taskDetails')}}</th>
                        <th>{{trans('admin::employer.taskStatus')}}</th>
                        <th>{{trans('admin::employer.taskContOfWorker')}}</th>
                        <th>{{trans('admin::employer.taskTotalCost')}}</th>
                        <th>{{trans('admin::employer.taskEndTime')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($tasks) and $tasks->count()>0)
                        @for($i=0;$i<count($tasks) ;$i++)
                            <tr>
                                <td class="align-middle text-center"> {{$i+1}} </td>
                                <td class="text-center align-middle text-center">
                                    <div class="d-flex justify-content-center px-2 py-1">
                                        <div>
                                            @if($tasks[$i]->category->image != Null)
                                                <img src="{{Storage::url($tasks[$i]->category->image)}}"
                                                     class="avatar avatar-sm me-3" alt="category icon">
                                            @else
                                                <img
                                                    src="{{asset('assets/img/category/'.$tasks[$i]->category->title.'.png')}}"
                                                    class="avatar avatar-sm me-3" alt="category icon">
                                            @endif
                                        </div>
                                        <div class="d-flex mx-3 flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$tasks[$i]->task_number}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::words($tasks[$i]->title, 3,'...')}}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center text-sm">
                                    @if($tasks[$i]->TaskStatuses()->count()>=1)
                                        <span
                                            class="badge badge-sm {{'task_'.$tasks[$i]->TaskStatuses()->with('status')->latest()->first()->status->name}} ">{{trans('employer::task.task_'.$tasks[$i]->TaskStatuses()->with('status')->latest()->first()->status->name)}} {{$tasks[$i]->TaskStatuses()->latest()->first()->updated_at->diffForHumans()}}</span>
                                    @else
                                        <span
                                            class="badge badge-sm {{'task_UnPublished'}} ">{{trans('employer::task.task_UnPublished')}} {{$tasks[$i]->updated_at->diffForHumans()}}</span>
                                    @endif
                                </td>

                                <td class="text-sm text-center">{{$tasks[$i]->total_worker_limit}}</td>

                                <td class="text-sm text-center">
                                    {{ number_format(convertCurrency($tasks[$i]->total_cost, $employer->current_currency),2) }}
                                    <span class="text-xxs">{{$employer->current_currency}}</span>
                                </td>

                                <td class="text-sm text-center">{{$tasks[$i]->task_end_date}}</td>
                            </tr>
                        @endfor
                    @else
                        <td colspan="8">
                            <div class="text-danger text-center">{{trans('admin::employer.NoDataFound')}}</div>
                        </td>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>

    </div>


@endsection

