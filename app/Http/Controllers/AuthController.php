<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Http\Request;
use Auth;
use Toastr;

class AuthController extends Controller
{
    public function register_admin(){
        return view('admin.account.register');
    }

    public function login_auth(){
        return view('admin.account.login_auth');
    }

    public function logout_auth(){
        Auth::logout();
        Toastr::success('Đăng xuất thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "1500","progressBar"=> true,"closeButton"=> true]);
        
        return redirect('/admin');
        // return redirect('/login-auth');
    }

    public function login_customuser(Request $request){
        $this->validate($request, [
            'admin_user' => 'required',   
            'admin_password' => 'required'
        ]);
        $data = $request->all();
        if(Auth::attempt(['admin_user' => $data->admin_user, 'admin_password' => $data->admin_password])){
            // echo Auth::attempt(['admin_user' => $request->admin_user, 'admin_password' => $request->admin_password]);
            return redirect('/dashboard');
        }else{
            // Toastr::error('Lỗi đăng nhập Authentication!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "1500","progressBar"=> true,"closeButton"=> true]);
            
            return redirect('/login-auth')->with('message','Lỗi đăng nhập Authentication');
        }
    }

    
    public function register_admin_account(Request $request){
        $data = $request->all();
        $this->validation($request);
        // $data = $request->validate(
        //     [
        //         'admin_user' => 'required|unique::tbl_admin',   
        //         'admin_password' => 'required',
        //         'admin_name' => 'required',
                
        //     ],
        //     [
        //         'admin_user.unique' => 'Đã tồn tại account name trong hệ thống',
        //         'admin_user.required' => 'Yêu cầu nhập account name',
        //         'admin_password.required' => 'Yêu cầu nhập Password ',
        //         'admin_name.required' => 'Yêu cầu nhập Họ Tên Admin',
        //     ]
        //     );

        $admin = new Admin();
        $admin->admin_user = $data['admin_user'];
        $admin->admin_name = $data['admin_name'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        Toastr::success('Đăng ký thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "1000","progressBar"=> true,"closeButton"=> true]);
        return redirect('admin');
    }

    public function validation($request){
        return $this->validation($request,[
            'admin_user' => 'required|unique::tbl_admin',   
            'admin_password' => 'required',
            'admin_name' => 'required',
            // 'admin_phone' => 'required'
        ],
        [
                    'admin_user.unique' => 'Đã tồn tại account name trong hệ thống',
                    'admin_user.required' => 'Yêu cầu nhập account name',
                    'admin_password.required' => 'Yêu cầu nhập Password ',
                    'admin_name.required' => 'Yêu cầu nhập Tên Admin',
        ]
    );
    }
}