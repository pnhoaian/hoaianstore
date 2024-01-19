<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Coupon;
use Toastr;
use Mail;
use Carbon\Carbon;

class CheckoutController extends Controller
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

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if(Session::get('coupon')==true){
            Session::forget('coupon');
        }

    if($result){
        Session::put('customer_id',$result->customer_id);
        Session::put('customer_name',$result->customer_name);
        Session::put('customer_email',$result->customer_email);
        Session::put('customer_phone',$result->customer_phone);
        Session::put('customer_address',$result->customer_address);
        Toastr::success('Đăng nhập thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "680","progressBar"=> true,"closeButton"=> true]);
        return redirect::to('/trang-chu');
    }else{
        return redirect()->back()->with('error','Thông tin đăng nhập sai');
    
    }
    }

    public function register_customer(Request $request){
        $data = $request->all();
    
        
        $customer = new Customer();
        $customer ->customer_name = $data['customer_name'];
        $customer ->customer_email = $data['customer_email'];
        $customer ->customer_phone = $data['customer_phone'];
        $customer ->customer_address = $data['customer_address'];
        $customer ->customer_password = md5($data['customer_password']);
        $customer->save();

        Toastr::success('Vui lòng đăng nhập tài khoản','Đăng ký thành công! !', ["positionClass" => "toast-top-right","timeOut" => "3000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('/login');
    }


    public function logout_customer(Request $request){
        Session::flush();
        return redirect::to('/trang-chu');
    }

    public function checkout(Request $request){
       






        
        
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        // Toastr::info(' Vui lòng kiểm tra thông tin nhận hàng','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        $customer = Customer::find(Session::get('customer_id'));

        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_post',$category_post)
        ->with('customer',$customer)
        ;
    }

    public function save_checkout_customer(Request $request){
    $data = array();
    $data['shipping_name'] = $request->shipping_name;
    $data['shipping_phone'] = $request->shipping_phone;
    $data['shipping_email'] = $request->shipping_email;
    $data['shipping_address'] = $request->shipping_address;
    $data['shipping_note'] = $request->shipping_note;
    
    $data['shipping_method_receive'] = $request->shipping_method_receive;
    $data['shipping_method_pay'] = $request->shipping_method_pay;
    $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    Session::put('shipping_id',$shipping_id);
    return Redirect('/payment');
    }

    public function confirm_order(Request $request){
        // $data = $request->validate(
        //     [
        //         'shipping_name' => 'required|max:150',   
        //         'shipping_phone' => 'required|numeric|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
        //         'shipping_address' => 'required',          
        //     ],
        //     [
        //         'shipping_name.required' => 'Yêu cầu nhập tên người nhận hàng ',
        //         'shipping_phone.required' => 'Yêu cầu nhập số điện thoại nhận hàng',
        //         'shipping_phone.numeric' => 'Số điện thoại phải là dạng số ',
        //         'shipping_address.required' => 'Yêu cầu nhập địa chỉ nhận hàng',
        //     ]
        //     );     
        
        $data = $request->validate(
            [
                'shipping_name' => 'required|max:255',   
                'shipping_phone' => 'required|numeric|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
                'shipping_address' => 'required|max:255',   
                'shipping_email' => 'required',        
            ],
            [
                'shipping_name.required' => 'Yêu cầu nhập tên người nhận hàng ',
                'shipping_phone.required' => 'Yêu cầu nhập số điện thoại nhận hàng',
                'shipping_phone.numeric' => 'Số điện thoại phải là dạng số ',
                'shipping_phone.regex' => 'Số điện thoại không đúng định dạng ',
                'shipping_address.required' => 'Yêu cầu nhập địa chỉ nhận hàng',
                'shipping_email.required' => 'Yêu cầu nhập Email',
            ]
            ); 
        
         $data = $request->all();

         if(Session::get('coupon')!=NULL){
            $coupon = Coupon::where('coupon_code',$data['order_coupon'])->first();
            //Thêm customer_id vào cột coupon_used
            $coupon->coupon_used = $coupon->coupon_used.','.Session::get('customer_id');
            //trừ sl coupon sau khi đặt hàng
            $coupon->coupon_times = $coupon->coupon_times-1;
            

            //xuất hiện trong Mail
            $coupon_mail = $coupon->coupon_code;
            $coupon_mail_method = $coupon->coupon_condition;
            $coupon_mail_number = $coupon->coupon_number;

            $coupon->save();
            }
            else{
                $coupon_mail = 'không áp dụng';
                $coupon_mail_method ='';
                $coupon_mail_number = '0';
            }

        // Get Shipping
        $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         
         $shipping->shipping_note = $data['shipping_note'];
         $shipping->shipping_method_pay = $data['shipping_method_pay'];
         $shipping->shipping_method_receive = $data['shipping_method_receive'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

  
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;

         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');

         $order->create_at = now();
         $order->order_date = $order_date;
         $order->save();


         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->Order_code = $checkout_code;
                $order_details->Product_id  = $cart['product_id'];
                $order_details->Product_name = $cart['product_name'];
                $order_details->Product_price = $cart['product_price_sale'];
                $order_details->Product_sales_quantity = $cart['product_qty'];
                $order_details->Product_coupon =  $data['order_coupon'];
                // $order_details->Product_feeship = $priceship;
                $order_details->save();
            }
         }




         //Send mail
         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
         $title_mail = "Hoài An Store | Xác nhận đơn đặt hàng ngày ".' '.$now;


         $customer = Customer::find(Session::get('customer_id'));
         
        $data['email'][] = $customer->customer_email;
        if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart_mail){
                $cart_array[] = array(
                    'product_name' => $cart_mail['product_name'],
                    'product_price_sale' => $cart_mail['product_price_sale'],
                    'product_qty' => $cart_mail['product_qty'],
                );
            }
        }
        
         $shipping_array = array(
            'customer_name' =>$customer->customer_name,
            'shipping_name' =>$data['shipping_name'],
            'shipping_email' =>$data['shipping_email'],
            'shipping_phone' =>$data['shipping_phone'],
            'shipping_address' =>$data['shipping_address'],
            'shipping_note' =>$data['shipping_note'],
            'shipping_method_receive' =>$data['shipping_method_receive'],
            'shipping_method_pay' =>$data['shipping_method_pay']
         );

         $ordercode_mail = array(
            'coupon_code' =>$coupon_mail,
            //$coupon_mail = $coupon->coupon_code;

            'order_code' =>$checkout_code,

            'coupon_number' => $coupon_mail_number,
            'coupon_condition' =>$coupon_mail_method,


            //$coupon_mail_method = $coupon->coupon_condition;
            //$coupon_mail_number = $coupon->coupon_number;
            
         );
        
        Mail::send('pages.mail.mail_order',
        ['cart_array'=>$cart_array,
        'shipping_array'=>$shipping_array,
        'code'=>$ordercode_mail],
        function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
            
        });


        if($shipping->shipping_method_pay ==0){
            Toastr::success('Đặt hàng thành công, đơn hàng đang được xử lý.','Thông báo !');
        }
        Session::forget('coupon');
            Session::forget('fee');
            Session::forget('cart');
        
    }

    public function payment(){
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        
        return view('pages.checkout.show_checkout')
        ->with('category', $cate_product)
        ->with('category_post',$category_post)
        ->with('brand', $brand_product);
    }


    public function my_information(Request $request){
    $customer = Customer::find(Session::get('customer_id'));
    $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
    $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();

    // dd($customer);
    return view('pages.customer.info')
    ->with('category',$cate_product)
    ->with('brand',$brand_product)
    ->with('category_post',$category_post)
    ->with('customer',$customer);
    }

    public function update_information(Request $request, $customer_id){
        $data = $request->all();

                $data = $request->validate(
            [
                'customer_name' => 'required|max:255',   
                'customer_email' => 'required|email|max:255',   
                // 'customer_phone' => 'numeric|required|max:12|min:9|max:12',
                'customer_phone' => 'required|numeric|regex:/(0)[0-9]/',
                'customer_address' => 'required',
            ],
            [
                'customer_name.required' => 'Tên người nhận hàng không được để trống',
                'customer_name.max' => 'Tên người nhận quá dài, < 255 ký tự',
                'customer_email.required' => 'Email không được để trống',
                'customer_email.email' => 'Không phải định dạng "@email.com"',
                'customer_email.max' => 'Địa chỉ email quá dài',
                'customer_phone.required' => 'SĐT người nhận hàng không được để trống',
                'customer_phone.numeric' => 'SĐT định dạng bằng ký tự số',
                'customer_phone.regex' => 'SĐT không đúng định dạng',
                
                // 'customer_phone.min' => 'SĐT quá ngắn không hợp lệ, sđt gồm 11 số',
                // 'customer_phone.max' => 'SĐT quá dài không hợp lệ, sđt gồm 11 số',
                'customer_address.required' => 'Địa chỉ nhận hàng không được để trống',
            ]
            );

        $customer = Customer::find($customer_id);
        $customer->customer_name= $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_address = $data['customer_address'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        Toastr::success('Cập nhật thông tin thành công.','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect('/my-information');
        
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    
    
    public function momo_payment(Request $request){
    
    $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
    
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    
    $orderInfo = "Thanh toán qua MoMo";
    $amount = "10000";
    $orderId = time() ."";
    $returnUrl = "http://localhost:8000/atm/result_atm.php";
    $notifyurl = "http://localhost:8000/atm/ipn_momo.php";
    // Lưu ý: link notifyUrl không phải là dạng localhost
    $bankCode = "SML";
    
    
             $requestId = time()."";
             $requestType = "payWithMoMoATM";
             $extraData = "";
             //before sign HMAC SHA256 signature
             $rawHashArr =  array(
                            'partnerCode' => $partnerCode,
                            'accessKey' => $accessKey,
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'bankCode' => $bankCode,
                            'returnUrl' => $returnUrl,
                            'notifyUrl' => $notifyurl,
                            'extraData' => $extraData,
                            'requestType' => $requestType
                            );
             // echo $serectkey;die;
             $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderId."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
             $signature = hash_hmac("sha256", $rawHash, $secretKey);
    
             $data =  array('partnerCode' => $partnerCode,
                            'accessKey' => $accessKey,
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'returnUrl' => $returnUrl,
                            'bankCode' => $bankCode,
                            'notifyUrl' => $notifyurl,
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature);
             $result = $this->execPostRequest($endpoint, json_encode($data));
             $jsonResult = json_decode($result,true);  // decode json
             
             error_log( print_r( $jsonResult, true ) );
             header('Location: '.$jsonResult['payUrl']);
    }
    
    
        public function vnpay_payment(Request $request){
    $data = $request->all();
    $code_cart = rand(00,9999);
    
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/hoaianstore/checkout";
    $vnp_TmnCode = "U15COBUU";//Mã website tại VNPAY 
    $vnp_HashSecret = "SSBSVBSLSAVHLEDGASGKJIMCALMHXAPH"; //Chuỗi bí mật
    
    //$vnp_TxnRef = $_POST['order_id'];
    //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    //$vnp_TxnRef = '123456';
    $vnp_TxnRef = $code_cart;
    
    
    //$vnp_OrderInfo = $_POST['order_desc'];
    $vnp_OrderInfo = 'Thanh toán đơn hàng';
    
    //$vnp_OrderType = $_POST['order_type'];
    $vnp_OrderType = 'billpayment';
    
    //$vnp_Amount = $_POST['amount'] * 100;
    //$vnp_Amount = 20000 * 100;
    $vnp_Amount = $data['total-vnpay'] * 100;
    
    //$vnp_Locale = $_POST['language'];
    $vnp_Locale = 'vn';
    
    //$vnp_BankCode = $_POST['bank_code'];
    $vnp_BankCode = 'NCB';
    
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params of 2.0.1 Version
    
    //Đóng
    //$vnp_ExpireDate = $_POST['txtexpire'];
    
    //Billing
    
    
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        
    
    );
    
    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }
    if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        $inputData['vnp_Bill_State'] = $vnp_Bill_State;
    }
    
    //var_dump($inputData);
    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
        }

}