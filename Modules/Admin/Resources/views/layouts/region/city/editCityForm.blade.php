@extends('dashboard::layouts.admin.master')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <form class="p-2" action="{{route('admin.update.city',$data->id)}}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($errors->has('name'))

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('name') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if($errors->has('ar_name'))

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('ar_name') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                            @if($errors->has('min_city_cost'))

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('min_city_cost') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if($errors->has('country_id'))

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{trans('employer::task.Error!')}}</strong> {{ $errors->first('country_id') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        <div class="row gx-4">
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="example-search-input"
                                           class="form-control-label">{{trans('admin::admin.country_name')}}</label>
                                    <select name="country_id"
                                            class="  form-control "
                                            required>
                                        <option class="bg-primary" selected value="{{$data->country_id}}">{{$data->country->name}}</option>
                                        @if(count($countries) > 0)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        @else
                                            <option>{{trans('employer::task.NoCountryFound')}}</option>

                                        @endif

                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="example-search-input"
                                           class="form-control-label">{{trans('admin::admin.city_en_name')}}</label>

                                    <input class="form-control" placeholder="{{trans('admin::admin.city_en_name')}}"
                                           value="{{$data->name}}" name="name" type="text"
                                           id="example-search-input">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="example-email-input"
                                           class="form-control-label">{{trans('admin::admin.city_ar_name')}}</label>

                                    <input class="form-control" placeholder="{{trans('admin::admin.city_ar_name')}}"
                                           type="text" name="ar_name"
                                           value="{{$data->ar_name}}" id="example-email-input">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="example-email-input"
                                           class="form-control-label">{{trans('admin::admin.min_city_cost')}}</label>
                                    <input class="form-control" min="0.01" step="0.01"
                                           placeholder="{{trans('admin::admin.min_city_cost')}}" type="number"
                                           name="min_city_cost"
                                           value="{{$data->min_city_cost}}" id="example-email-input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" d-lg-flex d-md-flex justify-content-between">
                        <button type="submit"
                                class="btn bg-gradient-primary w-auto">{{trans('admin::admin.update_city')}}</button>
                        <a href="{{route('admin.cities.index')}}" class="btn bg-gradient-secondary w-auto">{{trans('admin::admin.back')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
