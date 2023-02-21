<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        //get all users from database without admin role and approve status
        $users = User::where('role', '!=', 'admin')->where('status', '!=', 'approved')->get();
        //if user list is empty, assign users=null
        if ($users->isEmpty()) {
            $users = null;
        }
        return view('admin', compact('users'));
    }

    //delete user from admin dashboard
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('admin');
    }

    //approve user from admin dashboard
    public function approve(Request $request)
    {
        $user = User::find($request->id);
        $user->status = 'approved';
        $user->save();
        return redirect()->route('admin');
    }
}
