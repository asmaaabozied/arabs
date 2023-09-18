@extends('dashboard::layouts.employer.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-dark  mb-0">{{trans('employer::employer.CurrentlyEmployerWalletBalance')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-dark mb-0" id="employer_wallet_balance">
                                        {{$my_wallet_balance}} $
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12 mt-lg-1 mt-4">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                                        <i class="fa fa-wallet opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center text-success  mb-0">{{trans('employer::employer.EmployerWalletBalanceAfterCharge')}}</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="font-weight-bolder text-success mb-0" id="wallet_balance_after_charge">
                                        {{$my_wallet_balance}} $
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
                <span class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{ $errors->first('amount') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <span
                                            class="alert-text"><strong>{{trans('employer::employer.Error!')}}</strong> {{Session::get('error')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form method="POST" action="{{route('employer.payment.with.paypal')}}"
              enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card bg-gradient-white">
                        <div class="card-body p-3">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="numbers mb-2">
                                        <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('employer::employer.amountYouWantCharged')}}</p>
                                    </div>
                                    <input class="multisteps-form__input form-control" step="0.1"
                                           value="0.00"
                                           type="number"
                                           min="0.0"
                                           name="amount"
                                           id="amount_input"
                                           placeholder="{{trans('employer::employer.amountYouWantCharged')}}"
                                           onfocus="focused(this)"
                                           onfocusout="defocused(this)">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="numbers mb-2">
                                        <p class="text-sm mb-0 text-capitalize  font-weight-bold">{{trans('employer::employer.amountChargedAfterPayPalFees')}}
                                            ({{$fees_per_charge_wallet_using_paypal}}%)</p>
                                    </div>
                                    <input class="multisteps-form__input form-control"
                                           value="0.0 $"
                                           type="text"
                                           id="amount_charged_after_fees"
                                           placeholder="{{trans('employer::employer.amountChargedAfterFees')}}"
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
                            class="btn btn-success btn-lg w-100   mb-2">{{trans('employer::employer.ChargeWalletBtn')}}</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on('input', '#amount_input', function () {
            var fees = {{$fees_per_charge_wallet_using_paypal}};
            var EmployerWalletBalance = {{$my_wallet_balance}};
            var Amount = document.getElementById('amount_input').value;
            var totalSum = (Number(EmployerWalletBalance) + Number(Amount - (Amount*fees/100)));
            document.getElementById("wallet_balance_after_charge").innerHTML = totalSum + " $";
            document.getElementById("amount_charged_after_fees").value = Amount - (Amount*fees/100) + " $";
        });
    </script>
@stop
