@extends('dashboard::layouts.worker.master')
@section('content')
    <link href="{{asset('assets/css/image-view-box.css')}}" rel="stylesheet">

    <div class="row">
        <div class="col-md-3 mt-md-4 mt-4">
            <div class="card bg-gradient-secondary">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8 my-auto">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                    {{trans('worker::task.category')}}
                                </p>
                                <h5 class="text-white font-weight-bolder weather-line mb-0">
                                    {{$data->category->title}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <img class="w-50 "
                                 src="{{Storage::url($data->category->image)}}"
                                 alt="Status Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-md-4 mt-4">
            <div class="card bg-gradient-secondary">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8 my-auto">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                    {{trans('worker::task.task_total_cost')}}
                                </p>
                                <h5 class="text-white font-weight-bolder weather-line mb-0">
                                    {{ number_format(convertCurrency($data->task_cost, auth()->user()->current_currency),1) }}
                                    <span class="text-xxs">{{auth()->user()->current_currency}}</span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <img class="w-50 "
                                 src="{{asset('assets/img/default/cost.png')}}"
                                 alt="Total Cost">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-md-4 mt-4">
            <div class="card bg-gradient-secondary">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-9 my-auto">
                            <div class="numbers">
                                <p class="text-white text-lg mb-0 text-capitalize font-weight-bold opacity-7">
                                    {{trans('worker::task.Task_number')}}
                                </p>
                                <h5 class="text-white text-sm font-weight-bolder weather-line mb-0">
                                    {{$data->task_number}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <span class="text-lg ">#</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-md-4 mt-4">
            <div class="card {{"task_".$task_statuses->last()->status->name}}">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8 my-auto">
                            <div class="numbers">
                                <p class="text-white text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                    {{trans('worker::task.taskStatus')}}
                                </p>
                                <h5 class="text-white font-weight-bolder weather-line mb-0">
                                    @if($task_statuses->last()->status->name == "pending")
                                        <span
                                            class="text-sm">{{trans('worker::task.'.$task_statuses->last()->status->name)}}</span>
                                        <span
                                            class="text-xs">{{$task_statuses->last()->status->updated_at->diffForHumans()}}</span>
                                    @else
                                        {{trans('worker::task.'.$task_statuses->last()->status->name)}} <span
                                            class="text-xs">{{$task_statuses->last()->status->updated_at->diffForHumans()}}</span>

                                    @endif
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <img class="w-50 " style="border-radius: 18px"
                                 src="{{asset('assets/img/default/task-'.$task_statuses->last()->status->name.'.gif')}}"
                                 alt="Status Icon">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card bg-gradient-secondary">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-12 my-auto">
                            <div class="numbers">
                                <p class="text-white text-center text-sm mb-0 text-capitalize font-weight-bold opacity-7">
                                    {{trans('worker::task.The remaining time to complete the task')}}
                                </p>
                                <h5 id="counter" class="text-white text-center font-weight-bolder weather-line mb-0"> </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card mb-3 mt-lg-0 mt-4">
                <div class="card-body pb-0">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                            <h6 class="mb-1 text-gradient text-primary">
                                {{trans('worker::task.taskWorkerDetails')}}
                            </h6>
                        </div>
                    </div>
                    <ul class="list-unstyled mx-auto">
                        <li>
                            <div class="d-flex flex-wrap justify-content-between">
                                <p class="mb-0">  {{trans('worker::task.total_worker_limit')}}</p>
                                <span
                                    class="badge text-sm badge-md bg-gradient-secondary mx-1">{{$data->total_worker_limit}} {{trans('worker::task.worker')}}</span>
                            </div>
                        </li>


                        <li>
                            <hr class="horizontal dark">
                        </li>
                        <li>
                            <div class="d-flex flex-wrap justify-content-between">
                                <p class="mb-0">  {{trans('worker::task.cost_per_worker')}}</p>
                                <span
                                    class="badge text-sm badge-md bg-gradient-secondary mx-1">
                                     {{ number_format(convertCurrency($data->cost_per_worker, auth()->user()->current_currency),1) }}
                                    <span class="text-xxs">{{auth()->user()->current_currency}}</span>
                                </span>
                            </div>
                        </li>
                        <li>
                            <hr class="horizontal dark">
                        </li>
                        <li>
                            <div class="d-flex flex-wrap justify-content-between">
                                <p class="mb-0">  {{trans('worker::task.daily limit')}}</p>
                                @if($data->daily_limit == null)
                                    <span
                                        class="badge text-sm badge-md bg-gradient-warning mx-1">{{trans('worker::task.no_daily_limit')}}</span>

                                @else
                                    <span
                                        class="badge text-sm badge-md bg-gradient-secondary mx-1">{{$data->daily_limit}} {{trans('worker::task.worker')}}</span>
                                @endif
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-lg-0 mb-4">
            <div class="card">

                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary"><span
                            class="text-lg ms-n2">{{trans('worker::task.title')}}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">{{$data->title}}</h6>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary"><span
                            class="text-lg ms-n2">{{trans('worker::task.taskDescription')}}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">{{$data->description}}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-body mt-2 pt-0">

                    <h6>{{trans('worker::task.category_actions')}}</h6>
                    @for($i=0;$i<count($data->actions);$i++)
                        <div class="d-flex align-items-center">
                            <div class="text-center mx-2 w-5">
                                <img src="{{asset('assets/img/default/action.png')}}" class="avatar-sm" alt="Actions">
                            </div>
                            <div class="my-auto ms-3">
                                <div class="h-100">
                                    <p class="text-sm mb-1">
                                        {{$data->actions[$i]->categoryAction->name}}
                                    </p>
                                </div>
                            </div>
                            <span
                                class="badge bg-gradient-success badge-sm my-auto ms-auto me-3">{{trans('worker::task.action_enable')}}</span>
                        </div>
                        <hr class="horizontal dark last-ch">
                    @endfor

                </div>
                <hr class="horizontal dark ">
                <div class="card-body mt-2 pt-0">
                    <div class="d-flex">
                        <div class="avatar mx-2 avatar-lg">
                            <img class="" alt="Image placeholder" src="{{asset('assets/img/default/asking.png')}}">
                        </div>
                        <div class="ms-2 my-auto">
                            <h6 class="mb-0">{{trans('worker::task.question_as_worker')}}</h6>
                        </div>
                    </div>
                    @if($data->proof_request_ques == null)
                        <p class="mt-3 text-danger"> {{trans('worker::task.not_proof_request_ques')}} </p>
                    @else
                        <p class="mt-3"> {{$data->proof_request_ques}}</p>
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
                    @if($data->proof_request_screenShot == null)
                        <p class="mt-3 text-danger"> {{trans('worker::task.not_proof_request_screenShot')}} </p>
                    @else
                        <p class="mt-3">{{$data->proof_request_screenShot }}</p>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-2 mb-lg-0 mb-4 col-sm-12 ">
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
            <div class="card mt-3 bg-gradient-secondary">
                <div class="card-header bg-transparent pb-0">
                    <h6 class="text-white">{{trans('worker::task.TaskWorkFlow')}}</h6>
                </div>
                <div class="card-body p-3">

                    <div class="timeline timeline-one-side" data-timeline-axis-style="dashed">
                        @for($i=0;$i<count($data->workflows);$i++)
                            <div class="timeline-block mb-3">
                            <span class="timeline-step bg-light">
                            <i class="ni ni-ui-04 text-success text-gradient"></i>
                            </span>
                                <div class="timeline-content">
                                    <h6 class="text-white text-sm font-weight-bold mb-0">{{trans('worker::task.steep_number: ')}}{{$i+1}}</h6>
                                    <p class="text-white text-sm mt-3 mb-2">
                                        {{$data->workflows[$i]->work_flow}}
                                    </p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="text-center d-inline d-lg-flex d-md-flex justify-content-between">
            <a href="{{route('worker.tasks.in.active')}}"
               class="btn bg-gradient-secondary btn-lg    mb-2">{{trans('worker::task.back')}}</a>


            <a href="{{route('worker.show.task.finish.the.job.form',[$data->id,$data->task_number])}}"
               class="btn bg-gradient-primary btn-lg  mb-2">{{trans('worker::task.finish_task_job')}}</a>
        </div>
    </div>



    <script>
        <?php
        $task_end_date = \Carbon\Carbon::parse($data->task_end_date)->format('F d, Y H:i:s');
        $dateTime = strtotime($task_end_date);
        $getDateTime = date("F d, Y H:i:s", $dateTime);
        ?>
        var countDownDate = new Date("<?php echo "$getDateTime"; ?>").getTime();
        // Update the count down every 1 second
        var x = setInterval(function () {
            var now = new Date().getTime();
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Output the result in an element with id="counter"11
            document.getElementById("counter").innerHTML =
                days +  "{{trans('worker::task.days_remaining')}}" + hours +  "{{trans('worker::task.hours_remaining')}}" + minutes +  "{{trans('worker::task.minutes_remaining')}}" + seconds +  "{{trans('worker::task.seconds_remaining')}}";
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                var now = new Date().getTime();
                // Find the distance between now an the count down date
                var distance =   now - countDownDate;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Output the result in an element with id="counter"11
                document.getElementById("counter").innerHTML =
                    "{{trans('worker::task.The time available to finish the task has expired since:')}}" +days + " {{trans('worker::task.days_remaining')}} " + hours + " {{trans('worker::task.hours_remaining')}} " + minutes + " {{trans('worker::task.minutes_remaining')}} " + seconds + " {{trans('worker::task.seconds_remaining')}} ";
            }
        }, 1000);
    </script>

@stop
