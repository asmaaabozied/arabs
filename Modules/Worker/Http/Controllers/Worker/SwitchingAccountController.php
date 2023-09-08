<?php

namespace Modules\Worker\Http\Controllers\Worker;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Modules\Employer\Entities\Employer;
use Modules\Privilege\Entities\Privilege;
use Modules\Privilege\Entities\WorkerPrivilege;
use Modules\SwitchAccount\Entities\AccountSwitchOperation;
use Modules\Worker\Entities\Worker;

class SwitchingAccountController extends Controller
{
    protected function guard()
    {
        return Auth::guard('worker');
    }
    protected function employerGuard()
    {
        return Auth::guard('employer');
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

    public function switchToEmployer(Request $request){
        $currently_worker = Worker::withoutTrashed()->findOrFail(auth()->user()->id);
        $check_is_employer = Employer::withoutTrashed()->where([
            ['email', $currently_worker->email],
        ])->first();
        if ($check_is_employer == null and $currently_worker->google_id == null) {
            $random_employer_number = "E" . Carbon::now()->format('ym') . Str::random(1) . Carbon::now()->format('s') . Str::random(2) . random_int(10, 99);
            $employer = Employer::create([
                'employer_number' => $random_employer_number,
                'name' => $currently_worker->name,
                'email' => $currently_worker->email,
                'avatar' => $currently_worker->avatar,
                'country_id' => $currently_worker->country_id,
                'city_id' => $currently_worker->city_id,
                'phone' => $currently_worker->phone,
                'gender' => $currently_worker->gender,
                'address' => $currently_worker->address,
                'zip_code' => $currently_worker->zip_code,
                'password' => $currently_worker->password,
            ]);

            AccountSwitchOperation::create([
                'from' => 'worker',
                'to' => 'employer',
                'employer_id' => $employer->id,
                'worker_id' => $currently_worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);
            $privilege = Privilege::withoutTrashed()->where([
                ['code', 'HDA'],
                ['for', 'dual'],
            ])->first();
            WorkerPrivilege::create([
                'worker_id' =>  $currently_worker->id,
                'count_of_privileges' => $privilege->privileges,
                'type' => $privilege->type,
                'description' => $privilege->title,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->employerGuard()->login($employer);
            Session::put('applocale', $lang);
            alert()->toast(trans('worker::worker.You have been successfully Account SwitchingToEmployer'), 'success');
            return redirect()->route('show.employer.panel');
        }elseif ($check_is_employer == null and $currently_worker->google_id != null){
            $random_employer_number = "E" . Carbon::now()->format('ym') . Str::random(1) . Carbon::now()->format('s') . Str::random(2) . random_int(10, 99);
            $employer = Employer::create([
                'employer_number' => $random_employer_number,
                'name' => $currently_worker->name,
                'email' => $currently_worker->email,
                'email_verified_at' => $currently_worker->email_verified_at,
                'avatar' => $currently_worker->avatar,
                'country_id' => $currently_worker->country_id,
                'city_id' => $currently_worker->city_id,
                'phone' => $currently_worker->phone,
                'gender' => $currently_worker->gender,
                'address' => $currently_worker->address,
                'zip_code' => $currently_worker->zip_code,
                'password' => $currently_worker->password,
                'google_id' => $currently_worker->google_id,
            ]);

            AccountSwitchOperation::create([
                'from' => 'worker',
                'to' => 'employer',
                'employer_id' => $employer->id,
                'worker_id' => $currently_worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);
            $privilege = Privilege::withoutTrashed()->where([
                ['code', 'HDA'],
                ['for', 'dual'],
            ])->first();
            WorkerPrivilege::create([
                'worker_id' =>  $currently_worker->id,
                'count_of_privileges' => $privilege->privileges,
                'type' => $privilege->type,
                'description' => $privilege->title,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->employerGuard()->login($employer);
            Session::put('applocale', $lang);
            alert()->toast(trans('worker::worker.You have been successfully Account SwitchingToEmployer'), 'success');
            return redirect()->route('show.employer.panel');
        }
        else {
            AccountSwitchOperation::create([
                'from' => 'worker',
                'to' => 'employer',
                'employer_id' => $check_is_employer->id,
                'worker_id' => $currently_worker->id,
                'isTransferWalletBalance' => 'false',
                'transferred_amount' => 0,
            ]);
            $lang = $this->getCurrentLang();
            $this->guard()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->employerGuard()->login($check_is_employer);
            Session::put('applocale', $lang);
            alert()->toast(trans('worker::worker.You have been successfully Account SwitchingToEmployer'), 'success');
            return redirect()->route('show.employer.panel');
        }


    }

}
