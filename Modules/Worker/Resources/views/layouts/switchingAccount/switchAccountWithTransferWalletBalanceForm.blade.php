@extends('dashboard::layouts.worker.master')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-info shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-info  mb-0">{{trans('worker::worker.walletBalanceWorkerAccount')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-info mb-0" id="worker_wallet_balance">
                                        {{$my_balance_in_worker_wallet}} $
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                                        <i class="fa fa-exchange-alt" aria-hidden="true"></i>
                                        {{--                                        <i class="	fas fa-sync-alt"  aria-hidden="true"></i>--}}
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-warning  mb-0">{{trans('worker::worker.fees_per_transfer_wallet_balance')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-warning mb-0">
                                        {{$fees_by_transfer_wallet_balance->fees_per_transfer_wallet_balance}} %
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-primary  mb-0">{{trans('worker::worker.walletBalanceEmployerAccount')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-primary mb-0" id="employer_wallet_balance">
                                        {{$my_balance_in_employer_wallet}} $
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
        @if($errors->has('AmountTransferred'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{trans('worker::worker.Error!')}}</strong> {{ $errors->first('AmountTransferred') }}</span>
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
        <form method="POST" action="{{route('worker.switch.account.to.employer.with.transfer.wallet.balance')}}"
              enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-gradient-white">
                        <div class="card-body p-3">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="numbers mb-2">
                                        <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('worker::worker.amountYouWantTransferredToEmployerWallet')}}</p>
                                    </div>
                                    <input class="multisteps-form__input form-control" step="0.1"
                                           value="0.00"
                                           type="number"
                                           min="0.0"
                                           max="{{$my_balance_in_worker_wallet}}"
                                           name="AmountTransferred"
                                           id="amount_input"
                                           placeholder="{{trans('worker::worker.AmountTransferred')}}"
                                           onfocus="focused(this)"
                                           onfocusout="defocused(this)">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="numbers mb-2">
                                        <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('worker::worker.amountTransferredAfterFees')}}</p>
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
                                        class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
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
                            class="btn btn-success btn-lg w-100   mb-2">{{trans('worker::worker.SwitchAccountAndTransferWalletBtn')}}</button>
                </div>
                <div class="button-row ">
                    <a href="{{route('worker.show.switching.account.history')}}"
                       class="btn btn-dark btn-lg w-100   mb-2">{{trans('worker::worker.back')}}</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on('input', '#amount_input', function () {
            var fees = {{$fees_by_transfer_wallet_balance->fees_per_transfer_wallet_balance}};
            var EmployerWalletBalance = {{$my_balance_in_employer_wallet}};
            var WorkerWalletBalance = {{$my_balance_in_worker_wallet}};
            var Amount = document.getElementById('amount_input').value;
            document.getElementById("worker_wallet_balance").innerHTML = Number(WorkerWalletBalance - Amount ).toFixed(2) + " $";
            document.getElementById("employer_wallet_balance").innerHTML = Number((EmployerWalletBalance + (Amount - (Amount * fees / 100))) .toFixed(2)) + " $";
            document.getElementById("amount_transferred_after_fees").value = Number(Amount - (Amount * fees / 100)).toFixed(2) + " $";
        });
    </script>
@stop
