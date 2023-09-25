<?php

namespace Modules\Employer\Http\Controllers\Transaction;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Entities\Employer;
use Modules\Employer\Http\Requests\EmployerChargeWalletRequest;
use Modules\Privilege\Entities\EmployerPrivilege;
use Modules\Privilege\Entities\Privilege;
use Modules\Setting\Entities\Setting;
use Modules\Transaction\Entities\EmployerTransaction;
use Omnipay\Omnipay;

class PayPalController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');

        //For Live PayPal This Must Be Change To PAYPAL_CLIENT_ID
        $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));

        //For Live PayPal This Must Be Change To PAYPAL_CLIENT_SECRET
        $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));

        //For Live PayPal This Must Be Change To false
        $this->gateway->setTestMode(true);
    }

    public function employer()
    {
        $employer = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        return $employer;
    }
    public function setting(){
        $setting = Setting::select('fees_per_charge_wallet_using_paypal')->first();
        return $setting;
    }

    public function showChargeWalletForm()
    {

        $page_name = "ArabWorkers | Employers - Charge Wallet";
        $main_breadcrumb = "Employer Panel";
        $sub_breadcrumb = "Charge Wallet";
        $my_wallet_balance = $this->employer()->wallet_balance;
        $fees_per_charge_wallet_using_paypal = $this->setting()->fees_per_charge_wallet_using_paypal;
        return view('employer::layouts.transaction.chargeWallet', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'my_wallet_balance',
            'fees_per_charge_wallet_using_paypal',
        ]));
    }

//    Start Charge Wallet Method
    public function chargeWallet(EmployerChargeWalletRequest $request)
    {
        $validated = $request->validated();
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $validated['amount'],
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => route('employer.payment.success'),
                'cancelUrl' => route('employer.payment.error')
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            } else {
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


//    Action After Payment Success
//    1. Update Wallet Balance
//    2. Send Mail To Employer With Success Payment Information
    public function successPay(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));
            $response = $transaction->send();
            if ($response->isSuccessful()) {
                $setting = $this->setting();
                $arr = $response->getData();
                $pay_amount = $arr['transactions'][0]['amount']['total'];
                $fess_per_charge = $setting->fees_per_charge_wallet_using_paypal;
                $pay_amount_after_fees = $pay_amount - ($pay_amount * $fess_per_charge / 100);
                /**
                 * Update Employer Wallet Balance
                 */
                $new_wallet_balance = $this->employer()->wallet_balance + $pay_amount_after_fees;

                $this->employer()->update([
                    'wallet_balance' => $new_wallet_balance,
                ]);
                /**
                 * Save Transaction Information
                 */
                EmployerTransaction::create([
                    'employer_id' => $this->employer()->id,
                    'payment_id' => $arr['id'],
                    'payer_id' => $arr['payer']['payer_info']['payer_id'],
                    'payer_email' => $arr['payer']['payer_info']['email'],
                    'amount' => $pay_amount_after_fees,
                    'currency' => env('PAYPAL_CURRENCY'),
                ]);
                /**
                 *  plus privileges
                 */
                $privilege = Privilege::withoutTrashed()->where([
                    ['code', 'CWB'],
                    ['for', 'employer'],
                ])->first();
                EmployerPrivilege::create([
                    'employer_id' =>  $this->employer()->id,
                    'count_of_privileges' => $privilege->privileges,
                    'type' => $privilege->type,
                    'description' => $privilege->title,
                ]);

                /**
                 *  Send Mail To Employer With Success Payment Information
                 */
//                //
//                $confirm_wallet_recharge_data = [
//                    'user_name' => $user_name,
//                    'payment_id' => $new_transaction->payment_id,
//                    'payer_id' => $new_transaction->payer_id,
//                    'payer_email' =>$new_transaction->payer_email,
//                    'pay_date' => $new_transaction->created_at,
//                    'recharged_amount' => $pay_amount,
//                    'total_amount' => $pay_amount
//                ];
//                Mail::to("$user_email")->send(new ConfirmWalletRechargeMail($confirm_wallet_recharge_data));
//
                /**
                 * Save Email In DataBase
                 */
//                // Save Data to Email Log
//                $new_email = Email::create([
//                    'subject' => 'Wallet Recharged Successfully',
//                    'from_email' => env('MAIL_FROM_ADDRESS'),
//                    'to_email' => $user_email
//                ]);
//                $new_email->save();

                alert()->toast(trans('employer::employer.Your wallet has been successfully charged'), 'success');

                return redirect()->route('employer.show.my.wallet.history');
            } else {
                return $response->getMessage();
            }
        } else {
            alert()->toast(trans('employer::employer.The payment has been cancelled, but thats okay, you can create your own task and you will find it in the unpaid tasks section and you can pay for it later'), 'error');
            return redirect()->route('employer.show.charge.wallet.form');
        }
    }

    public function errorPay()
    {

        alert()->toast(trans('employer::employer.The payment has been cancelled, but thats okay, you can create your own task and you will find it in the unpaid tasks section and you can pay for it later'), 'error');

        return redirect()->route('employer.show.charge.wallet.form');
    }
}
