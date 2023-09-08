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
use Modules\Privilege\Entities\EmployerPrivilege;
use Modules\Privilege\Entities\Privilege;
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

}
