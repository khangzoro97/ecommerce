<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('/admin')->send();
        }
    }

    public function index(){
        return view('admin-login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.board');
    }
    public function dashboard(Request $request){
        $admin_email= $request->admin_email;
        $admin_password= md5($request->admin_password);

        $result= DB::table("tbl_admin")->where([["admin_email",$admin_email],
        ["admin_password",$admin_password]])->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message',"Mật khẩu hoặc email nhập sai. Vui lòng nhập lại");
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::flush();
        Auth::logout();
        return Redirect::to('/admin');
    }

}
