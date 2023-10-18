<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        foreach(auth()->user()->roles as $role){
            if($role->title == "user"){
                return redirect()->route('client.test');
            }
            return view('admin.dashboard');
        }

        
    }
}
