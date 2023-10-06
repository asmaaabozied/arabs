@extends('dashboard::layouts.worker.master')
@section('content')
    <div class="row bg-white mt-4">
        <div class="card-body px-0 pb-0">
            <div class="text-left">
                <a href="{{route('worker.show.my.withdraw.using.paypal.form')}}"  class="btn bg-gradient-primary w-auto m-4">{{trans('worker::worker.PayOutWalletBtn')}} </a>
            </div>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-list">
                    <thead class="thead-light">
                    <tr>
                        <th><span class="mx-2">#</span></th>
                        <th>{{trans('worker::worker.transactionsDetails')}}</th>
                        <th>{{trans('worker::worker.TypeOfTransaction')}}</th>
                        <th>{{trans('worker::worker.TransactionAmount')}}</th>
                        <th>{{trans('worker::worker.TransactionAt')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($sortedTransactions) and $sortedTransactions!=null)
                        <?php $count = 1?>
                        @foreach($sortedTransactions as $transaction)
                            <tr>
                                <td class="text-center text-sm">{{$count++}} </td>
                                    <td class="align-middle text-center text-sm">
                                    <span
                                        class="text-dark font-weight-bold  text-sm">{{trans('worker::worker.'.$transaction['amount_transaction'])}} </span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                    <span
                                        class="badge {{$transaction['type_of_pay']}} text-xs">{{trans('worker::worker.'.$transaction['type_of_pay'])}}  </span>
                                    </td>
                                @if($transaction['type_of_pay'] == "Deposit")
                                    <td class="align-middle text-center text-sm">
                                    <span
                                        class="text-success font-weight-bold  text-sm">+
                                        {{ number_format(convertCurrency($transaction['amount'], auth()->user()->current_currency),2) }}
                                        <span class="text-xxs">{{auth()->user()->current_currency}}</span>
                                         </span>
                                    </td>
                                @else
                                    <td class="align-middle text-center text-sm">
                                    <span
                                        class="text-danger font-weight-bold text-sm">-
                                        {{ number_format(convertCurrency($transaction['amount'], auth()->user()->current_currency),2) }}
                                        <span class="text-xxs">{{auth()->user()->current_currency}}</span>

                                    </span>
                                    </td>
                                @endif
                                <td class="text-sm text-center ">
                                    <span
                                        class="text-dark text-sm ">{{$transaction['payed_at']->diffForHumans()}}</span>

                                </td>

                            </tr>
                        @endforeach
                    @else
                        <td colspan="5">
                            <div
                                class="text-warning text-center">{{trans('worker::worker.No financial transaction has been registered yet')}}</div>
                        </td>
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@stop
