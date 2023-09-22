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

use Modules\Currency\Entities\Currency;
use Modules\Setting\Entities\Status;
use Modules\Task\Entities\TaskWorker;
use Modules\Region\Entities\City;
use Modules\Region\Entities\Country;

class WorkerProfileController extends Controller
{
    // protected function guard()
    // {
    //     return Auth::guard('worker');
    // }
    // protected function employerGuard()
    // {
    //     return Auth::guard('employer');
    // }


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


    public function showMyProfile()
    {

        $page_name = "ArabWorkers | Worker - profile";
        $main_breadcrumb = "Worker Panel";
        $sub_breadcrumb = "MyProfile";

        $employer = Worker::with(['country', 'city', 'level'])->findOrFail(auth()->user()->id);

        $tasks = $employer->tasks()->with(['category', 'TaskStatuses.status'])->get();

        if ($employer->privileges()->exists() == true){
            for($i=0;$i<$employer->privileges()->count();$i++){
                if ($employer->privileges[$i]->type == "plus") {
                    $total[] = "+" . $employer->privileges[$i]->count_of_privileges;
                }
                else{
                    $total[] = "-" . $employer->privileges[$i]->count_of_privileges;
                }
            }
        }else{
            $total [] = 0;
        }

        return view('worker::layouts.worker.profile', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'employer',
            'tasks',
            'total',
        ]));

    }
    public function showUpdateMyProfileForm()
    {
        $page_name = "ArabWorkers | Workers - edit profile";
        $main_breadcrumb = "Worker Panel";
        $sub_breadcrumb = "Edit My Profile";
        $employer = Worker::withoutTrashed()->with('level')->findOrFail(auth()->user()->id);
        $default_avatar = $this->avatar();
        $countries = Country::withoutTrashed()->get();
        if ($employer->privileges()->exists() == true){
            for($i=0;$i<$employer->privileges()->count();$i++){
                if ($employer->privileges[$i]->type == "plus") {
                    $total[] = "+" . $employer->privileges[$i]->count_of_privileges;
                }
                else{
                    $total[] = "-" . $employer->privileges[$i]->count_of_privileges;
                }
            }
        }else{
            $total [] = 0;
        }
        return view('worker::layouts.worker.editProfile', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'employer',
            'default_avatar',
            'countries',
            'total',
        ]));
    }
    public function avatar()
    {
        $default_avatar = url('assets/img/default/default-avatar.svg');
        return $default_avatar;
    }

}
