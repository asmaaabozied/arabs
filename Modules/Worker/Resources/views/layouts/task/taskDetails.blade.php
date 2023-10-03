@extends('dashboard::layouts.worker.master')
@section('content')
    <style>
        .last-ch:last-child {
            display: none;
        }

    </style>
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
                            <h6 class="mb-0 text-lg">{{trans("worker::task.task_category")}}</h6>
                            <p class="text-xl">{{$task->category->title}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="horizontal dark">
            <div class="card-body p-3 pt-1">
                <h6>{{trans("worker::task.task_title")}}</h6>
                <p class="text-sm"> {{$task->title}}</p>
            </div>
            <hr class="horizontal dark">
            <div class="card-body p-3 pt-1">
                <h6>{{trans("worker::task.task_description")}}</h6>
                <p class="text-sm">{{$task->description}}</p>
            </div>
            <hr class="horizontal dark">
            <div class="card-body pt-0">

                <h6>{{trans('worker::task.category_actions')}}</h6>
                @for($i=0;$i<count($task->actions);$i++)
                    <div class="d-flex align-items-center">
                        <div class="text-center mx-2 w-5">
                            <img src="{{asset('assets/img/default/action.png')}}" class="avatar-sm" alt="Actions">
                        </div>
                        <div class="my-auto ms-3">
                            <div class="h-100">
                                @if(app()->getLocale() == "ar")
                                <p class="text-sm mb-1">
                                    {{$task->actions[$i]->categoryAction->ar_name}}
                                </p>
                                @else
                                    <p class="text-sm mb-1">
                                        {{$task->actions[$i]->categoryAction->name}}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <span
                            class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('worker::task.action_enable')}}</span>
                    </div>
                    <hr class="horizontal dark last-ch">
                @endfor

            </div>
        </div>

    </div>
    <div class="col-lg-6 col-sm-12 ">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">{{trans('worker::task.TaskRegion')}}</h6>
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
                                                class="text-primary">{{trans('worker::task.all_city_in:').$result[$i]['country']}}</span>
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
        <div class="card mt-3 bg-gradient-white">
            <div class="card-header bg-transparent pb-0">
                <h6 class="">{{trans('worker::task.TaskWorkFlow')}}</h6>
            </div>
            <div class="card-body p-3">

                <div class="timeline timeline-one-side" data-timeline-axis-style="dashed">
                    @for($i=0;$i<count($task->workflows);$i++)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step bg-light">
                            <i class="ni ni-ui-04 text-success text-gradient"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class=" text-sm font-weight-bold mb-0">{{trans('worker::task.steep_number: ')}}{{$i+1}}</h6>
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
                    <h6 class="mb-0">{{trans('worker::task.question_as_worker')}}</h6>
                </div>
            </div>
            @if($task->proof_request_ques == null)
                <p class="mt-3 text-danger"> {{trans('worker::task.not_proof_request_ques')}} </p>
            @else
                <p class="mt-3"> {{$task->proof_request_ques}}</p>
            @endif

            <hr class="horizontal dark">
            <div class="d-flex">
                <div class="avatar mx-2 avatar-lg">
                    <img alt="Image placeholder" src="{{asset('assets/img/default/screenshot-2.png')}}">
                </div>
                <div class="ms-2 my-auto">
                    <h6 class="mb-0">{{trans('worker::task.screenshot_as_worker')}}</h6>
                </div>
            </div>
            @if($task->proof_request_screenShot == null)
                <p class="mt-3 text-danger"> {{trans('worker::task.not_proof_request_screenShot')}} </p>
            @else
                <p class="mt-3">{{$task->proof_request_screenShot }}</p>
            @endif

        </div>
    </div>
    <div class="mt-4 mx-1 col-lg-5 ">
        <div class="card bg-gradient-light mt-2">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class=" text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('worker::task.max_task_end_date')}}</p>
                            <h5 class=" font-weight-bolder mb-0">
                               {{\Carbon\Carbon::parse($task->task_end_date)->format('Y-m-d')}}
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
        <div class="card bg-gradient-light mt-2">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class=" text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('worker::task.task_price')}}</p>
                            <h5 class=" font-weight-bolder mb-0" >
                                <span>{{ number_format(convertCurrency($task->total_cost, auth()->user()->current_currency),1) }}</span>
                                <span class="text-xxs">{{auth()->user()->current_currency}}</span>

                                <span class="text-warning text-sm">({{trans('worker::task.cost_per_worker')}} {{ number_format(convertCurrency($task->cost_per_worker, auth()->user()->current_currency),1) }}  <span class="text-xxs">{{auth()->user()->current_currency}}</span>)</span>
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
        <div class="card bg-gradient-light my-2">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('worker::task.count_of_worker')}}</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{$task->total_worker_limit}}
                                <span class="text-warning text-sm">({{trans('worker::task.worker_request_to_task')}} {{$task->approved_workers}})</span>

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
        <div class="card bg-gradient-light my-2">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold opacity-7">{{trans('worker::task.daily_worker_limit')}}</p>
                            <h5 class="font-weight-bolder mb-0">
                               @if($task->daily_limit == null)
                                    <span class="text-success text-sm">({{trans('worker::task.no_daily_worker_limit')}})</span>
                                @else
                                    {{$task->daily_limit}}
                                    <span class="text-warning text-sm">({{trans('worker::task.worker_request_today_to_task_done')}} {{$count_of_today_workers}})</span>
                                @endif

                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                            <i class="ni ni-lock-circle-open text-dark text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="POST" action="{{route('worker.submit.to.task.done',[$task->id,$task->task_number])}}"
      enctype="multipart/form-data">
    @csrf
    <div class="row mt-4">
        <div class="button-row  mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-100">{{trans('worker::task.accept_this_task')}}</button>
                <a href="{{route('worker.browse.task')}}" class="btn btn-secondary btn-lg w-100">{{trans('worker::task.BackToTaskList')}}</a>
        </div>

    </div>
</form>

@stop
