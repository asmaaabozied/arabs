<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Mews\Captcha\Facades\Captcha;

class AuthController extends Controller
{
    protected function EmployerGuard()
    {
        return Auth::guard('employer');
    }
    protected function WorkerGuard()
    {
        return Auth::guard('employer');
    }
    public function showLoginForm(){
        $page_name = 'ArabWorkers | SignIn';
        return view('dashboard::layouts.auth.login', compact('page_name'));
    }


    public function refreshCaptcha(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'captcha' => Captcha::img()
        ]);
    }
    public function auththentication(){

    }
}
