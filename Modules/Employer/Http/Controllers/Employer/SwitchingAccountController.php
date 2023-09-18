<?php

namespace Modules\Employer\Http\Controllers\Employer;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Employer\Entities\Employer;
use Modules\Employer\Http\Requests\SwitchToWorkerAndTransferWalletBalanceRequest;
use Modules\Privilege\Entities\EmployerPrivilege;
use Modules\Privilege\Entities\Privilege;
use Modules\Setting\Entities\Setting;
use Modules\SwitchAccount\Entities\AccountSwitchOperation;
use Modules\Worker\Entities\Worker;

class SwitchingAccountController extends Controller
{
    protected function guard()
    {
        return Auth::guard('employer');
    }

    protected function workerGuard()
    {
        return Auth::guard('worker');
    }

    public function getCurrentLang()
    {
        $current_lange = Session::get('applocale');
        if ($current_lange != null) {
            $lang = $current_lange;
        } else {
            $lang = "ar";
        }

        return $lang;
    }
    public function switchToWorker(Request $request)
    {
        $currently_employer = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        $check_is_worker = Worker::withoutTrashed()->where([
            ['email', $currently_employer->email],
        ])->first();
        if ($check_is_worker == null and $currently_employer->google_id == null) {
            $random_worker_number = "W" . Carbon::now()->format('ym') . Str::random(1) . Carbon::now()->format('s') . Str::random(2) . random_int(10, 99);
            $worker = Worker::create([
                'worker_number' => $random_worker_number,
                'name' => $currently_employer->name,
                'email' => $currently_employer->email,
                'avatar' => $currently_employer->avatar,
                'country_id' => $currently_employer->country_id,
                'city_id' => $currently_employer->city_id,
                'phone' => $currently_employer->phone,
                'gender' => $currently_employer->gender,
                'address' => $currently_employer->address,
                'zip_code' => $currently_employer->zip_code,
                'password' => $currently_employer->password,
            ]);

            AccountSwitchOperation::create([
                'from' => 'employer',
                'to' => 'worker',
                'employer_id' => $currently_employer->id,
                'worker_id' => $worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);


            /**
             *  plus privileges
             */
            $privilege = Privilege::withoutTrashed()->where([
                ['code', 'HDA'],
                ['for', 'dual'],
            ])->first();
            EmployerPrivilege::create([
                'employer_id' => $currently_employer->id,
                'count_of_privileges' => $privilege->privileges,
                'type' => $privilege->type,
                'description' => $privilege->title,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->workerGuard()->login($worker);
            Session::put('applocale', $lang);
            alert()->toast(trans('employer::employer.You have been successfully Account SwitchingToWorker'), 'success');
            return redirect()->route('show.worker.panel');
        } elseif ($check_is_worker == null and $currently_employer->google_id != null) {
            $random_worker_number = "W" . Carbon::now()->format('ym') . Str::random(1) . Carbon::now()->format('s') . Str::random(2) . random_int(10, 99);
            $worker = Worker::create([
                'worker_number' => $random_worker_number,
                'name' => $currently_employer->name,
                'email' => $currently_employer->email,
                'email_verified_at' => $currently_employer->email_verified_at,
                'avatar' => $currently_employer->avatar,
                'country_id' => $currently_employer->country_id,
                'city_id' => $currently_employer->city_id,
                'phone' => $currently_employer->phone,
                'gender' => $currently_employer->gender,
                'address' => $currently_employer->address,
                'zip_code' => $currently_employer->zip_code,
                'password' => $currently_employer->password,
                'google_id' => $currently_employer->google_id,
            ]);

            AccountSwitchOperation::create([
                'from' => 'employer',
                'to' => 'worker',
                'employer_id' => $currently_employer->id,
                'worker_id' => $worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);
            $privilege = Privilege::withoutTrashed()->where([
                ['code', 'HDA'],
                ['for', 'dual'],
            ])->first();
            EmployerPrivilege::create([
                'employer_id' => $currently_employer->id,
                'count_of_privileges' => $privilege->privileges,
                'type' => $privilege->type,
                'description' => $privilege->title,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->workerGuard()->login($worker);
            Session::put('applocale', $lang);
            alert()->toast(trans('employer::employer.You have been successfully Account SwitchingToWorker'), 'success');
            return redirect()->route('show.worker.panel');
        } else {
            AccountSwitchOperation::create([
                'from' => 'employer',
                'to' => 'worker',
                'employer_id' => $currently_employer->id,
                'worker_id' => $check_is_worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->workerGuard()->login($check_is_worker);
            Session::put('applocale', $lang);
            alert()->toast(trans('employer::employer.You have been successfully Account SwitchingToWorker'), 'success');
            return redirect()->route('show.worker.panel');
        }

    }



    public function history()
    {
        $page_name = "ArabWorkers | Employers - Switching Account History";
        $main_breadcrumb = "Employer Panel";
        $sub_breadcrumb = "Switching Account History";
        $my_employer_account = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        $check_dual_account = Worker::withoutTrashed()->where([
            ['email', $my_employer_account->email],
            ['country_id', $my_employer_account->country_id],
            ['city_id', $my_employer_account->city_id],
            ['phone', $my_employer_account->phone],
        ])->first();
        if (isset($check_dual_account)) {
            $data = AccountSwitchOperation::withoutTrashed()
                ->where([
                    ['employer_id', $my_employer_account->id],
                    ['worker_id', $check_dual_account->id],
                    ['from', 'employer'],
                    ['to', 'worker'],
                ])->orWhere([
                    ['employer_id', $my_employer_account->id],
                    ['worker_id', $check_dual_account->id],
                    ['from', 'worker'],
                    ['to', 'employer'],
                ])->orderByDesc('created_at')->get();
        } else {
            $data = null;
        }

//       dd($data);
        return view('employer::layouts.switchingAccount.history', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'data',

        ]));
    }

    public function showSwitchToWorkerAndTransferWalletBalanceForm()
    {
        $page_name = "ArabWorkers | Employers - Switching Account With Transfer Wallet Balance";
        $main_breadcrumb = "Employer Panel";
        $sub_breadcrumb = "Switching Account With Transfer Wallet Balance";
        $my_employer_account = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        $check_dual_account = Worker::withoutTrashed()->where([
            ['email', $my_employer_account->email],
            ['country_id', $my_employer_account->country_id],
            ['city_id', $my_employer_account->city_id],
            ['phone', $my_employer_account->phone],
        ])->first();

        if ($check_dual_account == null) {
            alert()->toast(trans('employer::employer.You dont have a dual account, first create a dual account so you can send and receive money to and from it'), 'warning');
            return redirect()->route('employer.show.switching.account.history');
        } else {
            /**
             * In this step we are sure that the employer has a dual account and can transfer the money to his worker account
             **/
            $my_worker_account = Worker::withoutTrashed()->findOrFail($check_dual_account->id);
            $my_balance_in_employer_wallet = $my_employer_account->wallet_balance;
            $my_balance_in_worker_wallet = $my_worker_account->wallet_balance;
            $fees_by_transfer_wallet_balance = Setting::select('fees_per_transfer_wallet_balance')->first();

            return view('employer::layouts.switchingAccount.switchAccountWithTransferWalletBalanceForm', compact([
                'page_name',
                'main_breadcrumb',
                'sub_breadcrumb',
                'my_balance_in_employer_wallet',
                'my_balance_in_worker_wallet',
                'fees_by_transfer_wallet_balance',
            ]));
        }

    }

    public function switchToWorkerAndTransferWalletBalance(SwitchToWorkerAndTransferWalletBalanceRequest $request)
    {

        $validated = $request->validated();

        $my_employer_account = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        $check_dual_account = Worker::withoutTrashed()->where([
            ['email', $my_employer_account->email],
            ['country_id', $my_employer_account->country_id],
            ['city_id', $my_employer_account->city_id],
            ['phone', $my_employer_account->phone],
        ])->first();

        if ($check_dual_account == null) {
            alert()->toast(trans('employer::employer.An error has occurred Please check the entered data and try again'), 'error');
            return redirect()->route('employer.show.switch.account.to.worker.with.transfer.wallet.balance.form');
        } else {
            /**
             * In this step we are sure that the employer has a dual account and can transfer the money to his worker account
             **/
            $my_worker_account = Worker::withoutTrashed()->findOrFail($check_dual_account->id);
            $fees_by_transfer_wallet_balance = Setting::select('fees_per_transfer_wallet_balance')->first();

            $check_if_there_is_balance_in_employer_wallet = $my_employer_account->wallet_balance - $validated['AmountTransferred'];
            if ($check_if_there_is_balance_in_employer_wallet < 0) {
                /**
                 * This means that the wallet does not have enough funds to transfer the required amount
                 **/
                alert()->toast(trans('employer::employer.the employer wallet account does not have enough funds to transfer the required amount'), 'error');
                return redirect()
                    ->route('employer.show.switch.account.to.worker.with.transfer.wallet.balance.form')
                    ->with(['error' => trans('employer::employer.the employer wallet account does not have enough funds to transfer the required amount')]);
            } else {
                $my_employer_account->update([
                    'wallet_balance' => $my_employer_account->wallet_balance - $validated['AmountTransferred'],
                    'total_spends' => $my_employer_account->total_spends + $validated['AmountTransferred'],
                ]);
                $AmountTransferredAfterFees = $validated['AmountTransferred'] - ($validated['AmountTransferred'] * $fees_by_transfer_wallet_balance->fees_per_transfer_wallet_balance / 100);

                /**
                 * Here, the profits from the transferred amount must be recorded in the profit records of the admins
                 * and must be recorded  the amount withdrawn from the employer and sent to the worker in a record for this process
                 **/
                $my_worker_account->update([
                    'wallet_balance' => $my_worker_account->wallet_balance + $AmountTransferredAfterFees,
                    'total_earns' => $my_worker_account->total_earns + $AmountTransferredAfterFees,
                ]);

                AccountSwitchOperation::create([
                    'from' => 'employer',
                    'to' => 'worker',
                    'employer_id' => $my_employer_account->id,
                    'worker_id' => $my_worker_account->id,
                    'isTransferWalletBalance' => 'true',
                    'transferred_amount' => $AmountTransferredAfterFees,
                ]);
                $lang = $this->getCurrentLang();
                Session::put('applocale', $lang);
                $this->guard()->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $this->workerGuard()->login($my_worker_account);
                Session::put('applocale', $lang);
                alert()->toast(trans('employer::employer.You have been successfully Account SwitchingToWorker And Transferred Balance'), 'success');
                return redirect()->route('worker.show.main.page');
            }


        }

    }

}
