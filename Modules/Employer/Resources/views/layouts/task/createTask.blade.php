@extends('dashboard::layouts.employer.master')
@section('content')
    <style>
        .feed-hidden {
            opacity: 0;
            transition: opacity 0.0s;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 multisteps-form ">

            @if($errors->has('category_id'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('category_id') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('title'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('title') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('description'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('description') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('TaskWorkflow'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('TaskWorkflow') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->has('TaskWorkflow.*.Workflow'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('TaskWorkflow.*.Workflow') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('total_worker_limit'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('total_worker_limit') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{--                    @if($errors->has('cost_per_worker'))--}}

            {{--                        <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
            {{--                            <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('cost_per_worker') }}</span>--}}
            {{--                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">--}}
            {{--                                <span aria-hidden="true">&times;</span>--}}
            {{--                            </button>--}}
            {{--                        </div>--}}
            {{--                    @endif--}}
            @if($errors->has('task_end_date'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('task_end_date') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('TaskRegion'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('TaskRegion') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('TaskRegion.*.Country'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('TaskRegion.*.Country') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('TaskRegion.*.City'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('TaskRegion.*.City') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('proof_request_ques'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('proof_request_ques') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('proof_request_screenShot'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('proof_request_screenShot') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('special_access'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('special_access') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('only_professional'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('only_professional') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if($errors->has('daily_limit'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('daily_limit') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="multisteps-form__progress">
                        <button class="multisteps-form__progress-btn js-active" type="button"
                                title="{{trans('employer::task.ChoosingCategoryAndActions')}}">
                                <span>
                                    {{trans('employer::task.ChoosingCategoryAndActions')}}</span>
                        </button>
                        <button class="multisteps-form__progress-btn" type="button"
                                title="{{trans('employer::task.MainTaskDetails')}}">{{trans('employer::task.MainTaskDetails')}}</button>
                        <button class="multisteps-form__progress-btn" type="button"
                                title="{{trans('employer::task.preferential information')}}">{{trans('employer::task.preferential information')}}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-10 col-lg-10 m-auto">
                    <form action="{{route('employer.create.task.steep.one')}}" method="POST"
                          enctype="multipart/form-data"
                          class="multisteps-form__form ">
                        @csrf
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                             data-animation="FadeIn">
                            <h5 class="font-weight-bolder mb-0"
                                id="category-menu-title"> {{trans('employer::task.pleas_select_type_of_category')}} </h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class=" w-100 text-lg d-flex flex-wrap p-0 category-menu"
                                            aria-labelledby="CategoryMenu" id="CategoryMenu">
                                            @if(count($categories) > 0)
                                                <input type="number" class="d-none" id="category_id" name="category_id"
                                                       value="">
                                                @foreach($categories as $category)
                                                    <li class="d-flex col-4 move-on-hover cursor-pointer"
                                                        data-category-type="{{$category->id}}">
                                                        <div class="col-12">
                                                            <div class="card m-2">
                                                                <div class="card-body p-3">
                                                                    <div class="row align-items-center">
                                                                        <div class="col-9">
                                                                            <div class="numbers">
                                                                                <h5 class="font-weight-bolder mb-0">
                                                                                    @if(app()->getLocale() == "ar")
                                                                                        {{$category->ar_title}}
                                                                                    @else
                                                                                        {{$category->title}}
                                                                                    @endif
                                                                                </h5>
                                                                                <p class="text-sm mb-0 text-capitalize font-weight-bold"> {{$category->description}}</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-3 text-end">
                                                                            <div
                                                                                class="avatar avatar-xl position-relative">
                                                                                <img
                                                                                    src="{{Storage::url($category->image)}}"
                                                                                    alt="Category Image"
                                                                                    class="w-100 border-radius-lg ">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="col-12">

                                        <!-- Selected Category must be appended here using ajax -->
                                        <li class="d-flex col-12 d-none" id="selectedCategory"
                                            data-category-type="">
                                            <div class="col-12">
                                                <div class="card m-2" style="border: 2px solid #6d9f71">
                                                    <div class="card-body p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-9">
                                                                <div class="numbers">
                                                                    <h5 class="font-weight-bolder mb-0"
                                                                        id="selectedCategoryTitle">
                                                                    </h5>
                                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold"
                                                                       id="selectedCategoryDescription">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div
                                                                    class="avatar avatar-xl position-relative">
                                                                    <img
                                                                        id="selectedCategoryImage"
                                                                        src=""
                                                                        alt="Category Image"
                                                                        class="w-100 border-radius-lg ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Selected Category must be appended here using ajax -->


                                        <ul class=" w-100 text-lg d-flex flex-wrap p-0 action-menu"
                                            aria-labelledby="ActionMenu" id="ActionMenu">
                                            <!-- this line must be appended here using ajax -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="button-row d-flex ">
                                    <button id="backToCategoryMenuBtn" class="btn bg-gradient-light  mb-0 d-none "
                                            type="button" onclick="BackToCategoryList()"
                                            title="{{trans('employer::task.prev_step')}}">{{trans('employer::task.prev_step')}}
                                    </button>
                                    <button class="btn bg-gradient-primary ms-auto mb-0 d-none "
                                            id="firstNextStep"
                                            type="button"
                                            title="{{trans('employer::task.next_step')}}">{{trans('employer::task.next_step')}}
                                    </button>

                                </div>
                            </div>

                        </div>
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                             data-animation="FadeIn">
                            <h5 class="font-weight-bolder">{{trans('employer::task.MainTaskDetails')}}</h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label>{{trans('employer::task.TaskTitle')}}</label>
                                        <input name="title" value="{{old('title')}}"
                                               class="multisteps-form__input form-control" type="text"
                                               id="taskTitle"
                                               placeholder="{{trans('employer::task.TaskTitlePlaceholder')}}"
                                               onfocus="focused(this)" onfocusout="defocused(this)"
                                               required>
                                    </div>
                                    <div class="col-12 mt-3">

                                        <label>{{trans('employer::task.TaskDescription')}}</label>
                                        <textarea name="description"
                                                  id="TaskDescription"
                                                  required
                                                  class="multisteps-form__textarea form-control" rows="2"
                                                  placeholder="{{trans('employer::task.TaskDescriptionPlaceholder')}}">{{old('description')}}</textarea>
                                    </div>
                                    <div class="col-12 mt-3" id="TaskTextWorkflowBox">
                                        <fieldset>
                                            <label>{{trans('employer::task.the task workflow')}}  </label>
                                            {{--                                    <h5 class="font-weight-bolder text-sm  mb-2"> {{trans('employer::task.Below you can specify the stages required to complete your campaign, be clear about the specifications and provide easy and simple instructions')}} </h5>--}}
                                            <div class="repeater-default">
                                                <div data-repeater-list="TaskWorkflow">
                                                    <div data-repeater-item="">
                                                        <div class="form-group row d-flex  mb-2">
                                                            <div class="col-11 ">
                                                        <textarea name="TaskWorkflow[0][Workflow]"
                                                                  id="TaskTextWorkflow"
                                                                  required
                                                                  class="multisteps-form__textarea form-control"
                                                                  rows="1"
                                                                  placeholder="{{trans('employer::task.workflow placeholder')}}"></textarea>
                                                            </div>

                                                            <div class="col-1">
                                                                <span data-repeater-delete=""
                                                                      class="btn btn-danger btn-md">
                                                                     <i class="fas fa-trash  opacity-10"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0 row">
                                                    <div class="col-sm-12">
                                                        <span data-repeater-create=""
                                                              class="btn btn-success btn-md w-100">
                                                             <i class="fas fa-plus  opacity-10" aria-hidden="true"></i>  {{trans('employer::task.add new workflow')}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label>{{trans('employer::task.request_ques')}}</label>
                                        <div class=" d-flex justify-content-between align-items-center">

                                            <input id="textQuestion" name="proof_request_ques"
                                                   class="multisteps-form__input  w-100 form-control" type="text"
                                                   value="{{old('proof_request_ques')}}"
                                                   placeholder="{{trans('employer::task.proof_request_ques')}}"
                                                   onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>

                                    </div>
                                    <div class="col-12 mt-3">
                                        <label>{{trans('employer::task.proof_request_screenShot')}}</label>
                                        <div class=" d-flex justify-content-between align-items-center">
                                            <input id="textScreenShot"
                                                   name="proof_request_screenShot"
                                                   value="{{old('proof_request_screenShot')}}"
                                                   class="multisteps-form__input  w-100 form-control" type="text"
                                                   placeholder="{{trans('employer::task.proof_request_screenShot_placeholder')}}"
                                                   onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>

                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="{{trans('employer::task.prev_step')}}">{{trans('employer::task.prev_step')}}
                                    </button>
                                    <button class="btn bg-gradient-primary d-none ms-auto mb-0" id="secoundNextStepBtn"
                                            type="button"
                                            onmouseover="checkAllInputs()"
                                            title="{{trans('employer::task.next_step')}}">{{trans('employer::task.next_step')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                             data-animation="FadeIn">
                            <h5 class="font-weight-bolder">{{trans('employer::task.preferential information')}}</h5>
                            <div class="multisteps-form__content">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <label>{{trans('employer::task.contOfWorkers')}}</label>
                                            <input class="multisteps-form__input form-control" name="total_worker_limit"
                                                   value="1" type="number" step="1" min="1"
                                                   id="workerCount"
                                                   placeholder="{{trans('employer::task.contOfWorkers')}}"
                                                   onfocus="focused(this)" onfocusout="defocused(this)" required>
                                        </div>
                                        <div class="col-12">
                                            <label>{{trans('employer::task.task_end_date')}}</label>
                                            <input class="multisteps-form__input form-control" name="task_end_date"
                                                   type="date" placeholder="{{trans('employer::task.task_end_date')}}"
                                                   onfocus="focused(this)" min="{{date('Y-m-d')}}"
                                                   onfocusout="defocused(this)" required>
                                        </div>
                                        <div class="col-12">
                                            <fieldset class="">
                                                {{--                                                <h4 class=" text-info text-sm  mb-2"> {{trans('employer::task.Please select countries and cities for this task')}} </h4>--}}
                                                <div class="repeater-default">
                                                    <div data-repeater-list="TaskRegion">
                                                        <div id="test_repeater" data-repeater-item="">
                                                            <div class="mession-list form-group row d-flex ">

                                                                <div class="col-5">
                                                                    <label>{{trans('employer::task.TaskCountry')}}</label>
                                                                    <select name="TaskRegion[0][Country]"
                                                                            class="country_repeater multisteps-form__select form-control"
                                                                            required>
                                                                        <option>{{trans('employer::task.pleas_select_country')}}</option>
                                                                        @if(count($countries) > 0)
                                                                            @foreach($countries as $country)
                                                                                @if(app()->getLocale()=='ar')
                                                                                    <option
                                                                                        value="{{$country->id}}">{{$country->ar_name}}</option>
                                                                                @else
                                                                                    <option
                                                                                        value="{{$country->id}}">{{$country->name}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            <option>{{trans('employer::task.NoCountryFound')}}</option>

                                                                        @endif

                                                                    </select>
                                                                </div>

                                                                <div class="col-5 " id="cities-container">
                                                                    <label>{{trans('employer::task.TaskCity')}}</label>
                                                                    <select name="TaskRegion[0][City]" id="firstCity"
                                                                            required
                                                                            class="city_repeater multisteps-form__select form-control city-select">
                                                                        <option
                                                                            value="null">{{trans('employer::task.pleas_select_country_to_fetch_cities')}}</option>

                                                                    </select>
                                                                </div>

                                                                <div class="col-sm-2" style="margin-top: 30px">
                                                                <span data-repeater-delete="" data-price="0"
                                                                      class="delete-country btn btn-danger btn-md">
                                                                     <i class="fas fa-trash  opacity-10"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0 row mt-4">
                                                        <div class="col-sm-12">
                                                        <span data-repeater-create=""
                                                              class="btn btn-success btn-md">
                                                             <i class="fas fa-plus  opacity-10" aria-hidden="true"></i>  {{trans('employer::task.add new countryAndCity')}}
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <!--  If the number of tasks pin to top is less than the allowable limit, can use this feature  -->
                                            @if($activeAndAvailableTasks < $limit_of_pin_to_top->pin_in_top_task_limit_count)
                                                <div class="d-flex col-12 ">
                                                    <div class="col-12">
                                                        <div class="card m-2">
                                                            <div class="card-body p-3">
                                                                <div class="row align-items-center"
                                                                     style="min-height: 43px!important;">
                                                                    <div class="col-3 text-center">
                                                                        <div class="form-check form-switch">
                                                                            <input
                                                                                class="form-check-input features toggle"
                                                                                name="special_access"
                                                                                data-price="{{$pin_task_on_top->fees}}"
                                                                                type="checkbox"
                                                                                id="pinTaskTop_toggle"
                                                                                data-toggle="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="numbers text-center"><p
                                                                                class="text-sm mb-0 text-capitalize font-weight-bold">
                                                                                {{trans('employer::task.pinTaskTop')}}

                                                                                <i
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{trans('employer::task.pinTaskTopAvailableNowDescription')}} {{$limit_of_pin_to_top->pin_in_top_task_limit_count}}"

                                                                                    class="ni ni-bell-55 text-sm text-success opacity-10" aria-hidden="true"></i>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                    <span id="pinTaskTopValue" class="text-info ext-capitalize font-weight-bold font-size-22">
                                                                        {{convertCurrency($pin_task_on_top->fees, auth()->user()->current_currency)}}
                                                                        <span
                                                                            class="text-xs text-body "> {{auth()->user()->current_currency}} </span>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="d-flex col-12">
                                                    <div class="col-12">
                                                        <div class="card m-2 " style="background-color: #EBEBF0">
                                                            <div class="card-body p-3">
                                                                <div class="row align-items-center"
                                                                     style="min-height: 43px!important;">
                                                                    <div class="col-3 text-center">
                                                                        <div class="form-check form-switch">
                                                                            <input
                                                                                class="form-check-input features toggle"
                                                                                name=""
                                                                                data-price="{{$pin_task_on_top->fees}}"
                                                                                type="checkbox"
                                                                                id=""
                                                                                data-toggle="off" disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="numbers text-center"><p
                                                                                class="text-sm mb-0 text-capitalize font-weight-bold">
                                                                                {{trans('employer::task.pinTaskTop')}}
                                                                                <i
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="bottom"
                                                                                    title="{{trans('employer::task.pinTaskTopNotAvailableNowDescription')}} {{$limit_of_pin_to_top->pin_in_top_task_limit_count}}"

                                                                                    class="ni ni-bell-55 text-sm text-warning opacity-10" aria-hidden="true"></i>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                    <span id="pinTaskTopValue" class="text-info ext-capitalize font-weight-bold font-size-22">
                                                                        {{convertCurrency($pin_task_on_top->fees, auth()->user()->current_currency)}}
                                                                        <span
                                                                            class="text-xs text-body "> {{auth()->user()->current_currency}} </span>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="d-flex col-12 ">
                                                <div class="col-12">
                                                    <div class="card m-2">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center"
                                                                 style="min-height: 43px!important;">
                                                                <div class="col-3 text-center">
                                                                    <div class="form-check form-switch">
                                                                        <input
                                                                            class="form-check-input features toggle"
                                                                            name="only_professional"
                                                                            data-price="{{$only_professional_worker->fees}}"
                                                                            type="checkbox"
                                                                            id="professionalOnly_toggle"
                                                                            data-toggle="off">
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="numbers text-center"><p
                                                                            class="text-sm mb-0 text-capitalize font-weight-bold">
                                                                            {{trans('employer::task.professionalOnly')}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <span id="professionalOnlyValue" class="text-info ext-capitalize font-weight-bold font-size-22">
                                                                        {{convertCurrency($only_professional_worker->fees, auth()->user()->current_currency)}}
                                                                        <span
                                                                            class="text-xs text-body"> {{auth()->user()->current_currency}} </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex col-12 ">
                                                <div class="col-12">
                                                    <div class="card m-2">
                                                        <div class="card-body p-3">
                                                            <div class="row align-items-center"
                                                                 style="min-height: 43px!important;">
                                                                <div class="col-3 text-center">
                                                                    <div class="form-check form-switch">
                                                                        <input
                                                                            class="form-check-input features toggle"
                                                                            name="daily_limit_toggle"
                                                                            data-price="{{$daily_limit_worker->fees}}"
                                                                            type="checkbox"
                                                                            id="worker_daily_limit_toggle"
                                                                        >
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="numbers text-center"><p
                                                                            class="text-sm mb-0 text-capitalize font-weight-bold">
                                                                            {{trans('employer::task.worker_daily_limit')}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <span id="worker_daily_limitValue" class="text-info ext-capitalize font-weight-bold font-size-22">
                                                                        {{convertCurrency($daily_limit_worker->fees, auth()->user()->current_currency)}}
                                                                        <span
                                                                            class="text-xs text-body"> {{auth()->user()->current_currency}} </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4 d-none" id="limitWorkerBox">
                                                <label>{{trans('employer::task.worker_daily_limit_input')}}</label>
                                                <input id="worker_daily_limit_input" name="daily_limit"
                                                       min="1" step="1" value="1"

                                                       class="multisteps-form__input  w-100 form-control" type="number"
                                                       placeholder="{{trans('employer::task.worker_daily_limit_input')}}"
                                                       onfocus="focused(this)" onfocusout="defocused(this)" disabled>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                            title="{{trans('employer::task.prev_step')}}">{{trans('employer::task.prev_step')}}
                                    </button>
                                    <button class="btn bg-gradient-primary ms-auto mb-0"
                                            onmouseover="CheckCountryInput()" type="submit" title="Send">
                                        {{trans('employer::employer.createTaskBTN')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <div class="card p-1 ">

                            <div id="cart">
                                <h4 class="text-center">Task Cost </h4>
                                <ul id="cart-items"></ul>
                                <div> <span >Total</span> <span id="cart-total" >$0</span></div>
                            </div>

                    </div>


                </div>

            </div>
        </div>
    </div>
    <?php
    $current_currency = \Modules\Currency\Entities\Currency::withoutTrashed()->where('en_name', auth()->user()->current_currency)->first();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script>
    <!-- Repeater JavaScript -->
    <script src="{{asset('assets/js/plugins/repeater/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/repeater/jquery.form-repeater.js')}}"></script>

    <script>
        $(document).ready(function () {
            var ActionMenu = document.getElementById("ActionMenu");
            $('.category-menu li').click(function () {
                var categoryType = $(this).data('category-type');
                document.getElementById("category_id").value = categoryType;
                ActionMenu.innerHTML = "";
                $.ajax({
                    url: '{{ route("employer.fetch.category.actions", ["categoryType" => ":categoryType"]) }}'.replace(':categoryType', categoryType),
                    success: function (response) {
                        if (response.length > 0) {
                            document.getElementById('ActionMenu').classList.remove('d-none');
                            $('#CategoryMenu').addClass('feed-hidden').fadeOut(0);
                            setTimeout(function () {
                                document.getElementById('CategoryMenu').classList.add('d-none');
                                document.getElementById('selectedCategory').classList.remove('d-none');
                                document.getElementById('backToCategoryMenuBtn').classList.remove('d-none');
                                document.getElementById('category-menu-title').innerHTML = '{{ trans('employer::task.pleas_select_category_actions') }}';
                            }, 0);
                            response.forEach(function (actions) {
                                var en_action = '<li class="d-flex col-4 move-on-hover ">' +
                                    '<div class="col-12">' +
                                    '<div class="card m-2">' +
                                    '<div class="card-body p-3">' +
                                    '<div class="row align-items-center" style="min-height: 43px!important;">' +
                                    '<div class="col-3 text-right">' +
                                    '<span class="text-sm">' + (actions.price * {{$current_currency->rate}}).toFixed(2) +
                                    '<span class="text-3xs">' + ' {{$current_currency->en_name}} ' + '</span>' +
                                    '</span>' +
                                    '</div>' +

                                    '<div class="col-6">' +
                                    ' <div class="numbers text-center">' +
                                    ' <p class="text-sm mb-0 text-capitalize font-weight-bold">' + ((actions.name.length > 50) ? actions.name.slice(0, 50) + "..." : actions.name) + '</p>' +
                                    ' </div>' +
                                    '</div>' +

                                    '<div class="col-2 text-center">' +
                                    '<div class="form-check form-switch" >' +
                                    '<input class="form-check-input features toggle" name="' + 'CategoryAction[' + actions.id + '][toggle]' + '"' + 'data-price="' + actions.price + '"' + 'data-item="' + actions.ar_name + '"' + 'type="checkbox" aria-checked="ch" >' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</li>';

                                var ar_action = '<li class="d-flex col-4 move-on-hover ">' +
                                    '<div class="col-12">' +
                                    '<div class="card m-2">' +
                                    '<div class="card-body p-3">' +
                                    '<div class="row align-items-center" style="min-height: 43px!important;">' +

                                    '<div class="col-3 text-center">' +
                                    '<div class="form-check form-switch" >' +
                                    '<input class="form-check-input features toggle" name="' + 'CategoryAction[' + actions.id + '][toggle]' + '"' + 'data-price="' + actions.price + '"' + 'data-item="' + actions.ar_name + '"' + 'type="checkbox" data-toggle="off">' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="col-6">' +
                                    ' <div class="numbers text-center">' +
                                    ' <p class="text-sm mb-0 text-capitalize font-weight-bold">' + ((actions.ar_name.length > 50) ? actions.ar_name.slice(0, 50) + "..." : actions.ar_name) + '</p>' +
                                    ' </div>' +
                                    '</div>' +
                                    '<div class="col-3 text-right">' +
                                    '<span class="text-sm">' + (actions.price * {{$current_currency->rate}}).toFixed(2) +
                                    '<span class="text-3xs">' + ' {{$current_currency->en_name}} ' + '</span>' +
                                    '</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</li>';
                                @if(app()->getLocale() =="ar")
                                document.getElementById('selectedCategoryTitle').innerHTML = response[0].category.ar_title;
                                document.getElementById('selectedCategoryDescription').innerHTML = response[0].category.description;
                                document.getElementById('selectedCategoryImage').src = "/storage/" + response[0].category.image;
                                ActionMenu.insertAdjacentHTML("afterbegin", ar_action);
                                @else
                                document.getElementById('selectedCategoryTitle').innerHTML = response[0].category.title;
                                document.getElementById('selectedCategoryDescription').innerHTML = response[0].category.description;
                                document.getElementById('selectedCategoryImage').src = "/storage/" + response[0].category.image;
                                ActionMenu.insertAdjacentHTML("afterbegin", en_action);
                                @endif

                            });

                            $('.form-check-input').on('change', function() {

                            var item = $(this).data('item');
                            var price = $(this).data('price');

                            if($(this).is(':checked')) {
                            addToCart(item, price);
                            } else {
                            removeFromCart(item,price);
                            }

                            updateCartTotal();

                            });

                            function addToCart(item, price) {
                                // add item html to cart
                                $('#cart-items').append(`
                                    <li data-item="${item}" data-price="${price}">
                                    ${item}: $${price}
                                    <a href="#" class="remove-item p-2 ">X</a>
                                    </li>
                                `);
                            }

                            function removeFromCart(item,price) {
                                // remove item html from cart
                                $('#cart-items li[data-item="'+item+'"]').remove();
                            }


                            function updateCartTotal() {
                                var total = 0;

                                $('#cart-items li').each(function() {
                                var price = $(this).data('price');
                                total += price;
                                });

                                $('#cart-total').text('$' + total);
                            }

                            $('#cart-items').on('click', '.remove-item', function() {

                                var item = $(this).closest('li').data('item');

                                $(this).closest('li').remove();

                                updateCartTotal();

                            })

                        } else {
                            // todo make handel else error
                        }


                    },
                    error: function (response) {
                        // todo make handel else error
                    }
                });
            });
        });
    </script>

    <script>
        function BackToCategoryList() {
            $('#CategoryMenu').removeClass('feed-hidden').fadeOut(0);
            document.getElementById('CategoryMenu').classList.remove('d-none');
            document.getElementById('selectedCategory').classList.add('d-none');
            document.getElementById('backToCategoryMenuBtn').classList.add('d-none');
            document.getElementById('ActionMenu').classList.add('d-none');
            document.getElementById('category-menu-title').innerHTML = '{{trans('employer::task.pleas_select_type_of_category')}}';

        }
    </script>

    <!--fetch city by country-->
    <script>
        $(document).ready(function () {
            $(document).on('change', '.mession-list .country_repeater', function () {
                var idCountry = this.value;

                $city_repeater = $(this).parents('.mession-list').find('.city_repeater')
                $city_repeater.html('');
                $.ajax({
                    url: "{{route('employer.fetch.cities')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        @if(app()->getLocale() == "ar")
                        $city_repeater.html('<option class="bg-gray-500" selected  value="all_cities_in_this_country[' + idCountry + ']">' + "{{trans('employer::task.select_all_cities_in_this_country')}}" + '</option>');


                        $.each(result.cities, function (key, value) {
                            $city_repeater.append('<option value="' + value
                                .id + '">' + value.ar_name + '</option>');
                        });
                        @else
                        $city_repeater.html('<option class="bg-gray-500" selected  value="all_cities_in_this_country[' + idCountry + ']">' + "{{trans('employer::task.select_all_cities_in_this_country')}}" + '</option>');
                        $.each(result.cities, function (key, value) {
                            $city_repeater.append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        @endif

                    }
                });
            });
        });


    </script>

    <!--enable and disable worker limit-->
    <script>
        document.getElementById('worker_daily_limit_toggle').onclick = function () {
            var disabled = document.getElementById("worker_daily_limit_input").disabled;
            if (disabled) {
                document.getElementById("worker_daily_limit_input").disabled = false;
                document.getElementById("limitWorkerBox").classList.remove('d-none');

            } else {
                document.getElementById("worker_daily_limit_input").disabled = true;
                document.getElementById("limitWorkerBox").classList.add('d-none');
            }
        }
    </script>

    <!-- set live validation to force select one of any action toggles -->
    <script>
        $(document).ready(function () {
            $(document).on('change', '.toggle', function () {
                if (this.checked) {
                    // Change the value of data-toggle attribute to "on"
                    this.setAttribute('data-toggle', 'on');
                } else {
                    // Change the value of data-toggle attribute to "off" if the input is not checked
                    this.setAttribute('data-toggle', 'off');
                }

                // Get all the input elements
                const inputs = document.querySelectorAll('input[data-toggle]');
                // Initialize a count variable
                let count = 0;
                // Loop through the inputs and count the ones with data-toggle = "on"
                for (let i = 0; i < inputs.length; i++) {
                    if (inputs[i].dataset.toggle === "on") {
                        count++;
                    }
                }

                if (count >= 1) {
                    document.getElementById('firstNextStep').classList.remove('d-none');
                    document.getElementById('firstNextStep').classList.add('js-btn-next');
                } else {
                    document.getElementById('firstNextStep').classList.add('d-none');
                    document.getElementById('firstNextStep').classList.remove('js-btn-next');
                }

            });


        });
    </script>

    <!-- set live validation to force fill all of inputs in step 2 -->
    <script>
        $(document).ready(function () {
            document.getElementById("TaskDescription").disabled = true;
            // document.getElementById("TaskTextWorkflow").disabled = true;
            document.getElementById("TaskTextWorkflowBox").hidden = true;
            document.getElementById("textQuestion").disabled = true;
            document.getElementById("textScreenShot").disabled = true;

            var Title = document.getElementById('taskTitle');
            Title.addEventListener('input', function () {
                var TitleInputLength = Title.value.length;
                if (TitleInputLength < 5) {
                    document.getElementById("TaskDescription").disabled = true;
                    checkInputs();
                } else {
                    document.getElementById("TaskDescription").disabled = false;
                    checkInputs();
                }

            });

            var textDescription = document.getElementById('TaskDescription');
            textDescription.addEventListener('input', function () {
                var DescriptionInputLength = textDescription.value.length;
                if (DescriptionInputLength < 5) {
                    // document.getElementById("TaskTextWorkflow").disabled = true;
                    document.getElementById("TaskTextWorkflowBox").hidden = true;
                    checkInputs();
                } else {
                    // document.getElementById("TaskTextWorkflow").disabled = false;
                    document.getElementById("TaskTextWorkflowBox").hidden = false;
                    checkInputs();
                }
            });

            var textWorkFlow = document.getElementById('TaskTextWorkflow');
            textWorkFlow.addEventListener('input', function () {
                var WorkFlowInputLength = textWorkFlow.value.length;
                if (WorkFlowInputLength < 5) {
                    document.getElementById("textQuestion").disabled = true;
                    checkInputs();
                } else {
                    document.getElementById("textQuestion").disabled = false;
                    checkInputs();
                }
            });

            var textQuestion = document.getElementById('textQuestion');
            textQuestion.addEventListener('input', function () {
                var QuestionInputLength = textQuestion.value.length;
                if (QuestionInputLength < 5) {
                    document.getElementById("textScreenShot").disabled = true;
                    checkInputs();
                } else {
                    document.getElementById("textScreenShot").disabled = false;
                    checkInputs();
                }

            });

            var textScreenShot = document.getElementById('textScreenShot');
            textScreenShot.addEventListener('input', function () {
                var ScreenShotInputLength = textScreenShot.value.length;
                checkInputs(ScreenShotInputLength);
            });

            function checkInputs(ScreenShotInputLength) {
                if (!$('#TaskDescription').prop('disabled') &&
                    !$('#TaskTextWorkflowBox').attr('hidden') &&
                    !$('#textQuestion').prop('disabled') &&
                    ScreenShotInputLength > 5
                ) {
                    document.getElementById('secoundNextStepBtn').classList.remove('d-none');
                }
            }
        });

    </script>

    <!-- final check if is all inputs is filled in step 2 -->
    <script>
        function checkAllInputs() {
            const Toast = Swal.mixin({
                toast: true,
                @if(app()->getLocale() == "ar")
                position: 'top-start',
                @else
                position: 'top-end',
                @endif
                showConfirmButton: false,
                timer: 6000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            $(document).ready(function () {
                var titleLenghth = document.getElementById('taskTitle').value.length;
                var DescLenghth = document.getElementById('TaskDescription').value.length;
                var WorkflowLenghth = document.getElementById('TaskTextWorkflow').value.length;
                var QuesLenghth = document.getElementById('textQuestion').value.length;
                var screenShootLenghth = document.getElementById('textScreenShot').value.length;
                if (!$('#TaskDescription').prop('disabled') &&
                    // !$('#TaskTextWorkflow').prop('disabled') &&
                    !$('#TaskTextWorkflowBox').attr('hidden') &&
                    !$('#textQuestion').prop('disabled') &&
                    !$('#textScreenShot').prop('disabled') &&
                    titleLenghth > 5 &&
                    screenShootLenghth > 5
                ) {
                    document.getElementById('secoundNextStepBtn').classList.add('js-btn-next');
                } else {
                    document.getElementById('secoundNextStepBtn').classList.remove('js-btn-next');

                    if ($('#taskTitle').prop('disabled')) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task Title field is disabled.')}}',
                        });
                    }
                    if (titleLenghth < 5) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Title length should be greater than 5.')}}',
                        });
                    }

                    if ($('#TaskDescription').prop('disabled')) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task Description field is disabled.')}}',
                        });
                    }
                    if (DescLenghth < 5) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Description length should be greater than 5.')}}',
                        });
                    }


                    if ($('#TaskTextWorkflow').prop('disabled')) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task TextWorkflow field is disabled.')}}',
                        });
                    }
                    if (WorkflowLenghth < 5) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task TextWorkflow field is disabled.')}}',
                        });

                    }

                    if ($('#textQuestion').prop('disabled')) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task Question field is disabled.')}}',
                        });
                    }
                    if (QuesLenghth < 5) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Question length should be greater than 5.')}}',
                        });
                    }

                    if ($('#textScreenShot').prop('disabled')) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The Task ScreenShot field is disabled.')}}',
                        });
                    }
                    if (screenShootLenghth < 5) {
                        Toast.fire({
                            icon: 'error',
                            title: '{{trans('employer::task.The ScreenShot length should be greater than 5.')}}',
                        });
                    }


                }
            });


        }
    </script>

    <!-- final check if is all country and city is filled in step 3 -->
    <script>
        function CheckCountryInput() {
            const Toast = Swal.mixin({
                toast: true,
                @if(app()->getLocale() == "ar")
                position: 'top-start',
                @else
                position: 'top-end',
                @endif
                showConfirmButton: false,
                timer: 6000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            $(document).ready(function () {
                var firstCityValue = document.getElementById('firstCity')?.value;

                if (firstCityValue === undefined || firstCityValue === "null") {
                    Toast.fire({
                        icon: 'error',
                        title: '{{trans('employer::task.City Value is null or undefined')}}',
                    });

                }
            });

        }

    </script>


@stop
