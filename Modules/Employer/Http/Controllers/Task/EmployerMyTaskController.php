<?php

namespace Modules\Employer\Http\Controllers\Task;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employer\Entities\Employer;
use Modules\Employer\Http\Requests\RejectTaskProofRequest;
use Modules\Privilege\Entities\EmployerPrivilege;
use Modules\Privilege\Entities\Privilege;
use Modules\Privilege\Entities\WorkerPrivilege;
use Modules\Region\Entities\City;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Entities\Status;
use Modules\Task\Entities\DeferredTask;
use Modules\Task\Entities\Task;
use Modules\Task\Entities\TaskProof;
use Modules\Task\Entities\TaskStatus;
use Modules\Worker\Entities\Worker;

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

    public function showOrHideActiveTask($task_id, $task_number)
    {
        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['task_number', $task_number],
            ['publish_status', 'Published'],
        ])->findOrFail($task_id);

        if ($task->is_hidden == "false") {
            $task->update([
                'is_hidden' => 'true',
            ]);
            alert()->toast(trans('employer::task.The task has been successfully hidden from workers, and will no longer appear unless you show it manually'), 'info');
            return redirect()->route('employer.show.task.in.active.status');
        } elseif ($task->is_hidden == "true") {
            $task->update([
                'is_hidden' => 'false',
            ]);
            alert()->toast(trans('employer::task.The task has been successfully showed for all workers, and will now be able to view for workers and complete them'), 'success');
            return redirect()->route('employer.show.task.in.active.status');
        }
    }

    public function activeTaskDetails($task_id, $task_number)
    {
        $page_name = "ArabWorkers | Employer Panel - Active Task Details";
        $main_breadcrumb = "Active Tasks";
        $sub_breadcrumb = "ActiveTaskDetails";
        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['task_number', $task_number],
            ['publish_status', 'Published'],
        ])->with('countries.country', 'cities.city', 'category', 'workflows', 'actions.categoryAction', 'TaskStatuses.status', 'deferred')->findOrFail($task_id);
        $active = Status::withoutTrashed()->where('name', 'active')->first();
        if ($task->TaskStatuses()->latest()->first()->task_status_id == $active->id) {
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
//            dd($task->deferred()->latest()->first());
            return view('employer::layouts.task.ActiveTaskDetails', compact([
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

    public function activeTaskProofs($task_id, $task_number)
    {
        $page_name = "ArabWorkers | Employer Panel - Active Tasks Proofs";
        $main_breadcrumb = "Active Tasks Proofs";
        $sub_breadcrumb = "Proofs";


        $task = Task::withoutTrashed()->where([
            ['task_number', $task_number],
            ['publish_status', 'Published'],
            ['employer_id', auth()->user()->id],
        ])->with('category')->findOrFail($task_id);
        $active = Status::withoutTrashed()->where('name', 'active')->first();

        if ($task->TaskStatuses()->with('status')->latest()->first()->status->name == $active->name) {
            $proofs = $task->proofs()->with('worker')->get();
//            dd($proofs,$task);
            return view('employer::layouts.task.ActiveTaskProofs', compact([
                'page_name',
                'main_breadcrumb',
                'sub_breadcrumb',
                'proofs',
                'task',

            ]));

        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->back();
        }

    }

    public function activeTaskProofDetails($task_id, $proof_id)
    {
        $page_name = "ArabWorkers | Employer Panel - Active Tasks Proof Details";
        $main_breadcrumb = "Tasks Proof details";
        $sub_breadcrumb = "Proof Details";

        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['publish_status', 'Published'],
        ])->findOrFail($task_id);
        $active = Status::withoutTrashed()->where('name', 'active')->first();

        if ($task->TaskStatuses()->with('status')->latest()->first()->status->name == $active->name) {
            $proof = TaskProof::withoutTrashed()->where([
                ['employer_id', auth()->user()->id],
                ['task_id', $task->id],
            ])->findOrFail($proof_id);
            return view('employer::layouts.task.ActiveTaskProofDetails', compact([
                'page_name',
                'main_breadcrumb',
                'sub_breadcrumb',
                'proof',
                'task',

            ]));
        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->back();
        }

    }

    public function acceptTaskProof($task_id, $task_number, $proof_id, $worker_id)
    {

        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['task_number', $task_number],
            ['publish_status', 'Published'],
        ])->findOrFail($task_id);
        $status = Status::withoutTrashed()->get();
        $active = $status->where('name', 'active')->first();
        $completed = $status->where('name', 'completed')->first();
        if ($task->TaskStatuses()->with('status')->latest()->first()->status->name == $active->name) {
            if ($task->proofs()->where('isEmployerAcceptProof', '=', 'NotSeenYet')->count() <= $task->total_worker_limit) {
                $proof = TaskProof::withoutTrashed()->where([
                    ['task_id', $task->id],
                    ['employer_id', $task->employer_id],
                    ['worker_id', $worker_id],
                    ['isEmployerAcceptProof', 'NotSeenYet'],
                ])->findOrFail($proof_id);
                $proof->update([
                    'isEmployerAcceptProof' => 'Yes',
                    'isAdminAcceptProof' => 'Yes',

                ]);
                $worker = Worker::withoutTrashed()->findOrFail($proof->worker_id);
                $worker->update([
                    'wallet_balance' => $worker->wallet_balance + $task->cost_per_worker,
                    'total_earns' => $worker->total_earns + $task->cost_per_worker,
                ]);

                /**
                 * check worker level after accept his proof
                 */
                CheckAcceptedProofCountAndUpdateLevel($worker->id);

                $privilege = Privilege::withoutTrashed()->where([
                    ['code', 'ATF'],
                    ['for', 'worker'],
                ])->first();
                /** plus Privilege to the worker who provided acceptable proof **/
                WorkerPrivilege::create([
                    'worker_id' => $worker->id,
                    'count_of_privileges' => $privilege->privileges,
                    'type' => $privilege->type,
                    'description' => $privilege->title,
                ]);
                if ($task->proofs()->where('isEmployerAcceptProof', '=', 'Yes')->count() == $task->total_worker_limit) {
                    TaskStatus::create([
                        'task_id' => $task->id,
                        'task_status_id' => $completed->id,
                    ]);
                    alert()->toast(trans('employer::task.The last proofs submitted by this worker have been successfully confirmed, and task status changed to complete'), 'success');
                    return redirect()->route('employer.show.task.in.complete.status');

                }
                alert()->toast(trans('employer::task.The proofs submitted by this worker have been successfully confirmed'), 'success');
                return redirect()->route('employer.show.active.tasks.proofs', [$task->id, $task->task_number]);

            } else {
                alert()->toast(trans('employer::task.This action is not available because the task has already been completed'), 'warning');
                return redirect()->back();
            }
        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->route('employer.show.active.tasks.proofs', [$task->id, $task->task_number]);
        }

    }

    public function rejectTaskProof(RejectTaskProofRequest $request, $task_id, $task_number, $proof_id, $worker_id)
    {
        $validated = $request->validated();
        $task = Task::withoutTrashed()->where([
            ['employer_id', auth()->user()->id],
            ['task_number', $task_number],
            ['publish_status', 'Published'],
        ])->findOrFail($task_id);
        $status = Status::withoutTrashed()->get();
        $active = $status->where('name', 'active')->first();
        if ($task->TaskStatuses()->with('status')->latest()->first()->status->name == $active->name) {
            if ($task->proofs()->where('isEmployerAcceptProof', '=', 'NotSeenYet')->count() <= $task->total_worker_limit) {
                $proof = TaskProof::withoutTrashed()->where([
                    ['task_id', $task->id],
                    ['employer_id', $task->employer_id],
                    ['worker_id', $worker_id],
                    ['isEmployerAcceptProof', 'NotSeenYet'],
                ])->findOrFail($proof_id);
                $proof->update([
                    'isEmployerAcceptProof' => 'No',
                    'isAdminAcceptProof' => 'No',
                    'reasonOfEmployerRefuse' => $validated['reasonOfReject'],
                    'reasonOfAdminRefuse' => $validated['reasonOfReject'],
                ]);
                $worker = Worker::withoutTrashed()->findOrFail($proof->worker_id);
                $privilege = Privilege::withoutTrashed()->where([
                    ['code', 'RTF'],
                    ['for', 'worker'],
                ])->first();
                /** Minus Privilege from the worker who provided unacceptable proof **/
                WorkerPrivilege::create([
                    'worker_id' => $worker->id,
                    'count_of_privileges' => $privilege->privileges,
                    'type' => $privilege->type,
                    'description' => $privilege->title,
                ]);
                $added_days = Setting::select('days_added_to_task_end_date_when_reject_task_proof')->first();
                /** insert new and old task data (task_end_date + total_worker_limit) in the DeferredTask table **/
                DeferredTask::create([
                    'task_id' => $task->id,
                    'main_end_date' => $task->task_end_date,
                    'new_end_date' => Carbon::parse($task->task_end_date)->addDays($added_days->days_added_to_task_end_date_when_reject_task_proof)->format('Y-m-d'),
                    'main_total_worker_limit' => $task->total_worker_limit,
                    'new_total_worker_limit' => $task->total_worker_limit + 1,
                    'reason_of_defer' => $privilege->title,
                    'duration_of_defer' => $added_days->days_added_to_task_end_date_when_reject_task_proof,
                ]);

                /** Update the task data by modifying its completion date and the number of workers **/
                $task->update([
                    'total_worker_limit' => $task->total_worker_limit + 1,
                    'task_end_date' => Carbon::parse($task->task_end_date)->addDays($added_days->days_added_to_task_end_date_when_reject_task_proof)->format('Y-m-d'),
                ]);

                alert()->toast(trans('employer::task.The proofs submitted by this worker have been successfully rejected, And we extended the completion time of this task for an additional 24 hours, with an increase in the number of workers on this task by one new worker so that he can view the task and send the correct proof'), 'info');
                return redirect()->route('employer.show.active.tasks.proofs', [$task->id, $task->task_number]);

            } else {
                alert()->toast(trans('employer::task.This action is not available because the task has already been completed'), 'warning');
                return redirect()->back();
            }
        } else {
            alert()->toast(trans('employer::task.An error has occurred, please try again later'), 'error');
            return redirect()->route('employer.show.active.tasks.proofs', [$task->id, $task->task_number]);
        }
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
