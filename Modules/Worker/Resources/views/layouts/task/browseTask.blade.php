@extends('dashboard::layouts.worker.master')
@section('content')
    <style>
        .dropdown .dropdown-toggle:after,
        .dropdown .dropdown-toggle:before,
        .dropend .dropdown-toggle:after,
        .dropend .dropdown-toggle:before,
        .dropstart .dropdown-toggle:after,
        .dropstart .dropdown-toggle:before,
        .dropup .dropdown-toggle:after,
        .dropup .dropdown-toggle:before {
            font: normal normal normal 32px/1 FontAwesome;
            border: none;
            vertical-align: middle;
            font-weight: 600;
        }
    </style>
    <div class="row">
        <div class="col-12 col-lg-3  d-flex">
            <div class="d-none d-lg-flex d-md-flex col-2 mt-lg-0">
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-3 text-center">
                            <div class="icon icon-shape bg-gradient-primary  shadow text-center border-radius-md">
                                <a href="#" id="showNavBtn">
                                    <i class="ni ni-align-left-2 text-lg opacity-10 d-none" id="align-left"
                                        aria-hidden="true"></i>
                                    <i class="ni ni-align-center text-lg opacity-10 " id="align-center"
                                        aria-hidden="true"></i>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-12 mx-1 mt-lg-0">
                <div class="card-body p-1">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="numbers">
                                <div class="bg-white border-radius-lg d-flex ">
                                    <input type="text" class="form-control" id="searchTask" style="padding: 11px"
                                        placeholder="{{ trans('worker::task.searchTask') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-12 col-12 ">
            <div class="dropdown border border-radius-2" style="">
                <button class="btn bg-gradient-primary w-100 dropdown-toggle text-lg d-flex justify-content-between"
                    type="button" id="SortTaskMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="SortTypeText">{{ trans('worker::task.SortTasksBy') }}</span>
                </button>
                <ul class="dropdown-menu w-100 text-lg sort-buttons" aria-labelledby="SortTaskMenuButton">
                    <li><a class="dropdown-item" data-sort-type="oldest">{{ trans('worker::task.SortTaskBy_oldest') }}</a>
                    </li>
                    <li><a class="dropdown-item" data-sort-type="newest">{{ trans('worker::task.SortTaskBy_newest') }}</a>
                    </li>
                    <li><a class="dropdown-item"
                            data-sort-type="cheapest">{{ trans('worker::task.SortTaskBy_cheapest') }}</a></li>
                    <li><a class="dropdown-item"
                            data-sort-type="expensive">{{ trans('worker::task.SortTaskBy_expensive') }}</a></li>
                    <li><a class="dropdown-item"
                            data-sort-type="workerAccept">{{ trans('worker::task.SortTaskBy_workerAccept') }}</a></li>
                    <li><a class="dropdown-item"
                            data-sort-type="originalArrangement">{{ trans('worker::task.SortTaskBy_originalArrangement') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-3 col-md-3 col-12 mb-lg-0 mb-md-3 mb-3">
            <div class="col-12  mt-2 mt-lg-2">
                <div class="dropdown">
                    <button class="btn bg-gradient-primary w-100 dropdown-toggle text-lg d-flex justify-content-between"
                        type="button" id="TaskCategoryFilter" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="TaskCategoryFilterText">{{ trans('worker::task.TaskCategory') }}</span>
                    </button>
                    <ul class="dropdown-menu w-100 text-lg task-category-filter-buttons"
                        aria-labelledby="TaskCategoryFilter">
                        <li><a class="dropdown-item" data-category-name="AllCategoryFilterBtn"
                                data-category-type="all">{{ trans('worker::task.AllTaskCategories') }}</a>
                        </li>
                        @foreach ($categories as $category)
                            @if (app()->getLocale() == 'ar')
                                <li><a class="dropdown-item" data-category-name="{{ $category->ar_title }}"
                                        data-category-type="{{ $category->id }}">{{ $category->ar_title }}</a></li>
                            @else
                                <li><a class="dropdown-item" data-category-name="{{ $category->title }}"
                                        data-category-type="{{ $category->id }}">{{ $category->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12  mt-2 mt-lg-1">
                <div class="dropdown">
                    <button class="btn bg-gradient-primary w-100 dropdown-toggle text-lg d-flex justify-content-between"
                        type="button" id="TaskCountryFilter" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="TaskCountryFilterText">{{ trans('worker::task.TaskCountry') }}</span>
                    </button>
                    <ul class="dropdown-menu w-100 text-lg task-country-filter-buttons" aria-labelledby="TaskCountryFilter">
                        <li><a class="dropdown-item" data-country-name="AllCountryFilterBtn"
                                data-country-type="AllCountryFilterBtn">{{ trans('worker::task.AllTaskCountry') }}</a>
                        </li>
                        @foreach ($countries as $country)
                            @if (app()->getLocale() == 'ar')
                                <li>
                                    <a class="dropdown-item" data-country-name="{{ $country->ar_name }}"
                                        data-country-type="{{ $country->id }}">
                                        {{ $country->ar_name }}</a>

                                </li>
                            @else
                                <li><a class="dropdown-item" data-country-name="{{ $country->name }}"
                                        data-country-type="{{ $country->id }}">{{ $country->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12  mt-2 mt-lg-1 ">
                <div class="dropdown">
                    <button class="btn bg-gradient-primary w-100 dropdown-toggle text-lg d-flex justify-content-between"
                        type="button" id="ProfessionalOrNormalTaskLevelButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span id="TaskLevelText">{{ trans('worker::task.TaskLevel') }}</span>
                    </button>
                    <ul class="dropdown-menu w-100 text-lg task-level-buttons"
                        aria-labelledby="ProfessionalOrNormalTaskLevelButton">
                        <li><a class="dropdown-item"
                                data-level-type="professional">{{ trans('worker::task.SortTaskBy_professional') }}</a>
                        </li>
                        <li><a class="dropdown-item"
                                data-level-type="not_professional">{{ trans('worker::task.SortTaskBy_not_professional') }}</a>
                        </li>
                        <li><a class="dropdown-item"
                                data-level-type="all_level">{{ trans('worker::task.SortTaskBy_allLevel') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12  mt-2 mt-lg-1 ">
                <div class="card bg-gradient-primary text-white">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-9">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">
                                        {{ trans('worker::task.TotalTaskCostRange') }}</p>

                                    <div class="d-flex mt-1">
                                        <span class="mx-1"><output
                                                id="rangevalue">{{ $min_total_costs }}</output></span>
                                        <input class="form-range " id="TotalCostRange" type="range"
                                            min="{{ $min_total_costs }}" max="{{ $max_total_costs }}"
                                            value="{{ $max_total_costs }}" oninput="rangevalue.value=value">
                                        <span class="mx-1">{{ $max_total_costs }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 text-end">
                                <div class="icon icon-shape  shadow text-center border-radius-md">
                                    <i class="fa fa-dollar text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $current_currency = \Modules\Currency\Entities\Currency::withoutTrashed()
            ->where('en_name', auth()->user()->current_currency)
            ->first();
        ?>
        <div class="col-lg-9 col-md-9 col-12" id="totalTasks">
            <div class="row m-r-l-unsent">
                @if (isset($specialToNormalAccessTasks) and count($specialToNormalAccessTasks) > 0)
                    @foreach ($specialToNormalAccessTasks as $task)
                        @if ($task->special_access == 'true')
                            <div class="d-flex  gx-4 position-relative task-featured-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1  ">

                                <div class="col-auto ">
                                    <img class="featured-task col-md-8 " data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="{{ trans('worker::task.ThisFutcheredTasks') }}" data-container="body"
                                    data-animation="true" {{--src="{{asset('assets/img/default/FutcheredTasks.png')}}" --}}
                                    src="{{ asset('assets/img/default/FutcheredTasks2.png') }}" width="40%" height="80%"
                                    alt="">
                                </div>
                            @else

                                <div class="row gx-4  task-normal-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1  ">
                        @endif
                        {{-- task items --}}
                        <div class="row align-items-center justify-content-between ">
                            {{-- logo task  --}}
                            <div class="col-lg-2 col-md-12 col-12 text-center">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="{{ Storage::url($task->category->image) }}" alt="profile_image"
                                        class="w-50 border-radius-lg " width="">
                                </div>
                            </div>
                            {{-- task description and pice --}}
                            <div class="col-lg-8 col-md-12 col-sm-12 ">
                                <div class="col-auto nav-wrapper position-relative end-0">
                                    <h5 class="mb-1 mt-3 text-dark">{{ $task->title }} <span class="text-xs text-info mx-3 ">{{ $task->created_at->diffForHumans() }}</span>
                                    </h5>
                                    @if (\Illuminate\Support\Str::length($task->description) > 70)
                                        <p class="mb-1 mt-1 text-justify">{{ substr($task->description, 0, 70) . '...' }}
                                        </p>
                                    @else
                                        <p class="mb-1 mt-1 text-justify">{{ substr($task->description, 0, 70) }}</p>
                                    @endif
                                </div>

                                <div
                                    class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">
                                    <div
                                        class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">
                                        <i class="fa fa-dollar text-success  text-1-5-rem "></i>

                                        <b>
                                            <span
                                            class="text-dark mx-2   {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">
                                            {{ number_format(convertCurrency($task->total_cost, auth()->user()->current_currency), 1) }}
                                            <span class="text-xxs">{{ auth()->user()->current_currency }}</span>
                                        </span>
                                        </b>
                                    </div>
                                    <div
                                        class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">
                                        <i class="fa fa-code-fork text-secondary  text-1-5-rem mx-2"></i>
                                        <span class="text-dark">{{ $task->total_worker_limit }} / </span>
                                        <span class="text-primary">{{ $task->approved_workers }} </span>
                                    </div>
                                    <div class="d-flex d-inline align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2 ">
                                        <i class="fas fa-map-marker-alt text-secondary  text-1-5-rem mx-2"></i>
                                        <span class="row text-dark" id="LimitTaskCountries">
                                            <div class="avatar-group">
                                                @if (count($task->countries) <= 6)
                                                    @for ($i = 0; $i < count($task->countries); $i++)
                                                        <a href="javascript:;"
                                                            class=" rounded-circle flag-first-child-{{ app()->getLocale() }} flag-first-child-{{ app()->getLocale() }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            @if (app()->getLocale() == 'ar') title="{{ $task->countries[$i]->country->ar_name }}"
                                                                                @else
                                                                                title="{{ $task->countries[$i]->country->name }}" @endif
                                                            data-container="body" data-animation="true">

                                                            @if ($task->countries[$i]->country->flag != null)
                                                                <img alt="Country Flag"
                                                                    src="{{ Storage::url($task->countries[$i]->country->flag) }}"
                                                                    width="5%" class="d-flex ">
                                                            @else
                                                                <img alt="Country Flag"
                                                                    src="{{ asset('assets/img/flag/flag.svg') }}"
                                                                    class="d-flex">
                                                            @endif

                                                        </a>
                                                    @endfor
                                                @elseif(count($task->countries) > 6 and count($task->countries) < count($countries))
                                                    @for ($i = 0; $i < 3; $i++)
                                                        <a href="javascript:;"
                                                            class="avatar  avatar-xs rounded-circle flag-first-child-{{ app()->getLocale() }} flag-first-child-{{ app()->getLocale() }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            @if (app()->getLocale() == 'ar') title="{{ $task->countries[$i]->country->ar_name }}"
                                                                                @else
                                                                                title="{{ $task->countries[$i]->country->name }}" @endif
                                                            data-container="body" data-animation="true">
                                                            @if ($task->countries[$i]->country->flag != null)
                                                                <img alt="Country Flag"
                                                                    src="{{ Storage::url($task->countries[$i]->country->flag) }}"
                                                                    class="">
                                                            @else
                                                                <img alt="Country Flag"
                                                                    src="{{ asset('assets/img/flag/flag.svg') }}"
                                                                    class="col">
                                                            @endif

                                                        </a>
                                                    @endfor
                                                    <span class="mx-3 text-primary">{{ trans('worker::task.andMoreCountries') }}</span>
                                                @elseif(count($task->countries) == count($countries))
                                                    <span class="mx-3 text-primary">
                                                        {{ trans('worker::task.AllCountries') }}</span>
                                                @else
                                                    @for ($i = 0; $i < 3; $i++)
                                                        <a href="javascript:;"
                                                            class="avatar  avatar-xs rounded-circle flag-first-child-{{ app()->getLocale() }} flag-first-child-{{ app()->getLocale() }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            @if (app()->getLocale() == 'ar') title="{{ $task->countries[$i]->country->ar_name }}"
                                                                                @else
                                                                                title="{{ $task->countries[$i]->country->name }}" @endif
                                                            data-container="body" data-animation="true">
                                                            @if ($task->countries[$i]->country->flag != null)
                                                                <img alt="Country Flag"
                                                                    src="{{ Storage::url($task->countries[$i]->country->flag) }}"
                                                                    class="">
                                                            @else
                                                                <img alt="Country Flag"
                                                                    src="{{ asset('assets/img/flag/flag.svg') }}"
                                                                    class="">
                                                            @endif

                                                        </a>
                                                    @endfor
                                                    <span class="mx-3 text-primary">{{ trans('worker::task.andMoreCountries') }}</span>

                                                @endif


                                            </div>
                                        </span>


                                    </div>

                                </div>

                            </div>
                            <div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">
                                <a href="{{ route('worker.show.task.details', [$task->id, $task->task_number]) }}"
                                    class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px">
                                    {{ trans('worker::task.showTaskDetailsBtn') }}</a>
                            </div>



                        </div>

            </div>

            <hr>
            @endforeach

        @else
            <h4 class="bg-gradient-primary border-radius-2xl p-6 text-center text-white text-lg">
                {{ trans('worker::task.NoTaskFound') }} </h4>
            @endif

        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-12">
        <div class="row mt-2 d-none" id="NoResulte">
            <div
                class="row gx-4 blur bg-gradient-danger text-dark w-99 mx-2 py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1  ">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="nav-wrapper text-lg text-center text-gradient text-dark position-relative end-0">
                            {{ trans('worker::task.NowResultFound') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row m-r-l-unsent">
            <div id="tasks-list">
                <!-- Tasks After Search Or Any Filter will be loaded here -->
            </div>
        </div>

    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!--Sort By Total Cost Range-->

    <script>
        const  TaskNormal = function (tasks,limitedCountryArray){
                                       return "<div data-cost='"+(Math.round(tasks.total_cost *{{ $current_currency->rate }} * 100) /100).toFixed(1)+"' data-date='"+moment(tasks.created_at).format("YYYY-MM-DD/HH:mm")+"' class='row gx-4  task-normal-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1'>" +
                                        '<div class="row align-items-center justify-content-between">' +
                                        // img task
                                       '<div class="col-lg-2 col-md-12 col-12 text-center">' +
                                        '<div class="avatar avatar-xl position-relative">' +
                                        '<img src="/storage/' + tasks.category.image +
                                        '"' +
                                        ' alt="profile_image" class="border-radius-lg w-50 ">' +
                                        '</div> </div>' +

                                        // task description
                                        '<div class="col-lg-8 col-md-12 col-sm-12 ">' +
                                        '<div class="col-auto nav-wrapper position-relative end-0">' +
                                        '<h5 class="mb-1 mt-1 text-dark">' +
                                        '<span class="text-xs text-info mx-3">' + moment(
                                            tasks.created_at).format(
                                        'YYYY-MM-DD/HH:mm') + '</span>' + tasks.title +
                                        '</h5>' +
                                        '<p class="mb-1 mt-1 text-justify">' + tasks
                                        .description.slice(0, 70) + "..." + '</p>' +
                                        '</div>' +
                                        '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                                        '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                                        '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                                        '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                                        (Math.round(tasks.total_cost *
                                                {{ $current_currency->rate }} * 100) /
                                            100).toFixed(1) +
                                        '<span class="text-xxs">' +
                                        ' {{ $current_currency->en_name }} ' +
                                        '</span>' +
                                        '</span>' +
                                        '</div>' +
                                        '<div class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                                        '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                                        '<span class="text-dark">' + tasks
                                        .total_worker_limit + '/' + '</span>' +
                                        '<span class="text-primary">' + tasks
                                        .approved_workers + '</span>' +
                                        '</div>' +
                                        '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                                        '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                                        '<span class="text-dark" id="LimitTaskCountries">' +
                                        limitedCountryArray +
                                        '</span>' +
                                        '<a href="#" class="mx-3"> <i class="fa fa-refresh" aria-hidden="true"> </i> Retask  </a>'+
                                        '</div>' +
                                        '</div>' +
                                        '</div>' +

                                        // details click
                                        '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                                        '<a href="' +
                                        'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                                        tasks.id + '/' + tasks.task_number + '"' +
                                        'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +

                                        '</div>' +
                                        '</div>' +
                                        '</div>';
            }
            const TaskFutchered  = function (tasks,limitedCountryArray){
                    return "<div data-cost='"+(Math.round(tasks.total_cost *{{ $current_currency->rate }} * 100) /100).toFixed(1)+"' data-date='"+moment(tasks.created_at).format("YYYY-MM-DD/HH:mm")+"' class='d-flex gx-4 position-relative task-featured-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1 '>" +
                       '<div class="row align-items-center justify-content-between">' +
                        // img task
                        '<div class="col-lg-1 col-md-12 col-12 text-center">' +
                        '<img  src="/assets/img/default/FutcheredTasks2.png' +
                        '"' +
                        'alt="special_access_task" width=""  class="featured-task col-md-8 " width="40%" height="80%" > ' +
                        '</div>' +
                                       '<div class="col-lg-1 col-md-12 col-12 text-center">' +

                                        '<div class="avatar avatar-xl position-relative">' +
                                        '<img src="/storage/' + tasks.category.image +
                                        '"' +
                                        ' alt="profile_image" class="border-radius-lg w-50 ">' +
                                        '</div> </div>' +
                        '<div class="col-lg-8 col-md-12 col-sm-12">' +
                        '<div class="col-auto nav-wrapper position-relative end-0">' +
                        '<h5 class="mb-1 mt-1 text-dark">' +
                        '<span class="text-xs text-info mx-3">' + moment(tasks.created_at).format('YYYY-MM-DD/HH:mm') + '</span>' + tasks.title +
                        '</h5>' +
                        '<p class="mb-1 mt-1 text-justify">' + tasks
                        .description.slice(0, 70) + "..." + '</p>' +
                        '</div>' +
                        '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                        '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                        '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                        '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                        (Math.round(tasks.total_cost *{{ $current_currency->rate }} * 100) /100).toFixed(1) +
                        '<span class="text-xxs">' +
                        ' {{ $current_currency->en_name }} ' +
                        '</span>' +
                        '</span>' +
                        '</div>' +
                        '<div class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                        '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                        '<span class="text-dark">' + tasks
                        .total_worker_limit + '/' + '</span>' +
                        '<span class="text-primary">' + tasks
                        .approved_workers + '</span>' +
                        '</div>' +
                        '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                        '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                        '<span class="text-dark" id="LimitTaskCountries">' +
                        limitedCountryArray +
                        '</span>' +
                        '<a href="#" class="mx-3"> <i class="fa fa-refresh" aria-hidden="true"> </i> Retask  </a>'+
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                        '<a href="' +
                        'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                        tasks.id + '/' + tasks.task_number + '"' +
                        'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    }
        $(document).ready(function () {
            searchFilter()
            function searchFilter(){
                $('#searchTask').on('input', function() {
                        // console.log("searchFilter");
                    var query = $(this).val();
                    var TotalTask = document.getElementById('totalTasks');
                    var NoResulte = document.getElementById('NoResulte');

                    if (query.length >= 2) {

                        $.ajax({
                            url: "{{ route('worker.ajax.task.filter.search') }}",
                            data: {
                                query: query
                            },
                            type: 'GET',
                            success: function(response) {
                                TotalTask.classList.add('d-none');
                                document.getElementById('tasks-list').classList.remove('d-none');
                                if (response.length > 0) {
                                    NoResulte.classList.add('d-none');
                                    var SortedTaskList = $('#tasks-list');
                                    SortedTaskList.empty();
                                    response.forEach(function(tasks) {
                                        var CountriesArray = '';
                                        var limitedCountryArray = '';
                                        $.each(tasks.countries, function(index, TaskCountry) {
                                            @if (app()->getLocale() == 'ar')
                                                CountriesArray += TaskCountry.country.ar_name;
                                                CountriesArray += ". ";
                                            @else
                                                CountriesArray += TaskCountry.country.name;
                                                CountriesArray += ". ";
                                            @endif
                                        });
                                        if (CountriesArray.length > 40) {
                                            limitedCountryArray += CountriesArray.slice(0, 35) + " ...."
                                        } else {
                                            limitedCountryArray += CountriesArray;
                                        }
                                        // var TaskFutchered =
                                        //     "<div class='d-flex gx-4 position-relative task-featured-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1 '>" +
                                        //     '<div class=" ">' +
                                        //     '<img  src="/assets/img/default/FutcheredTasks2.png' + '"' +
                                        //     'alt="special_access_task" width=""  class="featured-task">' +
                                        //     '</div>' +
                                        //     '<div class="row align-items-center justify-content-between">' +
                                        //     '<div class=""col-lg-1 col-md-12 col-12 text-center">' +
                                        //     '<div class="avatar avatar-xl position-relative">' +
                                        //     '<img  src="/storage/' + tasks.category.image + '"' +
                                        //     ' alt="profile_image" class="border-radius-lg">' +
                                        //     '</div> </div>' +
                                        //     '<div class="col-lg-8 col-md-12 col-sm-12">' +
                                        //     '<div class="col-auto nav-wrapper position-relative end-0">' +
                                        //     '<h5 class="mb-1 mt-1 text-dark">' +
                                        //     '<span class="text-xs text-info mx-3">' + moment(tasks
                                        //         .created_at).format('YYYY-MM-DD/HH:mm') + '</span>' +
                                        //     tasks.title + '</h5>' +
                                        //     '<p class="mb-1 mt-1 text-justify">' + tasks.description
                                        //     .slice(0, 70) + "..." + '</p>' +
                                        //     '</div>' +
                                        //     '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                                        //     '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                                        //     '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                                        //     (Math.round(tasks.total_cost *
                                        //         {{ $current_currency->rate }} * 100) / 100).toFixed(
                                        //     1) +
                                        //     '<span class="text-xxs">' +
                                        //     ' {{ $current_currency->en_name }} ' + '</span>' +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '<div class="col-3 d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                                        //     '<span class="text-dark">' + tasks.total_worker_limit +
                                        //     '/' + '</span>' +
                                        //     '<span class="text-primary">' + tasks.approved_workers +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                                        //     '<span class="text-dark" id="LimitTaskCountries">' +
                                        //     limitedCountryArray +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                                        //     '<a href="' +
                                        //     'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                                        //     tasks.id + '/' + tasks.task_number + '"' +
                                        //     'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '</div>';

                                        // var TaskNormal =
                                        //     "<div class='row gx-4  task-normal-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1'>" +
                                        //     '<div class="row align-items-center justify-content-between">' +
                                        //     '<div class=""col-lg-1 col-md-12 col-12 text-center">' +
                                        //     '<div class="avatar avatar-xl position-relative">' +
                                        //     '<img  src="/storage/' + tasks.category.image + '"' +
                                        //     ' alt="profile_image" class="border-radius-lg">' +
                                        //     '</div> </div>' +
                                        //     '<div class="col-lg-8 col-md-12 col-sm-12">' +
                                        //     '<div class="col-auto nav-wrapper position-relative end-0">' +
                                        //     '<h5 class="mb-1 mt-1 text-dark">' +
                                        //     '<span class="text-xs text-info mx-3">' + moment(tasks
                                        //         .created_at).format('YYYY-MM-DD/HH:mm') + '</span>' +
                                        //     tasks.title + '</h5>' +
                                        //     '<p class="mb-1 mt-1 text-justify">' + tasks.description
                                        //     .slice(0, 70) + "..." + '</p>' +
                                        //     '</div>' +
                                        //     '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                                        //     '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                                        //     '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                                        //     (Math.round(tasks.total_cost *
                                        //         {{ $current_currency->rate }} * 100) / 100).toFixed(
                                        //     1) +
                                        //     '<span class="text-xxs">' +
                                        //     ' {{ $current_currency->en_name }} ' + '</span>' +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '<div class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                                        //     '<span class="text-dark">' + tasks.total_worker_limit +
                                        //     '/' + '</span>' +
                                        //     '<span class="text-primary">' + tasks.approved_workers +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                                        //     '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                                        //     '<span class="text-dark" id="LimitTaskCountries">' +
                                        //     limitedCountryArray +
                                        //     '</span>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                                        //     '<a href="' +
                                        //     'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                                        //     tasks.id + '/' + tasks.task_number + '"' +
                                        //     'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +
                                        //     '</div>' +
                                        //     '</div>' +
                                        //     '</div>';

                                            if (tasks.special_access === "true") {
                                                SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                            } else {
                                                SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                            }
                                        // if (tasks.special_access === "true") {
                                        //     SortedTaskList.append(TaskFutchered);
                                        // } else {
                                        //     SortedTaskList.append(TaskNormal);
                                        // }
                                    });
                                } else {
                                    NoResulte.classList.remove('d-none');
                                    TotalTask.classList.add('d-none');
                                    document.getElementById('tasks-list').classList.add('d-none');
                                }


                            },
                            error: function(response) {
                                document.getElementById('tasks-list').classList.add('d-none');
                            }
                        });
                    } else {
                        TotalTask.classList.remove('d-none');
                        document.getElementById('tasks-list').classList.add('d-none');
                        NoResulte.classList.add('d-none');
                    }

                });
            }
            <!--Search Filter-->

            <!--Sort Filter-->
            sortFilter();
            function sortFilter(){

                var TotalTask = document.getElementById('totalTasks');
                $('.sort-buttons a').click(function() {
                    var sortType = $(this).data('sort-type');
                    // console.log("sortFilter");

                    switch (sortType) {
                        case 'oldest':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByOldest') }}';
                            break;
                        case 'newest':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByNewest') }}';
                            break;
                        case 'cheapest':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByCheapest') }}';
                            break;
                        case 'expensive':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByExpensive') }}';
                            break;
                        case 'workerAccept':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByWorkerAccept') }}';
                            break;
                        case 'originalArrangement':
                            document.getElementById('SortTypeText').innerHTML =
                                '{{ trans('worker::task.TasksSortedByOriginalArrangement') }}';
                            break;
                    }
                    // console.log(sortType,);
                    if (sortType == "originalArrangement") {
                        TotalTask.classList.remove('d-none');
                        var SortedTaskList = document.getElementById('tasks-list');
                        SortedTaskList.classList.add('d-none');
                    } else  {
                        // TaskCountryFilterText TaskLevelText
                        var category = $('#TaskCategoryFilterText').text().split(':').length <= 1 ? true:false ;
                        var country = $('#TaskCountryFilterText').text().split(':').length <= 1 ?true:false ;
                        var taskLevel = $('#TaskLevelText').text().split(':').length <= 1 ?true:false ;

                        // advanced without ajax
                        if((category && country && taskLevel) ){
                            $.ajax({
                            url: '{{ route('worker.ajax.task.sort', ['sortType' => ':sortType']) }}'
                                .replace(':sortType', sortType),
                            success: function(response) {
                                TotalTask.classList.add('d-none');
                                document.getElementById('tasks-list').classList.remove('d-none');
                                if (response.length > 0) {
                                    NoResulte.classList.add('d-none');
                                    var SortedTaskList = $('#tasks-list');
                                    SortedTaskList.empty();
                                    response.forEach(function(tasks) {
                                        var CountriesArray = '';
                                        var limitedCountryArray = '';
                                        $.each(tasks.countries, function(index,
                                        TaskCountry) {
                                            @if (app()->getLocale() == 'ar')
                                                CountriesArray += TaskCountry
                                                    .country.ar_name;
                                                CountriesArray += ". ";
                                            @else
                                                CountriesArray += TaskCountry
                                                    .country.name;
                                                CountriesArray += ". ";
                                            @endif
                                        });
                                        if (CountriesArray.length > 40) {
                                            limitedCountryArray += CountriesArray.slice(0,
                                                35) + " ...."
                                        } else {
                                            limitedCountryArray += CountriesArray;
                                        }

                                        if (tasks.special_access === "true") {
                                            SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                        } else {
                                            SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                        }
                                    });
                                } else {
                                    NoResulte.classList.remove('d-none');
                                    TotalTask.classList.add('d-none');
                                    document.getElementById('tasks-list').classList.add('d-none');
                                }


                            },
                            error: function(response) {

                            }
                        });
                        }else{

                        switch (sortType) {
                            case 'oldest':
                                // Sort by oldest
                                $('#tasks-list').children().sort(function(a, b) {
                                    return $(a).data('date') - $(b).data('date');
                                }).appendTo('#tasks-list');

                                break;
                            case 'newest':
                                // Sort by newest
                            $('#tasks-list').children().sort(function(a, b) {
                                    return $(b).data('date') - $(a).data('date');
                                }).appendTo('#tasks-list');

                                break;
                            case 'cheapest':
                                // Sort by cheapest
                                $('#tasks-list').children().sort(function(a, b) {
                                    return $(a).data('cost') - $(b).data('cost');
                                }).appendTo('#tasks-list');
                                break;
                            case 'expensive':
                                // Sort by most expensive
                                $('#tasks-list').children().sort(function(a, b) {
                                    return $(b).data('cost') - $(a).data('cost');
                                }).appendTo('#tasks-list');
                                break;
                        }

                    }

                    }
                });
            }
            <!--Sort Filter-->

            <!--Sort By Category-->
            sortByCategory();
            function sortByCategory(){
                    var TotalTask = document.getElementById('totalTasks');
                    $('.task-category-filter-buttons a').click(function() {
                        // console.log("sortByCategory");
                        var categoryType = $(this).data('category-type');
                        var categoryName = $(this).data('category-name');
                        if (categoryName == "AllCategoryFilterBtn") {
                            document.getElementById('TaskCategoryFilterText').innerHTML =
                                '{{ trans('worker::task.AllCategoryFilterBtn') }}';
                        } else {
                            document.getElementById('TaskCategoryFilterText').innerHTML =
                                '{{ trans('worker::task.TaskShowedByCategoryName') }}' + categoryName;
                        }
                        if (categoryType == "all") {
                            TotalTask.classList.remove('d-none');
                            document.getElementById('tasks-list').classList.add('d-none');
                            document.getElementById('NoResulte').classList.add('d-none');
                        } else {
                            $.ajax({
                                url: '{{ route('worker.ajax.task.categories', ['categoryType' => ':categoryType']) }}'
                                    .replace(':categoryType', categoryType),
                                success: function(response) {
                                    TotalTask.classList.add('d-none');
                                    document.getElementById('tasks-list').classList.remove('d-none');
                                    if (response.length > 0) {
                                        NoResulte.classList.add('d-none');
                                        var SortedTaskList = $('#tasks-list');
                                        SortedTaskList.empty();
                                        response.forEach(function(tasks) {
                                            var CountriesArray = '';
                                            var limitedCountryArray = '';
                                            $.each(tasks.countries, function(index,
                                            TaskCountry) {
                                                @if (app()->getLocale() == 'ar')
                                                    CountriesArray += TaskCountry
                                                        .country.ar_name;
                                                    CountriesArray += ". ";
                                                @else
                                                    CountriesArray += TaskCountry
                                                        .country.name;
                                                    CountriesArray += ". ";
                                                @endif
                                            });
                                            if (CountriesArray.length > 40) {
                                                limitedCountryArray += CountriesArray.slice(0,
                                                    35) + " ...."
                                            } else {
                                                limitedCountryArray += CountriesArray;
                                            }

                                            if (tasks.special_access === "true") {
                                                SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                            } else {
                                                SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                            }
                                        });
                                    } else {
                                        NoResulte.classList.remove('d-none');
                                        TotalTask.classList.add('d-none');
                                        document.getElementById('tasks-list').classList.add('d-none');
                                    }
                                },
                                error: function(response) {

                                }
                            });
                        }

                    });
            }
            <!--Sort By Category-->

            <!--Sort By Level-->
            sortByLevel();
            function sortByLevel(){

                var TotalTask = document.getElementById('totalTasks');
                $('.task-level-buttons a').click(function() {
                    // console.log("sortByLevel");
                    var levelType = $(this).data('level-type');
                    switch (levelType) {
                        case 'professional':
                            document.getElementById('TaskLevelText').innerHTML =
                                '{{ trans('worker::task.onlyProfessionalTasks') }}';
                            break;

                        case 'not_professional':
                            document.getElementById('TaskLevelText').innerHTML =
                                '{{ trans('worker::task.onlyNotProfessionalTasks') }}';
                            break;
                        case 'all_level':
                            document.getElementById('TaskLevelText').innerHTML =
                                '{{ trans('worker::task.AllLevelTasks') }}';
                            break;
                    }
                    if (levelType == "all_level") {
                        TotalTask.classList.remove('d-none');
                        document.getElementById('tasks-list').classList.add('d-none');
                        document.getElementById('NoResulte').classList.add('d-none');
                    } else {
                        $.ajax({
                            url: '{{ route('worker.ajax.task.level', ['levelType' => ':levelType']) }}'
                                .replace(':levelType', levelType),
                            success: function(response) {
                                TotalTask.classList.add('d-none');
                                document.getElementById('tasks-list').classList.remove('d-none');
                                if (response.length > 0) {
                                    NoResulte.classList.add('d-none');
                                    var SortedTaskList = $('#tasks-list');
                                    SortedTaskList.empty();
                                    response.forEach(function(tasks) {
                                        var CountriesArray = '';
                                        var limitedCountryArray = '';
                                        $.each(tasks.countries, function(index,
                                        TaskCountry) {
                                            @if (app()->getLocale() == 'ar')
                                                CountriesArray += TaskCountry
                                                    .country.ar_name;
                                                CountriesArray += ". ";
                                            @else
                                                CountriesArray += TaskCountry
                                                    .country.name;
                                                CountriesArray += ". ";
                                            @endif
                                        });
                                        if (CountriesArray.length > 40) {
                                            limitedCountryArray += CountriesArray.slice(0,
                                                35) + " ...."
                                        } else {
                                            limitedCountryArray += CountriesArray;
                                        }

                                        if (tasks.special_access === "true") {
                                            SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                        } else {
                                            SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                        }
                                    });
                                } else {
                                    NoResulte.classList.remove('d-none');
                                    TotalTask.classList.add('d-none');
                                    document.getElementById('tasks-list').classList.add('d-none');
                                }
                            },
                            error: function(response) {

                            }
                        });
                    }

                });
            }
            <!--Sort By Level-->

            <!--Sort By Country -->
            sortByCountry();
            function sortByCountry(){
                var TotalTask = document.getElementById('totalTasks');
                $('.task-country-filter-buttons a').click(function() {
                    // console.log("sortByCountry");
                    var countryType = $(this).data('country-type');
                    var countryName = $(this).data('country-name');
                    if (countryName == "AllCountryFilterBtn") {
                        document.getElementById('TaskCountryFilterText').innerHTML =
                            '{{ trans('worker::task.AllCountryFilterBtn') }}';
                    } else {
                        document.getElementById('TaskCountryFilterText').innerHTML =
                            '{{ trans('worker::task.TaskShowedByCountryName') }}' + countryName;
                    }
                    if (countryType == "AllCountryFilterBtn") {
                        TotalTask.classList.remove('d-none');
                        document.getElementById('tasks-list').classList.add('d-none');
                        document.getElementById('NoResulte').classList.add('d-none');
                    } else {
                        $.ajax({
                            url: '{{ route('worker.ajax.task.country', ['countryType' => ':countryType']) }}'
                                .replace(':countryType', countryType),
                            success: function(response) {

                                TotalTask.classList.add('d-none');
                                document.getElementById('tasks-list').classList.remove('d-none');
                                if (response.length > 0) {
                                    NoResulte.classList.add('d-none');
                                    var SortedTaskList = $('#tasks-list');
                                    SortedTaskList.empty();
                                    response.forEach(function(tasks) {
                                        var CountriesArray = '';
                                        var limitedCountryArray = '';
                                        $.each(tasks.countries, function(index,
                                        TaskCountry) {
                                            @if (app()->getLocale() == 'ar')
                                                CountriesArray += TaskCountry
                                                    .country.ar_name;
                                                CountriesArray += ". ";
                                            @else
                                                CountriesArray += TaskCountry
                                                    .country.name;
                                                CountriesArray += ". ";
                                            @endif
                                        });
                                        if (CountriesArray.length > 40) {
                                            limitedCountryArray += CountriesArray.slice(0,
                                                35) + " ...."
                                        } else {
                                            limitedCountryArray += CountriesArray;
                                        }

                                        if (tasks.special_access === "true") {
                                            SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                        } else {
                                            SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                        }
                                    });
                                } else {
                                    NoResulte.classList.remove('d-none');
                                    TotalTask.classList.add('d-none');
                                    document.getElementById('tasks-list').classList.add('d-none');
                                }
                            },
                            error: function(response) {

                            }
                        });
                    }

                });
            }
            <!--Sort By Country -->

            <!--Sort By Total Cost Range-->
            sortByTotalCostRange();
            function sortByTotalCostRange(){
                $('#TotalCostRange').on('input', function() {
                    // console.log("sortByTotalCostRange");
                    var selectedVal = $(this).val();
                    var minPrice = {{ $min_total_costs }};
                    var TotalTask = document.getElementById('totalTasks');
                    $.ajax({
                        url: "{{ route('worker.ajax.task.cost.range') }}",
                        type: 'GET',
                        data: {
                            selectedVal: selectedVal,
                            minPrice: minPrice
                        },
                        success: function(response) {
                            TotalTask.classList.add('d-none');
                            document.getElementById('tasks-list').classList.remove('d-none');
                            if (response.length > 0) {
                                NoResulte.classList.add('d-none');
                                var SortedTaskList = $('#tasks-list');
                                SortedTaskList.empty();

                                response.forEach(function(tasks) {
                                    var CountriesArray = '';
                                    var limitedCountryArray = '';
                                    $.each(tasks.countries, function(index, TaskCountry) {
                                        @if (app()->getLocale() == 'ar')
                                            CountriesArray += TaskCountry.country.ar_name;
                                            CountriesArray += ". ";
                                        @else
                                            CountriesArray += TaskCountry.country.name;
                                            CountriesArray += ". ";
                                        @endif
                                    });
                                    if (CountriesArray.length > 40) {
                                        limitedCountryArray += CountriesArray.slice(0, 35) + " ...."
                                    } else {
                                        limitedCountryArray += CountriesArray;
                                    }
                                    // var TaskFutchered =
                                    //     "<div class='d-flex gx-4 position-relative task-featured-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1 '>" +
                                    //     '<div class=" ">' +
                                    //     '<img  src="/assets/img/default/FutcheredTasks2.png' + '"' +
                                    //     'alt="special_access_task" width=""  class="featured-task">' +
                                    //     '</div>' +
                                    //     '<div class="row align-items-center justify-content-between">' +
                                    //     '<div class=""col-lg-1 col-md-12 col-12 text-center">' +
                                    //     '<div class="avatar avatar-xl position-relative">' +
                                    //     '<img  src="/storage/' + tasks.category.image + '"' +
                                    //     ' alt="profile_image" class="border-radius-lg">' +
                                    //     '</div> </div>' +
                                    //     '<div class="col-lg-8 col-md-12 col-sm-12">' +
                                    //     '<div class="col-auto nav-wrapper position-relative end-0">' +
                                    //     '<h5 class="mb-1 mt-1 text-dark">' +
                                    //     '<span class="text-xs text-info mx-3">' + moment(tasks.created_at)
                                    //     .format('YYYY-MM-DD/HH:mm') + '</span>' + tasks.title +
                                    //     '</h5>' +
                                    //     '<p class="mb-1 mt-1 text-justify">' + tasks.description.slice(
                                    //         0, 70) + "..." + '</p>' +
                                    //     '</div>' +
                                    //     '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                                    //     '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                                    //     '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                                    //     (Math.round(tasks.total_cost * {{ $current_currency->rate }} *
                                    //         100) / 100).toFixed(1) +
                                    //     '<span class="text-xxs">' +
                                    //     ' {{ $current_currency->en_name }} ' + '</span>' +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '<div class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                                    //     '<span class="text-dark">' + tasks.total_worker_limit + '/' +
                                    //     '</span>' +
                                    //     '<span class="text-primary">' + tasks.approved_workers +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                                    //     '<span class="text-dark" id="LimitTaskCountries">' +
                                    //     limitedCountryArray +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                                    //     '<a href="' +
                                    //     'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                                    //     tasks.id + '/' + tasks.task_number + '"' +
                                    //     'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '</div>';

                                    // var TaskNormal =
                                    //     "<div class='row gx-4  task-normal-preview-border-gradient text-dark  py-2 border-radius-xl justify-content-lg-start justify-content-md-start justify-content-center mt-1'>" +
                                    //     '<div class="row align-items-center justify-content-between">' +
                                    //     '<div class=""col-lg-1 col-md-12 col-12 text-center">' +
                                    //     '<div class="avatar avatar-xl position-relative">' +
                                    //     '<img  src="/storage/' + tasks.category.image + '"' +
                                    //     ' alt="profile_image" class="border-radius-lg">' +
                                    //     '</div> </div>' +
                                    //     '<div class="col-lg-8 col-md-12 col-sm-12">' +
                                    //     '<div class="col-auto nav-wrapper position-relative end-0">' +
                                    //     '<h5 class="mb-1 mt-1 text-dark">' +
                                    //     '<span class="text-xs text-info mx-3">' + moment(tasks.created_at)
                                    //     .format('YYYY-MM-DD/HH:mm') + '</span>' + tasks.title +
                                    //     '</h5>' +
                                    //     '<p class="mb-1 mt-1 text-justify">' + tasks.description.slice(
                                    //         0, 70) + "..." + '</p>' +
                                    //     '</div>' +
                                    //     '<div class="d-flex flex-wrap mt-2 mb-1 justify-content-center justify-content-md-start justify-content-lg-start">' +
                                    //     '<div class="d-flex  align-items-center flex-wrap text-dark   border-radius-2xl text-lg  mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fa fa-dollar text-success  text-1-5-rem "></i>' +
                                    //     '<span class="text-dark mx-2  {{ $current_currency->rate > 10 ? 'font-size-16' : '' }}">' +
                                    //     (Math.round(tasks.total_cost * {{ $current_currency->rate }} *
                                    //         100) / 100).toFixed(1) +
                                    //     '<span class="text-xxs">' +
                                    //     ' {{ $current_currency->en_name }} ' + '</span>' +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '<div class="d-flex  align-items-center flex-wrap p-2 text-dark  border-radius-2xl text-lg mx-2 mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fa fa-code-fork text-secondary text-lg mx-2"></i>' +
                                    //     '<span class="text-dark">' + tasks.total_worker_limit + '/' +
                                    //     '</span>' +
                                    //     '<span class="text-primary">' + tasks.approved_workers +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '<div class="col-auto d-flex align-items-center flex-wrap text-dark border-radius-2xl text-lg mt-2 mt-lg-0 mt-md-2">' +
                                    //     '<i class="fas fa-map-marker-alt text-secondary text-lg mx-2"></i>' +
                                    //     '<span class="text-dark" id="LimitTaskCountries">' +
                                    //     limitedCountryArray +
                                    //     '</span>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '<div class="col-lg-2 col-md-12 col-sm-12  text-lg-start text-center   mt-3 ">' +
                                    //     '<a href="' +
                                    //     'https://arabworkers.com/app/panel/worker/tasks/task-details/' +
                                    //     tasks.id + '/' + tasks.task_number + '"' +
                                    //     'class="btn btn-sm btn-secondary " style="padding-top: 20px;padding-bottom: 20px"> {{ trans('worker::task.showTaskDetailsBtn') }}</a>' +
                                    //     '</div>' +
                                    //     '</div>' +
                                    //     '</div>';

                                    if (tasks.special_access === "true") {
                                                SortedTaskList.append(TaskFutchered(tasks,limitedCountryArray));
                                            } else {
                                                SortedTaskList.append(TaskNormal(tasks,limitedCountryArray));
                                            }
                                    // if (tasks.special_access === "true") {
                                        // SortedTaskList.append(TaskFutchered);
                                    // } else {
                                        // SortedTaskList.append(TaskNormal);
                                    // }
                                });
                            } else {
                                NoResulte.classList.remove('d-none');
                                TotalTask.classList.add('d-none');
                                document.getElementById('tasks-list').classList.add('d-none');
                            }
                        },
                        error: function(response) {

                        }
                    });
                });
            }
        $('#showNavBtn').on('click', function() {
            if (document.getElementById('MainContent').classList.contains("main-content")) {
                document.getElementById('MainContent').classList.remove('main-content');
                document.getElementById('sidenav-main').classList.add('hidnav');
                document.getElementById('align-left').classList.add('d-none');
                document.getElementById('align-center').classList.remove('d-none')
            } else {
                document.getElementById('MainContent').classList.add('main-content');
                document.getElementById('sidenav-main').classList.remove('hidnav');
                document.getElementById('align-left').classList.remove('d-none');
                document.getElementById('align-center').classList.add('d-none');
            }
        });

        });
    </script>

@stop
