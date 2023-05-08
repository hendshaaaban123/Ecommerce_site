<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class DashboardController extends Controller
{
    //
    public function user(){
        $user = User::all();
        return view('admin.user.index',compact('user'));
        
    }
    public function viewUser($id){
     $user = User::where('id',$id)->first();
     return view('admin.user.view',compact('user'));
    }
}
