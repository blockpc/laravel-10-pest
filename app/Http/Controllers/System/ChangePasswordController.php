<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.change-password', ['token' => $request->route('token')]);
    }
}
