<?php

namespace Modules\Employer\Http\Controllers\Task;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Entities\Employer;
use Modules\Privilege\Entities\EmployerPrivilege;
use Modules\Privilege\Entities\Privilege;
use Modules\Region\Entities\City;
use Modules\Setting\Entities\Status;
use Modules\Task\Entities\Task;
use Modules\Task\Entities\TaskStatus;

class EmployerMyTaskController extends Controller
{
    public function showNotPublishedTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - NotPublished Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "NotPublishedTasks";
        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'NotPublished'],
        ])->with('category')->get();
        return view('employer::layouts.task.NotPublishedTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'data',
        ]));


    }


    public function showNotPayedTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - UnPayed Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "UnPayedTasks";

        $unPayed = Status::withoutTrashed()->where('name', 'unPayed')->firstOrFail();

        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->with('category', 'TaskStatuses.status')->get();
        for ($i = 0; $i < count($data); $i++) {
            if (count($data[$i]->TaskStatuses) == 1 and $data[$i]->TaskStatuses[0]->task_status_id == $unPayed->id) {
                $array_of_unPayed_task [] = $data[$i];
            }
        }

        if (isset($array_of_unPayed_task)) {
            $unPayedTasks = $array_of_unPayed_task;
        } else {
            $unPayedTasks = [];
        }
        return view('employer::layouts.task.UnPayedTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'unPayedTasks',
        ]));

    }

    public function showRejectedTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - Rejected Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "RejectedTasks";
        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->with('category', 'TaskStatuses.status')->get();
        $adminRefusalTask = Status::withoutTrashed()->where('name', 'adminRefusalTask')->first();
//        dd($data,$adminRefusalTask);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->TaskStatuses()->with('status')->latest()->first()->status->name == $adminRefusalTask->name) {
                $array_of_rejected_tasks [] = $data[$i];
            }
        }
        if (isset($array_of_rejected_tasks)) {
            $rejectedTasks = $array_of_rejected_tasks;
        } else {
            $rejectedTasks = [];
        }
        return view('employer::layouts.task.RejectedTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'rejectedTasks',
        ]));
    }

    public function showCompleteTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - Complete Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "CompleteTasks";
        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->with('category', 'TaskStatuses.status')->get();

        $complete = Status::withoutTrashed()->where('name', 'completed')->first();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->TaskStatuses()->with('status')->latest()->first()->status->name == $complete->name) {
                $array_of_completed_tasks [] = $data[$i];
            }
        }
        if (isset($array_of_completed_tasks)) {
            $completeTasks = $array_of_completed_tasks;
        } else {
            $completeTasks = [];
        }
//        dd($completeTasks);
        return view('employer::layouts.task.CompleteTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'completeTasks',
        ]));
    }

    public function showActiveTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - Active Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "ActiveTasks";
        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->with('category', 'TaskStatuses.status', 'deferred')->get();
        $active = Status::withoutTrashed()->where('name', 'active')->first();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->TaskStatuses()->with('status')->latest()->first()->status->name == $active->name) {
                $array_of_active_tasks [] = $data[$i];
            }
        }
        if (isset($array_of_active_tasks)) {
            $activeTasks = $array_of_active_tasks;
        } else {
            $activeTasks = [];
        }
        return view('employer::layouts.task.ActiveTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'activeTasks',
        ]));
    }

    public function showPendingTasks()
    {
        $page_name = "ArabWorkers | Employer Panel - Pending Tasks";
        $main_breadcrumb = "Tasks";
        $sub_breadcrumb = "PendingTasks";
        $data = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->with('category', 'TaskStatuses.status')->get();
        $pending = Status::withoutTrashed()->where('name', 'pending')->first();
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]->TaskStatuses()->with('status')->latest()->first()->status->name == $pending->name) {
                $array_of_pending_tasks [] = $data[$i];
            }
        }
        if (isset($array_of_pending_tasks)) {
            $pendingTasks = $array_of_pending_tasks;
        } else {
            $pendingTasks = [];
        }
        return view('employer::layouts.task.PendingTasks', compact([
            'page_name',
            'main_breadcrumb',
            'sub_breadcrumb',
            'pendingTasks',
        ]));
    }

    public function pendingTaskDetails($task_id, $task_number)
    {
        $page_name = "ArabWorkers | Employer Panel - Pending Task Details";
        $main_breadcrumb = "Pending Tasks";
        $sub_breadcrumb = "PendingTaskDetails";
        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['task_number', $task_number],
            ['publish_status', 'Published'],
        ])->with('countries.country', 'cities.city', 'category', 'workflows', 'actions.categoryAction', 'TaskStatuses')->findOrFail($task_id);
        $pending = Status::withoutTrashed()->where('name', 'pending')->first();

        if ($task->TaskStatuses()->latest()->first()->task_status_id == $pending->id) {
            $app_local = app()->getLocale();

            for ($i = 0; $i < count($task->countries); $i++) {
                $country [$task->countries[$i]->country_id] = City::withoutTrashed()->where('country_id', $task->countries[$i]->country_id)->count();
            }

            for ($i = 0; $i < count($task->countries); $i++) {
                for ($j = 0; $j < count($task->cities); $j++) {
                    if ($task->cities[$j]->city->country_id == $task->countries[$i]->country_id)
                        $region [$task->countries[$i]->country_id] [] = $task->cities[$j]->city->id;
                }
            }
            $keys = array_keys($country);
            for ($i = 0; $i < count($keys); $i++) {
                if (count($region[$keys[$i]]) == $country[$keys[$i]]) {
                    if ($app_local == "ar") {
                        $result [] = [
                            'country' => $task->countries[$i]->country->ar_name,
                            'flag' => $task->countries[$i]->country->flag,
                            'cities' => 'all_cities'
                        ];
                    } else {
                        $result [] = [
                            'country' => $task->countries[$i]->country->name,
                            'flag' => $task->countries[$i]->country->flag,
                            'cities' => 'all_cities'
                        ];
                    }


                } else {
                    if ($app_local == "ar") {
                        $result [] = [
                            'country' => $task->countries[$i]->country->ar_name,
                            'flag' => $task->countries[$i]->country->flag,
                            'cities' => $region[$keys[$i]],
                        ];
                    } else {
                        $result [] = [
                            'country' => $task->countries[$i]->country->name,
                            'flag' => $task->countries[$i]->country->flag,
                            'cities' => $region[$keys[$i]],
                        ];
                    }

                }
            }
            return view('employer::layouts.task.PendingTaskDetails', compact([
                'page_name',
                'main_breadcrumb',
                'sub_breadcrumb',
                'task',
                'result',
                'app_local',
            ]));
        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->back();
        }

    }

    public function checkIfWalletContainsEnoughMoneyToPayTask($task_id, $task_number)
    {
        $pending = Status::withoutTrashed()->where('name', 'pending')->firstOrFail();
        $employer = Employer::withoutTrashed()->findOrFail(auth()->user()->id);
        $check = TaskStatus::where([
            ['task_id', $task_id],
        ])->with('status', 'task.employer')->get();
        if (count($check) == 1 and $check[0]->task->employer->id == $employer->id and $check[0]->status->name == "unPayed") {
            $task = Task::withoutTrashed()->where([
                ['employer_id', $employer->id],
                ['task_number', $task_number],
            ])->findOrFail($task_id);

            if ($task->total_cost <= $employer->wallet_balance) {
                $wallet_balance = $employer->wallet_balance;
                $total_task_cost = $task->total_cost;
                $amount_remaining = $wallet_balance - $total_task_cost;
                $employer->update([
                    'wallet_balance' => $amount_remaining,
                    'total_spends' => $employer->total_spends + $total_task_cost,
                ]);
                TaskStatus::create([
                    'task_id' => $task->id,
                    'task_status_id' => $pending->id,
                ]);

                $privilege = Privilege::withoutTrashed()->where([
                    ['code', 'CNT'],
                    ['for', 'employer'],
                ])->first();
                /** plus Privilege to the employer **/
                EmployerPrivilege::create([
                    'employer_id' => $employer->id,
                    'count_of_privileges' => $privilege->privileges,
                    'type' => $privilege->type,
                    'description' => $privilege->title,
                ]);

                if ($task->other_cost > 0) {
                    $privilege2 = Privilege::withoutTrashed()->where([
                        ['code', 'UAF'],
                        ['for', 'employer'],
                    ])->first();
                    /** plus Privilege to the employer **/
                    EmployerPrivilege::create([
                        'employer_id' => $employer->id,
                        'count_of_privileges' => $privilege2->privileges,
                        'type' => $privilege2->type,
                        'description' => $privilege2->title,
                    ]);
                }

                alert()->toast(trans('employer::task.The price of the task has been successfully deducted from the wallet balance and is now under verification'), 'success');
                return redirect()->route('employer.show.task.in.pending.status');
            } else {
                alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
                return redirect()->back();
            }

        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->back();

        }

    }


}
