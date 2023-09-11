<?php

namespace Modules\Employer\Http\Controllers\Task;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Status;
use Modules\Task\Entities\Task;

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


}
