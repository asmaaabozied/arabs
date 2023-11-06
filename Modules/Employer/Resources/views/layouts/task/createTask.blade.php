@extends('dashboard::layouts.employer.master')
@section('libraries')


<link rel="stylesheet" href="{{asset('assets/Dashboard/assets/libs/alertifyjs/build/css/alertify.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/Dashboard/assets/libs/alertifyjs/build/css/themes/default.min.css')}}"/>
@endsection
@section('content')

{{-- <form action="{{route('employer.create.task.steep.one')}}" method="POST" enctype="multipart/form-data" class="multisteps-form__form "> </form> --}}
    {{-- @csrf --}}
<div class="grid grid-cols-12 gap-5">
    {{-- task info  --}}
    <div class="col-span-12 lg:col-span-4">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body pb-0">
                <h4 class="text-15 text-gray-700 dark:text-gray-100">{{trans('employer::task.MainTaskDetails')}}</h4>
            </div>
            <div class="card-body">
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2" for="default-input">{{trans('employer::task.TaskTitle')}}</label>
                        <input required name="title" id="taskTitle" value="{{old('title')}}" class="w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="{{trans('employer::task.TaskTitlePlaceholder')}}" >
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2" for="default-input">{{trans('employer::task.TaskDescription')}}</label>
                        <textarea name="description" id="TaskDescription" required class="border-gray-100 block w-full mt-2 rounded placeholder:text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100/80 dark:placeholder:text-zinc-100/80 focus:ring-2 focus:ring-offset-0 focus:ring-violet-500/30" rows="2" placeholder="{{trans('employer::task.TaskDescriptionPlaceholder')}}">{{old('description')}}</textarea>
                    </div>
                    <div class="mb-4">
                        <fieldset>
                            <label>{{trans('employer::task.the task workflow')}}</label>
                            <div class="repeater-default">
                                <div data-repeater-list="TaskWorkflow">
                                    <div data-repeater-item="">
                                        <div class="flex mb-2">
                                            <div class="flex-1">
                                                <textarea id="TaskTextWorkflow" required name="TaskWorkflow[0][Workflow]" id="TaskDescription" required class="border-gray-100 block w-full mt-2 px-3 rounded placeholder:text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100/80 dark:placeholder:text-zinc-100/80 focus:ring-2 focus:ring-offset-0 focus:ring-violet-500/30" rows="2" placeholder="{{trans('employer::task.workflow placeholder')}}">{{old('TaskWorkflow[0][Workflow]')}}</textarea>
                                            </div>

                                            <div class="flex-none px-3 py-2">
                                                <span data-repeater-delete="" class="btn btn-danger btn-md">
                                                    <i class="fas fa-trash opacity-10" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0 flex">
                                    <div class="flex w-full justify-center">
                                        <button data-repeater-create="" type="button" class="btn bg-violet-500 border-transparent text-white font-medium w-50 justify-center hover:bg-violet-700 focus:bg-violet-700 focus:ring focus:ring-violet-50"><i class="fas fa-plus opacity-10" aria-hidden="true"></i> {{trans('employer::task.add new workflow')}}</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2" for="default-input">{{trans('employer::task.request_ques')}}</label>
                        <input required name="proof_request_ques" id="textQuestion" value="{{old('proof_request_ques')}}" class="w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="text" placeholder="{{trans('employer::task.proof_request_ques')}}" >
                    </div>

            </div>
        </div>
    </div>
    {{-- task categories  --}}
    <div class="col-span-12 lg:col-span-6">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                    <div class="mb-4">
                        <div class="tab-pane block" id="select-category">
                            <div class="text-center ">
                                <h5 class="text-gray-700 dark:text-gray-100 py-1" id="category-menu-title"> {{trans('employer::task.pleas_select_type_of_category')}}</h5>
                            </div>
                                @if (count($categories) > 0)
                                    <input type="number" class="hidden" id="category_id" name="category_id" value="">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4" id="CategoryMenu">
                                        @foreach ($categories as $category)
                                            <div class="bg-green-50 dark:bg-zinc-600 dark:text-gray-100 py-3 rounded-md shadow-md border border-2 border-black select_category" data-category-type="{{$category->id}}">
                                                <div class="px-3 mx-2 rtl:float-left ltr:float-right">
                                                    <img src="{{ Storage::url($category->image) }}" alt="Category Image"
                                                        class="w-28 h-28 object-cover rounded-lg">
                                                </div>
                                                <h5 class="px-3 font-semibold mb-1">
                                                    @if (app()->getLocale() == 'ar')
                                                        {{ $category->ar_title }}
                                                    @else
                                                        {{ $category->title }}
                                                    @endif
                                                </h5>

                                                <h6 class="px-3 text-sm text-gray-700 dark:text-gray-400">
                                                    {{ $category->description }}
                                                </h6>
                                            </div>

                                        @endforeach
                                    </div>
                                @endif
                            <br>
                            <div class="col-span-12 lg:col-span-6">
                                <!-- Selected Category must be appended here using AJAX -->
                                <li class="hidden" id="selectedCategory" data-category-type="">
                                  <div class="col-span-12 ">
                                    <div class="m-2 p-3">
                                      <div class="flex justify-center items-center">
                                        <div class="col-span-9  lg:p-6 sm:p-2" >
                                          <div class="font-bold mb-0" id="selectedCategoryTitle"></div>
                                          <p class="text-md text-capitalize font-semibold" id="selectedCategoryDescription"></p>
                                        </div>
                                        <div class="col-span-3 text-end">
                                          <div class="relative">
                                            <img id="selectedCategoryImage" src="" alt="Category Image" class="w-28 h-28 object-cover rounded-lg ">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                <!-- Selected Category must be appended here using AJAX -->
                                <ul class="text-lg lg:flex lg:flex-wrap p-0 space-x-4 space-y-2" aria-labelledby="ActionMenu" id="ActionMenu">
                                        {{-- filled by jquery --}}
                                </ul>
                              </div>


                        </div>
                    </div>


            </div>
        </div>
    </div>
    {{-- task cart  --}}
    <div class="col-span-12 lg:col-span-2">
        <div class="card p-1">
            <div id="cart" class="rounded">
                <h4 class="text-center">{{trans('employer::employer.TaskCost')}}</h4>
                <span>{{trans('employer::employer.worker')}} <b id="count_worker">= 1</b></span>
                <br>
                <ul class="list-group" id="cart-items"></ul>
                <hr>
                <div class="text-center pt-2">
                    <span>{{trans('employer::employer.Total')}}</span>
                    <span class="fw-bold" id="cart-total">@if(app()->getLocale() =="ar") USD 0.00 @else 0.00 USD @endif</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="grid grid-cols-12 gap-5">
  <div class="col-span-12 lg:col-span-6">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <div class="col-span-12 py-2">
                        <label class="text-sm">{{ trans('employer::task.contOfWorkers') }}</label>
                        <input required step="1" min="1"  name="total_worker_limit" id="workerCount" value="1" class="w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="number" placeholder="{{ trans('employer::task.contOfWorkers') }}" >

                      </div>
                      <div class="col-span-12 py-2">
                        <label class="text-sm">{{ trans('employer::task.task_end_date') }}</label>
                        <input required step="1" min="{{ date('Y-m-d') }}"  name="task_end_date" id="workerCount" value="1" class="w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" type="date" placeholder="{{ trans('employer::task.task_end_date') }}" >
                      </div>
                      <div class="col-span-12">
                        <fieldset>
                          <div class="repeater-default">
                            <div data-repeater-list="TaskRegion">
                              <div id="test_repeater" data-repeater-item="">
                                <div class="mession-list form-group grid grid-cols-1 md:grid-cols-5 gap-4">
                                  <div>
                                    <label class="text-sm">{{ trans('employer::task.TaskCountry') }}</label>
                                    <select name="TaskRegion[0][Country]"
                                            class="country_repeater w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            required>
                                      <option>{{ trans('employer::task.pleas_select_country') }}</option>
                                      @if(count($countries) > 0)
                                        @foreach($countries as $country)
                                          <option value="{{ $country->id }}">
                                            {{ app()->getLocale() == 'ar' ? $country->ar_name : $country->name }}
                                          </option>
                                        @endforeach
                                      @else
                                        <option>{{ trans('employer::task.NoCountryFound') }}</option>
                                      @endif
                                    </select>
                                  </div>
                                  <div>
                                    <label class="text-sm">{{ trans('employer::task.TaskCity') }}</label>
                                    <select name="TaskRegion[0][City]" id="firstCity"
                                            required
                                            class="city-select city_repeater w-full py-2.5 placeholder:text-16 rounded-lg border-gray-100 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100">

                                      <option value="null">
                                        {{ trans('employer::task.pleas_select_country_to_fetch_cities') }}
                                      </option>
                                    </select>
                                  </div>
                                  <div>
                                    <span data-repeater-delete data-price="0"
                                          class="delete-country btn btn-danger btn-md">
                                      <i class="fas fa-trash opacity-10" aria-hidden="true"></i>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group grid grid-cols-1 md:grid-cols-1 mt-4">
                              <div>
                                <span data-repeater-create
                                      class="btn btn-success btn-md">
                                  <i class="fas fa-plus opacity-10" aria-hidden="true"></i>
                                  {{ trans('employer::task.add new countryAndCity') }}
                                </span>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                    </div>
                    <div>
                      @if($activeAndAvailableTasks < $limit_of_pin_to_top->pin_in_top_task_limit_count)
                        <div class="col-span-12">
                          <div class="col-span-12">
                            <div class="card m-2">
                              <div class="card-body p-3">
                                <div class="grid grid-cols-3">
                                  <div>
                                    <div class="form-check form-switch">
                                      <input class="form-check-input features toggle"
                                             name="special_access"
                                             data-price="{{ $pin_task_on_top->fees }}"
                                             type="checkbox"
                                             id="pinTaskTop_toggle"
                                             data-toggle="off">
                                    </div>
                                  </div>
                                  <div>
                                    <div class="text-center">
                                      <p class="text-sm mb-0 text-capitalize font-semibold">
                                        {{ trans('employer::task.pinTaskTop') }}
                                        <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="{{ trans('employer::task.pinTaskTopAvailableNowDescription') }} {{ $limit_of_pin_to_top->pin_in_top_task_limit_count }}"
                                           class="ni ni-bell-55 text-sm text-success opacity-10" aria-hidden="true"></i>
                                      </p>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="text-right">
                                      <span id="pinTaskTopValue" class="text-info text-capitalize font-semibold text-lg">
                                        {{ convertCurrency($pin_task_on_top->fees, auth()->user()->current_currency) }}
                                        <span class="text-xs text-body">{{ auth()->user()->current_currency }}</span>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @else
                        <div class="col-span-12">
                          <div class="col-span-12">
                            <div class="card m-2" style="background-color: #EBEBF0">
                              <div class="card-body p-3">
                                <div class="grid grid-cols-3">
                                  <div>
                                    <div class="form-check form-switch">
                                      <input class="form-check-input features toggle"
                                             name=""
                                             data-price="{{ $pin_task_on_top->fees }}"
                                             data-item="{{ trans('employer::task.pinTaskTop') }}"
                                             type="checkbox"
                                             id=""
                                             data-toggle="off" disabled>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="text-center">
                                      <p class="text-sm mb-0 text-capitalize font-semibold">
                                        {{ trans('employer::task.pinTaskTop') }}
                                        <i data-bs-toggle="tooltip" data-bs-placement="bottom"
                                           title="{{ trans('employer::task.pinTaskTopNotAvailableNowDescription') }} {{ $limit_of_pin_to_top->pin_in_top_task_limit_count }}"
                                           class="ni ni-bell-55 text-sm text-warning opacity-10" aria-hidden="true"></i>
                                      </p>
                                    </div>
                                  </div>
                                  <div>
                                    <div class="text-right">
                                      <span id="pinTaskTopValue" class="text-info text-capitalize font-semibold text-lg">
                                        {{ convertCurrency($pin_task_on_top->fees, auth()->user()->current_currency) }}
                                        <span class="text-xs text-body">{{ auth()->user()->current_currency }}</span>
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endif
                      <div class="col-span-12">
                        <div class="col-span-12">
                          <div class="card m-2">
                            <div class="card-body p-3">
                              <div class="grid grid-cols-3">
                                <div>
                                  <div class="form-check form-switch">
                                    <input class="form-check-input features toggle"
                                           name="only_professional"
                                           data-price="{{ $only_professional_worker->fees }}"
                                           data-item="{{ trans('employer::task.professionalOnly') }}"
                                           type="checkbox"
                                           id="professionalOnly_toggle"
                                           data-toggle="off">
                                  </div>
                                </div>
                                <div>
                                  <div class="text-center">
                                    <p class="text-sm mb-0 text-capitalize font-semibold">
                                      {{ trans('employer::task.professionalOnly') }}
                                    </p>
                                  </div>
                                </div>
                                <div>
                                  <div class="text-right">
                                    <span id="professionalOnlyValue" class="text-info text-capitalize font-semibold text-lg">
                                      {{ convertCurrency($only_professional_worker->fees, auth()->user()->current_currency) }}
                                      <span class="text-xs text-body">{{ auth()->user()->current_currency }}</span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-span-12">
                        <div class="col-span-12">
                          <div class="card m-2">
                            <div class="card-body p-3">
                              <div class="grid grid-cols-3">
                                <div>
                                  <div class="form-check form-switch">
                                    <input class="form-check-input features toggle"
                                           name="daily_limit_toggle"
                                           data-price="{{ $daily_limit_worker->fees }}"
                                           data-item="{{ trans('employer::task.worker_daily_limit') }}"
                                           type="checkbox"
                                           id="worker_daily_limit_toggle">
                                  </div>
                                </div>
                                <div>
                                  <div class="text-center">
                                    <p class="text-sm mb-0 text-capitalize font-semibold">
                                      {{ trans('employer::task.worker_daily_limit') }}
                                    </p>
                                  </div>
                                </div>
                                <div>
                                  <div class="text-right">
                                    <span id="worker_daily_limitValue" class="text-info text-capitalize font-semibold text-lg">
                                      {{ convertCurrency($daily_limit_worker->fees, auth()->user()->current_currency) }}
                                      <span class="text-xs text-body">{{ auth()->user()->current_currency }}</span>
                                    </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-span-12 mt-4 hidden" id="limitWorkerBox">
                        <label class="text-sm">{{ trans('employer::task.worker_daily_limit_input') }}</label>
                        <input id="worker_daily_limit_input" name="daily_limit"
                               min="1" step="1" value="1"
                               class="multisteps-form__input w-full form-input" type="number"
                               placeholder="{{ trans('employer::task.worker_daily_limit_input') }}"
                               onfocus="focused(this)" onfocusout="defocused(this)" disabled>
                      </div>
                    </div>
                  </div>

            </div>
        </div>
    </div>
</div>

    <script src="{{ asset('assets/Dashboard/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/js/pages/nav&tabs.js') }}"></script>
    <script src="{{ asset('assets/Dashboard/assets/js/app.js') }}"></script>
    <?php
    $current_currency = \Modules\Currency\Entities\Currency::withoutTrashed()->where('en_name', auth()->user()->current_currency)->first();
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Repeater JavaScript -->
    <script src="{{asset('assets/js/plugins/repeater/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/repeater/jquery.form-repeater.js')}}"></script>


    {{-- <script src="{{asset('assets/js/plugins/multistep-form.js')}}"></script> --}}
    <script>
        $(document).ready(function () {
            $('.select_category').click(function (e) {
                var category_id = $(this).attr('data-category-type');
                $('#category_id').val(category_id);
                // e.preventDefault();

        $.ajax({
        url: '{{ route("employer.fetch.category.actions", ["categoryType" => ":categoryType"]) }}'.replace(':categoryType', category_id),
        success: function (response) {
            if (response.length > 0) {
                document.getElementById('ActionMenu').classList.remove('hidden');
                $('#CategoryMenu').addClass('hidden').fadeOut(0);
                setTimeout(function () {
                    document.getElementById('CategoryMenu').classList.add('hidden');
                    document.getElementById('selectedCategory').classList.remove('hidden');
                    // document.getElementById('backToCategoryMenuBtn').classList.remove('hidden');
                    document.getElementById('category-menu-title').innerHTML = '{{ trans('employer::task.pleas_select_category_actions') }}';
                }, 0);
                response.forEach(function (actions) {
                    var en_action =
                    '<div class="col-span-12 lg:col-span-4" >'+
                            '<div class="bg-green-50 dark:bg-zinc-600 dark:text-gray-100 rounded-md shadow-md">'+
                            '<div class="px-3 mx-2 rtl:float-left ltr:float-right">'+
                            '<div class="form-check"><input type="checkbox" name="' + 'CategoryAction[' + actions.id + '][toggle]' + '"' + 'data-price="' + actions.price + '"' + 'data-item="' + actions.name + '"' + ' type="checkbox" data-toggle="off" class="form-check-input features toggle rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="formrow-customCheck"><label class="ltr:ml-2 rtl:mr-2 font-medium text-gray-700 dark:text-zinc-100" for="formrow-customCheck" >'+ ((actions.name.length > 50) ? actions.name.slice(0, 50) + "..." : actions.name) +'</label>'+
                            '<span class="text-sm">' + (actions.price * {{$current_currency->rate}}).toFixed(2) +
                            '<span class="text-3xs">' + ' {{$current_currency->en_name}} ' + '</span>' +
                            '</span>' +
                            '</div>'+
                            '</div>' +
                            '</div>' +
                            '</div>' ;


                        var ar_action = '<div class="col-span-12 lg:col-span-4" >'+
                            '<div class="bg-green-50 dark:bg-zinc-600 dark:text-gray-100 rounded-md shadow-md">'+
                            '<div class="px-3 mx-2 rtl:float-left ltr:float-right">'+
                            '<div class="form-check"><input type="checkbox" name="' + 'CategoryAction[' + actions.id + '][toggle]' + '"' + 'data-price="' + actions.price + '"' + 'data-item="' + actions.ar_name + '"' + ' type="checkbox" data-toggle="off" class="form-check-input features toggle rounded align-middle focus:ring-0  focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="formrow-customCheck"><label class="ltr:ml-2 rtl:mr-2 font-medium text-gray-700 dark:text-zinc-100" for="formrow-customCheck" >'+ ((actions.ar_name.length > 50) ? actions.ar_name.slice(0, 50) + "..." : actions.ar_name) +'</label>'+
                            '<span class="text-sm">' + (actions.price * {{$current_currency->rate}}).toFixed(2) +
                            '<span class="text-3xs">' + ' {{$current_currency->en_name}} ' + '</span>' +
                            '</span>' +
                            '</div>'+
                            '</div>' +
                            '</div>' +
                            '</div>' ;




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
@stop
