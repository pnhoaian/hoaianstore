<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
session_start();

class CustomerController extends Controller
{
    public function AuthLogin(){
        $_id = Session::get('customer_id');
        if($customer_id)
        {
            return redirect('trang-chu');
        }else{
            return redirect('login')->send();
        }
    }

    public function login(){
        return view('pages.customer.user_login');
    }

    public function register(){
        return view('pages.customer.user_register');
    }

    public function user_logout(){
        $this->AuthLogin();
        Session::put('customer_email',null);
        Session::put('customer_id',null);
        return redirect('index');
    }


    public function show_dashboard(){
        $this->AuthLogin();
        return view('/trang-chu');
    }

    public function dashboard(Request $request){
        

        $customer_email = $request->customer_email;
        $customer_password = md5($request->admin_password);
        
        $result = DB::table('tbl_customer')-> where('customer_email',$customer_email)->where('customer_password',$customer_password)->first();
        if ($result) {
			Session::put('customer_email',$result->customer_email);
			Session::put('customer_id',$result->customer_id);
			return Redirect::to('/trang-chu');//thành công -> index
		}else{
			Session::put('message','Tài khoản hoặc mật khẩu không chính xác !');
			return Redirect::to('/login');//thất bại -> reload trang login
		}
    }

}
