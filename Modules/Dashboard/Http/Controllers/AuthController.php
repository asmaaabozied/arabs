<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;
use Modules\Dashboard\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    protected function EmployerGuard()
    {
        return Auth::guard('employer');
    }

    protected function WorkerGuard()
    {
        return Auth::guard('worker');
    }

    public function showLoginForm()
    {
        $page_name = 'ArabWorkers | SignIn';
        return view('dashboard::layouts.auth.login', compact('page_name'));
    }


    public function refreshCaptcha(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'captcha' => Captcha::img()
        ]);
    }

    public function authentication(AuthRequest $request)
    {
        $validated = $request->validated();
        $auth_type = $validated['auth_type'];
        if (auth()->guard($auth_type)->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            alert()->toast(trans('dashboard::auth.You have been successfully logged in by e-mail'), 'success');
            if ($auth_type == "employer") {
                return redirect()->route('show.employer.panel');
            } elseif ($auth_type == "worker") {
                return redirect()->route('show.worker.panel');
            } else {
                return redirect()->back()->with([trans('error') => trans('dashboard::auth.An error has occurred, please check that the data entered is correct and try again')]);
            }
        } elseif (auth()->guard($auth_type)->attempt([$auth_type . '_number' => $validated['email'], 'password' => $validated['password']])) {
            alert()->toast(trans('dashboard::auth.You have been successfully logged in by account_number'), 'success');
            if ($auth_type == "employer") {
                return redirect()->route('show.employer.panel');
            } elseif ($auth_type == "worker") {
                return redirect()->route('show.worker.panel');
            } else {
                return redirect()->back()->with([trans('error') => trans('dashboard::auth.An error has occurred, please check that the data entered is correct and try again')]);
            }
        } else {
            return redirect()->back()->with([trans('error') => trans('dashboard::auth.The email or account number or password is incorrect')]);
        }
    }
}
