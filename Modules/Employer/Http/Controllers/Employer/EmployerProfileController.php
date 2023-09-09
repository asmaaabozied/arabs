<?php

namespace Modules\Employer\Http\Controllers\Employer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Entities\Employer;

class EmployerProfileController extends Controller
{
    public function avatar()
    {
        $default_avatar = url('assets/img/default/default-avatar.svg');
        return $default_avatar;
    }
    public function showMyProfile()
    {
        $page_name = "ArabWorkers | Employers - profile";
        $main_breadcrumb = "Employer Panel";
        $sub_breadcrumb = "MyProfile";

        $employer = Employer::with(['country', 'city', 'level'])->findOrFail(auth()->user()->id);

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
//        dd($tasks, $employer);
        return view('employer::layouts.employer.profile', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'employer',
            'tasks',
            'total',
        ]));

    }


}
