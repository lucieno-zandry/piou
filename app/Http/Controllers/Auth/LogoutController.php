<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    // Handle logout logic
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}