@extends('dashboard::layouts.employer.master')
@section('content')

    <div class="row bg-white">
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-list">
                    <thead class="thead-light">
                    <tr class="bg-table">
                        <th>#</th>
                        <th>{{trans('employer::task.basicInformation')}}</th>
                        <th>{{trans('employer::task.task_created_at')}}</th>
                        <th>{{trans('employer::task.total_worker_limit')}}</th>
                        <th>{{trans('employer::task.task_end_date')}}</th>
                        <th>{{trans('employer::task.Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($data) and $data->count()>0)
                        <?php $count = 1?>
                        @foreach($data as $datum)
                            <tr>
                                <td class="text-center text-center text-sm">{{$count++}} </td>
                                <td class="text-center align-middle text-center">
                                    <div class="d-flex justify-content-center px-2 py-1">
                                        <div>
                                            @if($datum->category->image != Null)
                                                <img src="{{Storage::url($datum->category->image)}}" class="avatar avatar-sm me-3" alt="category icon">
                                            @else
                                                <img src="{{asset('assets/img/category/'.$datum->category->title.'.png')}}" class="avatar avatar-sm me-3" alt="category icon">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$datum->task_number}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::words($datum->title, 3,'...') }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-center text-sm  "><span class="badge  bg-gradient-info">{{$datum->created_at->diffForHumans()}}</span> </td>

                                <td class="text-center text-sm text-secondary">  {{$datum->total_worker_limit}} </td>
                                <td class="text-center text-sm ">{{$datum->task_end_date}}</td>

                                <td class="text-center text-sm">
                                    <a href="{{route('employer.show.task.details.after.create',[$datum->id,$datum->task_number])}}" class="mx-1"
                                       data-bs-toggle="tooltip"
                                       data-bs-original-title="Preview product">
                                        <i class="fas fa-eye text-primary"></i>
                                        <span class="text-primary">{{trans('employer::task.showDetails')}}</span>
                                    </a>
{{--                                    <a href="{{route('employer.submit.and.save.task',[$datum->id,$datum->task_number])}}" class="mx-1"--}}
{{--                                       data-bs-toggle="tooltip"--}}
{{--                                       data-bs-original-title="Preview product">--}}
{{--                                        <i class="fas fa-check text-success"></i>--}}
{{--                                        <span class="text-success">{{trans('employer::task.publishTask')}}</span>--}}

{{--                                    </a>--}}
                                    <a href="{{route('employer.delete.not.published.task',[$datum->id,$datum->task_number])}}" class="mx-1"
                                       data-bs-toggle="tooltip"
                                       data-bs-original-title="Preview product">
                                        <i class="fas fa-trash text-danger"></i>
                                        <span class="text-danger"> {{trans('employer::task.delete')}}</span>

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="6">
                            <div class="text-warning text-center">{{trans('employer::task.NoNotPublishedTasks')}}</div>
                        </td>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop
