<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{


    public function index()
    {
        if (Auth::user()->status == 'approved') {
            return view('dashboard');
        } else {
            return redirect()->route('unapproved');
        }
    }

    public function unapproved()
    {
        if (Auth::user()->status == 'pending') {
            return view('unapproved');
        } else {
            return redirect()->route('dashboard');
        }
    }

    //delete user from admin panel
    
}
