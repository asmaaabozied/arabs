@extends('dashboard::layouts.employer.master')
@section('content')
    <div class="row bg-white">
        <div class="card-body px-0 pb-0">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-list">
                    <thead class="thead-light">
                    <tr class="bg-table">
                        <th>#</th>
                        <th class="text-sm">{{trans('employer::task.basicInformation')}}</th>
                        <th class="text-sm">{{trans('employer::task.task_created_at')}}</th>
                        <th class="text-sm">{{trans('employer::task.total_task_cost')}}</th>
                        <th class="text-sm">{{trans('employer::task.The_amount_required')}}</th>
                        <th class="text-sm">{{trans('employer::task.Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($unPayedTasks) and count($unPayedTasks) > 0)
                        <?php $count = 1?>
                        @foreach($unPayedTasks as $datum)
                            <tr>
                                <td class="text-center text-center text-sm">{{$count++}} </td>
                                <td class="text-center align-middle text-center">
                                    <div class="d-flex justify-content-center px-2 py-1">
                                        <div>
                                            @if($datum->category->image != Null)
                                                <img src="{{Storage::url($datum->category->image)}}"
                                                     class="avatar avatar-sm me-3" alt="category icon">
                                            @else
                                                <img
                                                    src="{{asset('assets/img/category/'.$datum->category->title.'.png')}}"
                                                    class="avatar avatar-sm me-3" alt="category icon">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$datum->task_number}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ Str::words($datum->title, 3,'...')}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-center text-sm  "><span
                                        class="badge  bg-gradient-info">{{$datum->created_at->diffForHumans()}}</span>
                                </td>

                                <td class="text-center text-lg text-dark"><span class="badge  bg-gradient-secondary">
                                    {{ convertCurrency($datum->total_cost, auth()->user()->current_currency) }}
                                    <span class="text-xxs">{{auth()->user()->current_currency}}</span>
                                    </span>
                                </td>
                                  @if(convertCurrency($datum->total_cost, auth()->user()->current_currency) <= convertCurrency(auth()->user()->wallet_balance, auth()->user()->current_currency))
                                    <td class="text-center text-sm text-primary "><span class="badge  bg-gradient-primary">{{trans('employer::task.WalletContainsEnoughMoney')}}</span>
                                    </td>
                                @else
                                    <td class="text-center text-lg text-primary "><span class="badge  bg-gradient-primary">{{convertCurrency($datum->total_cost, auth()->user()->current_currency) - convertCurrency(auth()->user()->wallet_balance, auth()->user()->current_currency)}} <span class="text-xxs">{{auth()->user()->current_currency}}</span></span>
                                    </td>
                                @endif
                                <td class="text-center text-sm">
                                    <a href="{{route('employer.show.not.payed.tasks.details',[$datum->id,$datum->task_number])}}"
                                       class="mx-1"
                                       data-bs-toggle="tooltip"
                                       data-bs-original-title="Preview product">
                                        <i class="fas fa-eye text-primary"></i>
                                        <span class="text-primary">{{trans('employer::task.showDetails')}}</span>
                                    </a>

                                    @if($datum->total_cost <=auth()->user()->wallet_balance)
                                        <a href="{{route('check.if.wallet.contains.enough.money.to.pay.task',[$datum->id,$datum->task_number])}}"
                                           class="mx-1"
                                           data-bs-toggle="tooltip"
                                           data-bs-original-title="Pay With Wallet Balance">
                                            <i class="fas fa-wallet text-success"></i>
                                            <span class="text-success"> {{trans('employer::task.pay')}}</span>

                                        </a>
                                    @else
                                        <a class="mx-1"
                                           style="cursor:pointer"
                                           onclick="event.preventDefault();
                                         document.getElementById('payment-form').submit();"
                                           data-bs-toggle="tooltip"
                                           data-bs-original-title="Preview product">

                                            <i class="fas fa-money-check-alt text-success"></i>
                                            <span class="text-success">{{trans('employer::task.charge_wallet')}}</span>
                                        </a>
                                        <form id="payment-form"
                                              action="{{route('employer.charge.wallet.by.task.cost',[$datum->id,$datum->task_number])}}"
                                              method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endif


                                    <a href="{{route('employer.delete.not.payed.task',[$datum->id,$datum->task_number])}}"
                                       class="mx-1"
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
                            <div class="text-warning text-center">{{trans('employer::task.NoUnPayedTasks')}}</div>
                        </td>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop
