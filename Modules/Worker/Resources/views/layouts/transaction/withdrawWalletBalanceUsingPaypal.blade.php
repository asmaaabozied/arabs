@extends('dashboard::layouts.worker.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-dark  mb-0">{{trans('worker::worker.CurrentlyWorkerWalletBalance')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-dark mb-0" id="worker_wallet_balance">
                                        {{$worker->wallet_balance}} $
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="fab fa-paypal opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center mb-0">{{trans('worker::worker.paypal_account')}} ({{$fees_per_withdraw_wallet_using_paypal}}%)</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0 text-primary">{{$worker->paypal_account??trans('worker::worker.not_paypal_account_set')}}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                        <i class="ni ni-sound-wave opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center mb-0">{{trans('worker::worker.min_withdraw_limit')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-warning mb-0">
                                        {{$min_withdraw}} $
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-danger shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-dark  mb-0">{{trans('worker::worker.WorkerWalletBalanceAfterWithdraw')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-danger mb-0" id="wallet_balance_after_withdraw">
                                       {{$worker->wallet_balance}} $
                                    </h5>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        @if($errors->has('amount'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('worker::worker.Error!')}}</strong> {{ $errors->first('amount') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span
                                            class="alert-text"><strong>{{trans('worker::worker.Error!')}}</strong> {{Session::get('error')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            @if($worker->wallet_balance >= $min_withdraw)
                <div class="alert alert-warning text-center text-lg alert-dismissible fade show mt-4" role="alert">
                    <span class="alert-text text-dark"><strong>{{trans('worker::worker.Attention!')}}</strong> {{trans('worker::worker.withdraw_to_paypal_attention')}} </span>
                </div>
                <form method="POST" action="{{route('worker.withdraw.profits.using.paypal')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-gradient-white">
                                <div class="card-body p-3">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="numbers mb-2">
                                                <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('worker::worker.amountYouWithdraw')}}</p>
                                            </div>
                                            <input class="multisteps-form__input form-control" step="0.5"
                                                   value="0"
                                                   type="number"
                                                   min="0"
                                                   max="{{$worker->wallet_balance}}"
                                                   name="amount"
                                                   id="amount_input"
                                                   placeholder="{{trans('worker::worker.amountYouWantWithdraw')}}"
                                                   onfocus="focused(this)"
                                                   onfocusout="defocused(this)">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <div class="numbers mb-2">
                                                <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('worker::worker.amountTransferredAfterPayPalTax')}} ({{$fees_per_withdraw_wallet_using_paypal}}%)</p>
                                            </div>

                                            <input class="multisteps-form__input form-control"
                                                   value="0.0 $"
                                                   type="text"
                                                   id="amount_transferred_after_fees"
                                                   placeholder="{{trans('worker::worker.amountTransferredAfterFees')}}"
                                                   onfocus="focused(this)"
                                                   onfocusout="defocused(this)"
                                                   disabled
                                            >
                                        </div>
                                        <div class="col-3 d-lg-block d-md-block   d-none text-end">
                                            <div
                                                class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                                <i class="fas fa-dollar-sign text-lg opacity-10" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="button-row ">
                            <button type="submit"
                                    class="btn btn-success btn-lg w-100   mb-2">{{trans('worker::worker.WithdrawBalanceBtn')}}</button>
                        </div>
                    </div>
                </form>
            @else

                <div class="alert alert-info text-center text-lg alert-dismissible fade show mt-4" role="alert">
                    <span class="alert-text text-dark"><strong>{{trans('worker::worker.Attention!')}}</strong> {{trans('worker::worker.min_withdraw_limit_attention')}} </span>
                </div>
            @endif

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on('input', '#amount_input', function () {
            var fees = {{$fees_per_withdraw_wallet_using_paypal}};
            var WorkerWalletBalance = {{$worker->wallet_balance}};
            var Amount = document.getElementById('amount_input').value;
            var RemainingAmount =  (Number(WorkerWalletBalance) - Number(Amount));
            document.getElementById("wallet_balance_after_withdraw").innerHTML =RemainingAmount + " $";
            document.getElementById("amount_transferred_after_fees").value = Number(Amount - (Amount * fees / 100)).toFixed(2) + " $";

        });
    </script>
@stop
