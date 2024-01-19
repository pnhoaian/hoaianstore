<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use Mail;
use App\Models\Intro;
use App\Models\Slider;
use Illuminate\Support\Facades\Redirect;
use App\Models\CatePost;
use App\Models\Customer;
use Toastr;
session_start();

class MailController extends Controller
{

    //Test mail
    public function send_mail(){
        //send mail
        
       $to_name = "Hoài An Store";
       $to_email = "paminh0000@gmail.com";//send to this email
       
       //  $link_reset_pass = url('/update-new-pass?email='.$to_email.'$token'.$rand_id);

       //  $data = array("name"=>"Testing","body"=>$link_reset_pass); //body of mail.blade.php
       $data = array("name"=>"Testing","body"=>"Hello Anh Minh"); //body of mail.blade.php
    
       Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        //--send mail
   // return redirect('/trang-chu')->with('message','');
   }


   public function send_coupon(){
        $customer_vip = Customer::where('customer_vip',1)->get();
        //Send mail
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $title_mail = "Hoài An Store | Mã khuyến mãi hấp dẫn mới nhất ngày ".' '.$now;

        $data = [];
        foreach($customer_vip as $vip){
            $data['email'][] = $vip->customer_email;
        }
        // dd($data);
        Mail::send('pages.mail.send_coupon',$data, function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        Toastr::success('Đã gửi thành công mã khuyến mãi!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "1500","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('list-coupon');
    }

    public function demo_sendcoupon(){
        return view('pages.mail.send_coupon');
    }
}
