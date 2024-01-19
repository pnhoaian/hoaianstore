<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Statistic;
use App\Models\Visitors;
use App\Models\Product;
use App\Models\Post;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Admin;
use App\Models\OrderDetails;
use Auth;
use Toastr;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        // $admin_id = Auth::id();
        if($admin_id)
        {
            return redirect('dashboard');
        }else{
            return redirect('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(Request $request){
        $this->AuthLogin();

        // $user_ip_address = $request->ip;
        $user_ip_address = '150.13.005.189';

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
        $visitor_of_lastmonth = Visitors::whereBetween('date_visitor',[$early_last_month,$end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_lastmonth->count();

        //total this month
        $visitor_of_thismonth = Visitors::whereBetween('date_visitor',[$early_this_month,$now])->get();
        $visitor_this_month_count = $visitor_of_thismonth->count();

        //total in 1 year
        $visitor_of_year = Visitors::whereBetween('date_visitor',[ $oneyears,$now])->get();
        $visitor_year_count = $visitor_of_year->count();

        // Hiện tại
        $visitor_current = Visitors::where('ip_address',$user_ip_address)->get();
        $visitor_count = $visitor_current->count();

        if($visitor_count<1){
            $visitor = New Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //total visitor
        $visitor = Visitors::all();
        $visitors_total = $visitor->count();

        //total Biểu đồ

        $product = Product::all()->count();
        $product_view = Product::orderby('product_view','desc')->take(20)->get();

        // $product_s = Product::where('product_sold')->count();

        $product_sold = Product::orderby('product_sold','desc')->take(20)->get();
        // $product_view = Product::orderBy('product_view','desc')->get(20);
        
        $post = Post::all()->count();
        $post_view = Post::orderBy('post_view','desc')->take(20)->get();

        $ngayban = DB::table('tbl_order')->where('order_date','like','2024-01-01');

        $slban = OrderDetails::where('Order_details_id','desc')->get();


        $order = Order::all()->count();
        $customer = Customer::all()->count();

        return view('admin.dashboard')->with(compact('visitors_total',
        'visitor_count','visitor_last_month_count',
        'visitor_this_month_count','visitor_year_count',
        'product','post','order','customer',
        'product_view','post_view','product_sold',
        'ngayban','slban'

    ));
    }

    public function dashboard(Request $request){
        $admin_user = $request->admin_user;
        $admin_password = md5($request->admin_password);
        
        $result = DB::table('tbl_admin')-> where('admin_user',$admin_user)->where('admin_password',$admin_password)->first();
        if ($result) {
			Session::put('admin_name',$result->admin_name);
			Session::put('admin_id',$result->admin_id);
            Toastr::success('Đăng nhập thành công.','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
			
			return Redirect::to('/dashboard');
		}else{
            Toastr::error('Tài khoản hoặc mật khẩu không chính xác','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
			return Redirect::to('/admin');
		}
    }

    public function logout(){
        // $this->AuthLogin();
        // Session::put('admin_name',null);
        // Session::put('admin_id',null);

        Session::flush();
        // return Redirect::to('admin.dashboard');
        return Redirect::to('/admin');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){
        $data = $request->all();
        // echo $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();


        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        
        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();

        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();

        }
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }


    public function order_date(Request $request){
        $order_date = $_GET['date'];
        $order = Order::where('order_date',$order_date)->orderBy('create_at','desc')->get();
        return view('admin.order_date')->with(compact('order'));
    }
    
}