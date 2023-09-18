@extends('dashboard::layouts.employer.master')
@section('content')
    <style>
        .last-ch:last-child {
            display: none;
        }
        .decuration {
            text-decoration-color: white;
            text-decoration-line: line-through;
            text-decoration-thickness: 2px;
        }
    </style>
    @if($errors->has('new_minimum_cost_per_worker'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('new_minimum_cost_per_worker') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row col-lg-12 col-sm-12">
        <div class="col-lg-6 col-sm-12 mb-2 ">
            <div class="card">
                <div class="card-header p-3 pb-0">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div>
                                <img src="{{Storage::url($task->category->image)}}"
                                     class="avatar avatar-xl me-2"
                                     alt="avatar image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-lg">{{trans("employer::task.task_category")}}</h6>
                                <p class="text-xl">{{$task->category->title}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="horizontal dark">
                <div class="card-body p-3 pt-1">
                    <h6>{{trans("employer::task.task_title")}}</h6>
                    <p class="text-sm"> {{$task->title}}</p>
                </div>
                <hr class="horizontal dark">
                <div class="card-body p-3 pt-1">
                    <h6>{{trans("employer::task.task_description")}}</h6>
                    <p class="text-sm">{{$task->description}}</p>
                </div>
                <hr class="horizontal dark">
                <div class="card-body pt-0">
                    <h6>{{trans('employer::task.category_actions')}}</h6>
                    @if(app()->getLocale() == "ar")
                    @for($i=0;$i<count($task->actions);$i++)
                        <div class="d-flex align-items-center">
                            <div class="text-center mx-2 w-5">
                                <img src="{{asset('assets/img/default/action.png')}}" class="avatar-sm" alt="Actions">
                            </div>
                            <div class="my-auto ms-3">
                                <div class="h-100">
                                    <p class="text-sm mb-1">
                                        {{$task->actions[$i]->categoryAction->ar_name}}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('employer::task.action_enable')}}</span>
                        </div>
                        <hr class="horizontal dark last-ch">
                    @endfor
                    @else
                        @for($i=0;$i<count($task->actions);$i++)
                            <div class="d-flex align-items-center">
                                <div class="text-center mx-2 w-5">
                                    <img src="{{asset('assets/img/default/action.png')}}" class="avatar-sm" alt="Actions">
                                </div>
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <p class="text-sm mb-1">
                                            {{$task->actions[$i]->categoryAction->name}}
                                        </p>
                                    </div>
                                </div>
                                <span
                                    class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('employer::task.action_enable')}}</span>
                            </div>
                            <hr class="horizontal dark last-ch">
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 ">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">{{trans('employer::task.TaskRegion')}}</h6>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group list-group-flush list my--3">
                        @for($i=0;$i<count($result);$i++)
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                                    <div class="col-auto">

                                        <img src="{{Storage::url($result[$i]['flag'])}}" class="avatar-sm"
                                             alt="Country flag">
                                    </div>
                                    <div class="col">
                                        <h6 class="text-sm mb-0">{{$result[$i]['country']}}</h6>
                                    </div>
                                    <div class="col text-center">
                                        <ul class="font-elmessiry">
                                            @if(is_array($result[$i]['cities']))
                                                <ul>
                                                    @if($app_local == "ar")
                                                        @for($j=0;$j<count($result[$i]['cities']);$j++)
                                                            <li> {{\Modules\Region\Entities\City::withoutTrashed()->find($result[$i]['cities'][$j])->ar_name}} </li>
                                                        @endfor
                                                    @else
                                                        <li> {{\Modules\Region\Entities\City::withoutTrashed()->find($result[$i]['cities'][$j])->name}} </li>

                                                    @endif
                                                </ul>

                                            @else
                                                <span
                                                    class="text-primary">{{trans('employer::task.all_city_in:').$result[$i]['country']}}</span>
                                            @endif
                                        </ul>
                                    </div>
                                </div>

                            </li>
                            <hr class="horizontal dark mt-3 mb-1 last-ch">
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header bg-transparent pb-0">
                    <h6 class="">{{trans('employer::task.TaskWorkFlow')}}</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side" data-timeline-axis-style="dashed">
                        @for($i=0;$i<count($task->workflows);$i++)
                            <div class="timeline-block mb-3">
                            <span class="timeline-step bg-light">
                            <i class="ni ni-ui-04 text-success text-gradient"></i>
                            </span>
                                <div class="timeline-content">
                                    <h6 class=" text-sm font-weight-bold mb-0">{{trans('employer::task.steep_number: ')}}{{$i+1}}</h6>
                                    <p class=" text-sm mt-3 mb-2">
                                        {{$task->workflows[$i]->work_flow}}
                                    </p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 mx-lg-4 mx-sm-0 col-lg-6 col-sm-12">
            <div class="card-body p-3">
                <div class="d-flex">
                    <div class="avatar mx-2 avatar-lg">
                        <img class="" alt="Image placeholder" src="{{asset('assets/img/default/asking.png')}}">
                    </div>
                    <div class="ms-2 my-auto">
                        <h6 class="mb-0">{{trans('employer::task.question_as_worker')}}</h6>
                    </div>
                </div>
                @if($task->proof_request_ques == null)
                    <p class="mt-3 text-danger"> {{trans('employer::task.not_proof_request_ques')}} </p>
                @else
                    <p class="mt-3"> {{$task->proof_request_ques}}</p>
                @endif

                <hr class="horizontal dark">
                <div class="d-flex">
                    <div class="avatar mx-2 avatar-lg">
                        <img alt="Image placeholder" src="{{asset('assets/img/default/screenshot-2.png')}}">
                    </div>
                    <div class="ms-2 my-auto">
                        <h6 class="mb-0">{{trans('employer::task.screenshot_as_worker')}}</h6>
                    </div>
                </div>
                @if($task->proof_request_screenShot == null)
                    <p class="mt-3 text-danger"> {{trans('employer::task.not_proof_request_screenShot')}} </p>
                @else
                    <p class="mt-3">{{$task->proof_request_screenShot }}</p>
                @endif

            </div>
        </div>
        <div class="card mt-4 mx-1 col-lg-5  ">
            <div class="card-header pb-3">
                <h5>{{trans('employer::task.Additional features')}}</h5>
            </div>
            <div class="card-body pt-0">
                <div class="d-flex align-items-center">
                    <div class="text-center mx-2 w-5">
                        <img src="{{asset('assets/img/default/onlyProfessional.png')}}" class="avatar-sm"
                             alt="professionalOnly">
                    </div>
                    <p class="my-auto ms-3">{{trans('employer::task.professionalOnly')}}</p>
                    @if($task->only_professional == "true")
                        <span
                            class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_enable')}}</span>
                    @else
                        <span
                            class="badge bg-gradient-danger badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_disable')}}</span>
                    @endif


                </div>
                <hr class="horizontal dark">
                <div class="d-flex align-items-center">
                    <div class="text-center mx-2 w-5">
                        <img src="{{asset('assets/img/default/taskFeatured.png')}}" class="avatar-sm"
                             alt="taskFeatured">
                    </div>
                    <p class="my-auto ms-3">{{trans('employer::task.pinTaskTop')}}</p>
                    @if($task->special_access == "true")
                        <span
                            class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_enable')}}</span>
                    @else
                        <span
                            class="badge bg-gradient-danger badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_disable')}}</span>
                    @endif

                </div>
                <hr class="horizontal dark">
                <div class="d-flex align-items-center">
                    <div class="text-center mx-2 w-5">
                        <img src="{{asset('assets/img/default/dailyLimit.png')}}" class="avatar-sm"
                             alt="worker_daily_limit">
                    </div>
                    @if($task->daily_limit == null)
                        <div class="my-auto ms-3">
                            <div class="h-100">
                                <p class="text-sm mb-1">
                                    {{trans('employer::task.worker_daily_limit')}}
                                </p>
                            </div>
                        </div>
                        <span
                            class="badge bg-gradient-danger badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_disable')}}</span>
                    @else
                        <div class="my-auto ms-3">
                            <div class="h-100">
                                <p class="text-sm mb-1">
                                    {{trans('employer::task.worker_daily_limit')}}
                                </p>
                                <p class="mb-0 text-xs">
                                    {{$task->daily_limit}}  {{trans('employer::task.worker_in_task')}}
                                </p>
                            </div>
                        </div>
                        <span
                            class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('employer::task.feather_enable')}}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card bg-gradient-light">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class=" text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('employer::task.task_end_date')}}</p>
                                <h5 class=" font-weight-bolder mb-0">
                                    {{trans('employer::task.after')}}  {{\Carbon\Carbon::parse($task->task_end_date)->diffForHumans()}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                <i class="ni ni-calendar-grid-58 text-dark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-md-0">
            <div class="card bg-gradient-light">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('employer::task.WalletBalance')}}</p>
                                <h5 class=" font-weight-bolder mb-0" id="wallet_balance">
                                    {{(auth()->user()->wallet_balance) - ($task->total_cost)}} <span>$</span>
{{--                                    {{ convertCurrency(auth()->user()->wallet_balance, auth()->user()->current_currency) - convertCurrency($task->total_cost, auth()->user()->current_currency) }}--}}
{{--                                    <span class="text-xxs">{{auth()->user()->current_currency}}</span>--}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                <i class="ni ni-credit-card text-dark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
            <div class="card bg-gradient-light">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class=" text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('employer::task.count_of_worker')}}</p>
                                <h5 class=" font-weight-bolder mb-0">
                                    {{$task->total_worker_limit}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                <i class="ni ni-user-run text-dark text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('employer.submit.and.save.task',[$task->id,$task->task_number])}}"
          enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-lg-6 col-sm-6 ">
                <div class="card bg-gradient-white">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="numbers mb-2">
                                    <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('employer::task.task_per_worker')}}
                                        <i
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            title="{{trans('employer::task.task_per_worker_warning')}}"

                                            class="ni ni-bell-55 text-sm text-info opacity-10" aria-hidden="true"></i>
                                    </p>
{{--                                    <p class="text-xs mb-0 text-capitalize text-info font-weight-bold">{{trans('employer::task.task_per_worker_warning')}}</p>--}}
                                </div>
                                <input class="multisteps-form__input form-control" step="0.01"
                                       value="{{$task->cost_per_worker}}" type="number"
                                       min="{{$task->cost_per_worker}}"
                                       name="new_minimum_cost_per_worker"
                                       id="minimum_cost_per_worker"
                                       placeholder="{{trans('employer::task.minimum_cost_per_worker')}}"
                                       onfocus="focused(this)"
                                       onfocusout="defocused(this)">
                            </div>
                            <div class="col-3 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-white mt-2" id="discountCard">
                    <div class="card-body p-3">
                        <div class="row align-items-center">
                            <div class="col-9">
                                <div class="numbers mb-2">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">{{trans('employer::task.discountCode')}}</p>
                                </div>
                                <div class="mt-2 d-lg-flex justify-content-between">
                                    <div class="col-12 col-md-7">
                                        <input class="multisteps-form__input form-control"
                                               type="text"
                                               id="discount_code"
{{--                                               name="discountCode"--}}
                                               placeholder="{{trans('employer::task.If you have a discount code, please enter it here')}}"
                                               onfocus="focused(this)"
                                               onfocusout="defocused(this)">
                                    </div>
                                    <div class="col-12 col-md-4 mt-2 mt-md-0">
                                        <a class=" btn bg-gradient-primary mb-0 " id="check_discount_code" type="button"
                                           title="{{trans('employer::task.checkDiscountCode')}}"><span
                                                class="text-xs">{{trans('employer::task.checkDiscountCode')}}</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-tag text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-sm-6 mt-4 mt-lg-0">
                <div class="card bg-gradient-white">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    {{--                                     <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('employer::task.task_price')}}</p>--}}
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-weight-bolder mb-0">
                                            {{trans('employer::task.main_task_price')}}
                                        </h6>
                                        <span class="badge bg-gradient-info text-white badge-lg my-auto ms-auto me-3 text-lg col-auto col-lg-3 col-md-3" id="OldMainCostsBadge">{{$task->task_cost}} <span>$</span></span>
                                        <span class="badge bg-gradient-success badge-lg my-auto ms-auto me-3 text-lg d-none  col-auto col-lg-3 col-md-3" id="NewMainCostsBadge">0 <span>$</span></span>
                                    </div>
                                    <hr class="horizontal dark">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-weight-bolder mb-0">
                                            {{trans('employer::task.other_task_price')}}
                                        </h6>
                                        <span class="badge bg-gradient-info text-white badge-lg my-auto ms-auto me-3  text-lg col-auto col-lg-3 col-md-3" id="OldAdditionalCostsBadge">{{$task->other_cost}} <span>$</span></span>
                                        <span class="badge bg-gradient-success badge-lg my-auto ms-auto me-3  text-lg d-none col-auto col-lg-3 col-md-3" id="NewAdditionalCostsBadge">0 <span>$</span></span>
                                    </div>
                                    <hr class="horizontal dark ">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-weight-bolder mb-0">
                                            {{trans('employer::task.final_task_price')}}
                                        </h6>
                                        <span class="badge bg-gradient-info text-white badge-lg my-auto ms-auto me-3 text-lg col-auto col-lg-3 col-md-3" id="OldTotalCostsBadge">{{$task->total_cost}} <span>$</span></span>
                                        <span class="badge bg-gradient-success badge-lg my-auto ms-auto me-3 text-lg d-none col-auto col-lg-3 col-md-3" id="NewTotalCostsBadge">0 <span>$</span></span>
                                    </div>

                                        {{--here is discount code ditails--}}
                                    <hr class="horizontal light d-none" id="discountCodeHr" >
                                    <div class="d-flex align-items-center d-none" id="discountCodeRow">
                                        <h6 class="font-weight-bolder mb-0">
                                            {{trans('employer::task.final_task_price_after_discount')}}
                                        </h6>
                                        <span class="badge bg-gradient-primary badge-lg my-auto ms-auto me-3 text-lg" id="newTaskCostAfterDiscount"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="button-row d-flex mt-4">
                <a class="btn  bg-gradient-light mb-0 " href="javascript:history.back()" type="button"
                   title="{{trans('employer::task.EditeTaskButton')}}">{{trans('employer::task.EditeTaskButton')}}</a>

                <button class="btn bg-gradient-success ms-auto  mb-0 " type="submit"
                        title="{{trans('employer::task.CreateTaskButton')}}">{{trans('employer::task.CreateTaskButton')}}</button>
            </div>

        </div>
    </form>
    @if(app()->getLocale() == "ar")
    <div class="position-fixed bottom-1 start-1 z-index-2">
        @else
            <div class="position-fixed bottom-1 end-1 z-index-2">
        @endif
        <div class="toast fade p-2 mt-2 bg-gradient-info " role="alert" aria-live="assertive" id="DiscountCodeNotifications" aria-atomic="true">
            <div class="toast-header bg-transparent border-0 justify-content-between">
                <i class="ni ni-bell-55 text-white me-2"></i>
                <span class=" text-white font-weight-bold" id="NotificationTitle"></span>
                <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close" aria-hidden="true"></i>
            </div>
            <hr class="horizontal light m-0">
            <div class="toast-body text-center text-white" id="NotificationMessage">

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).on('input', '#minimum_cost_per_worker', function () {
            var CountOfWorker = {{$task->total_worker_limit}};
            var OtherTaskCost = {{$task->other_cost}};
            var Wallet = {{(auth()->user()->wallet_balance)}} ;

            var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
            document.getElementById("OldMainCostsBadge").innerHTML = Number((CountOfWorker * CostPerWorker).toFixed(2)) +" $";
            document.getElementById("OldTotalCostsBadge").innerHTML =  Number((OtherTaskCost + (CountOfWorker * CostPerWorker)).toFixed(2)) +" $";
            document.getElementById("wallet_balance").innerHTML = Number(((Wallet - (OtherTaskCost + (CountOfWorker * CostPerWorker)))).toFixed(2)) + " $";
        });

        $(document).on('click', '#check_discount_code', function () {
            var DiscountCode = document.getElementById("discount_code").value;
            var card = document.getElementById("discountCard");
            var notif = document.getElementById("DiscountCodeNotifications");
            var notifTilte = document.getElementById("NotificationTitle");
            var NotifMessage = document.getElementById("NotificationMessage");

            var discountCodeHr = document.getElementById("discountCodeHr");
            var discountCodeRow = document.getElementById("discountCodeRow")
            var newTaskCostAfterDiscount = document.getElementById("newTaskCostAfterDiscount");


            var OldMainCostsBadge = document.getElementById("OldMainCostsBadge");
            var NewMainCostsBadge = document.getElementById("NewMainCostsBadge");

            var OldAdditionalCostsBadge = document.getElementById("OldAdditionalCostsBadge");
            var NewAdditionalCostsBadge = document.getElementById("NewAdditionalCostsBadge");

            var OldTotalCostsBadge = document.getElementById("OldTotalCostsBadge");
            var NewTotalCostsBadge = document.getElementById("NewTotalCostsBadge");

            $.ajax({
                url: "{{route('employer.check.trust.discount.code',$task->id)}}",
                type: "POST",
                data: {
                    disCod: DiscountCode,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',

                success: function (result) {
                    notif.classList.remove('hide')
                    notif.classList.add('show')
                    setTimeout(function() {
                        notif.classList.remove('show');
                        notif.classList.add('hide');
                    }, 10000)
                    setTimeout(function() {
                        card.removeAttribute('class');
                        card.classList.add('bg-gradient-white');
                        card.classList.add('card');
                        card.classList.add('mt-2');
                    }, 10000)
                    if (result.check_code == "Success") {
                        //change badge color
                        card.removeAttribute('class');
                        card.classList.add('card');
                        card.classList.add('bg-gradient-success');
                        card.classList.add('mt-2');

                        //show notification
                        notif.removeAttribute('class');
                        notif.classList.add('show');
                        notif.classList.add('toast');
                        notif.classList.add('bg-gradient-success');
                        notif.classList.add('fade');
                        notif.classList.add('p-2');
                        notif.classList.add('mt-2');
                        notifTilte.innerHTML = result.check_code;
                        NotifMessage.innerHTML = result.message;

                    //    show discount code Row

                        discountCodeHr.classList.remove('d-none')
                        discountCodeRow.classList.remove('d-none')

                    }
                    if (result.check_code == "Error") {
                        //change badge color
                        card.removeAttribute('class');
                        card.classList.add('card');
                        card.classList.add('bg-gradient-danger');
                        card.classList.add('mt-2');

                        //show notification
                        notif.removeAttribute('class');
                        notif.classList.add('show');
                        notif.classList.add('toast');
                        notif.classList.add('bg-gradient-danger');
                        notif.classList.add('fade');
                        notif.classList.add('p-2');
                        notif.classList.add('mt-2');
                        notifTilte.innerHTML = result.check_code;
                        NotifMessage.innerHTML = result.message;
                    }
                    if (result.check_code == "Warning") {
                        //change badge color
                        card.removeAttribute('class');
                        card.classList.add('card');
                        card.classList.add('bg-gradient-warning');
                        card.classList.add('mt-2');

                        //show notification
                        notif.removeAttribute('class');
                        notif.classList.add('show');
                        notif.classList.add('toast');
                        notif.classList.add('bg-gradient-warning');
                        notif.classList.add('fade');
                        notif.classList.add('p-2');
                        notif.classList.add('mt-2');
                        notifTilte.innerHTML = result.check_code;
                        NotifMessage.innerHTML = result.message;
                    }

                //    check discount code type
                    if(result.code_type == "MainCosts"){
                        NewMainCostsBadge.classList.remove('d-none');
                        OldMainCostsBadge.classList.add('decuration');
                        var Wallet = {{(auth()->user()->wallet_balance)}} ;
                        var discountAmount = result.amount;
                        var CountOfWorker = {{$task->total_worker_limit}};
                        var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                        var AddintionalCost =  {{$task->other_cost}};
                        var MainCostval = CostPerWorker * CountOfWorker;
                        NewMainCostsBadge.innerHTML = Number(( MainCostval - (MainCostval * discountAmount / 100)).toFixed(2)) +" $";
                        newTaskCostAfterDiscount.innerHTML = Number(((MainCostval - (MainCostval * discountAmount / 100)) +  AddintionalCost).toFixed(2))+" $";
                        document.getElementById("wallet_balance").innerHTML = Number((Wallet - ((MainCostval - (MainCostval * discountAmount / 100)) +  AddintionalCost)).toFixed(2)) +" $";




                        $(document).on('input', '#minimum_cost_per_worker', function () {
                            var CountOfWorker = {{$task->total_worker_limit}};
                            var AddintionalCost = {{$task->other_cost}};
                            var Wallet = {{(auth()->user()->wallet_balance)}} ;
                            var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                            var changedMainCostVal = (CostPerWorker * CountOfWorker);
                            NewMainCostsBadge.innerHTML = Number((changedMainCostVal - (changedMainCostVal * discountAmount / 100)).toFixed(2))+" $";
                            newTaskCostAfterDiscount.innerHTML = Number(((changedMainCostVal - (changedMainCostVal * discountAmount / 100)) +  AddintionalCost).toFixed(2))+" $";
                            document.getElementById("wallet_balance").innerHTML = Number((Wallet - ((changedMainCostVal - (changedMainCostVal * discountAmount / 100)) +  AddintionalCost)).toFixed(2)) + " $";



                        });


                    }
                    if(result.code_type == "AdditionalCosts"){
                        NewAdditionalCostsBadge.classList.remove('d-none');
                        OldAdditionalCostsBadge.classList.add('decuration');
                        var Wallet = {{(auth()->user()->wallet_balance)}} ;
                        var discountAmount = result.amount;
                        var CountOfWorker = {{$task->total_worker_limit}};
                        var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                        var MainCostval = CostPerWorker * CountOfWorker;
                        var AddintionalCost = {{$task->other_cost}};

                        NewAdditionalCostsBadge.innerHTML = Number((AddintionalCost - (AddintionalCost * discountAmount / 100)).toFixed(2))+" $";
                        newTaskCostAfterDiscount.innerHTML = Number((AddintionalCost - (AddintionalCost * discountAmount / 100) +  MainCostval).toFixed(2))+" $";
                        document.getElementById("wallet_balance").innerHTML = Number((Wallet - ((AddintionalCost - (AddintionalCost * discountAmount / 100) +  MainCostval))).toFixed(2)) + " $";
                        $(document).on('input', '#minimum_cost_per_worker', function () {
                            var Wallet = {{(auth()->user()->wallet_balance)}} ;
                            var CountOfWorker = {{$task->total_worker_limit}};
                            var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                            var MainCostval = CostPerWorker * CountOfWorker;
                            var AddintionalCost = {{$task->other_cost}};
                            newTaskCostAfterDiscount.innerHTML = Number((AddintionalCost - (AddintionalCost * discountAmount / 100) +  MainCostval).toFixed(2))+" $";
                            document.getElementById("wallet_balance").innerHTML = Number((Wallet - (AddintionalCost - (AddintionalCost * discountAmount / 100) +  MainCostval)).toFixed(2)) +" $";
                        });
                    }
                    if(result.code_type == "TotalCosts"){
                        NewTotalCostsBadge.classList.remove('d-none');
                        OldTotalCostsBadge.classList.add('decuration');
                        var Wallet = {{(auth()->user()->wallet_balance)}} ;
                        var discountAmount = result.amount;
                        var CountOfWorker = {{$task->total_worker_limit}};
                        var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                        var MainCostval = CostPerWorker * CountOfWorker;
                        var AddintionalCost = {{$task->other_cost}};

                        NewTotalCostsBadge.innerHTML = Number(((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount/100)).toFixed(2))+" $";
                        newTaskCostAfterDiscount.innerHTML = Number(((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount/100)).toFixed(2))+" $";
                        document.getElementById("wallet_balance").innerHTML = Number(( Wallet - ((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount/100))).toFixed(2))+" $";

                        $(document).on('input', '#minimum_cost_per_worker', function () {
                            var discountAmount = result.amount;
                            var CountOfWorker = {{$task->total_worker_limit}};
                            var CostPerWorker =  document.getElementById('minimum_cost_per_worker').value;
                            var MainCostval = CostPerWorker * CountOfWorker;
                            var AddintionalCost = {{$task->other_cost}};

                            NewTotalCostsBadge.innerHTML = Number(((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount/100)).toFixed(2))+" $";
                            newTaskCostAfterDiscount.innerHTML = Number(((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount/100)).toFixed(2))+" $";
                            document.getElementById("wallet_balance").innerHTML = Number((Wallet - ((MainCostval + AddintionalCost) - ((MainCostval + AddintionalCost) * discountAmount / 100))).toFixed(2)) + " $";
                        });
                    }
                }
            })
        });
    </script>
@stop
