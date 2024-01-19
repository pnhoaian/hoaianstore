<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use App\Models\Contact;
use App\Models\Slider;
use App\Models\CatePost;
use Toastr;
use Illuminate\Support\Facades\Redirect;
session_start();

class ContactController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return redirect('dashboard');
        }else{
            return redirect('admin')->send();
        }
    }

    public function lien_he(Request $request){
        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

        //
        $contact = Contact::where('info_id',1)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.contact.contact')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('contact',$contact);
        
    }
    public function information(){
        $this->AuthLogin();
        $contact = Contact::where('info_id',1)->get();
        return view('admin.information.add_information')->with(compact('contact'));
    }

    public function update_info(Request $request, $info_id){
        
        $data = $request->all();
        $data = $request->validate(
            [
                'info_address' => 'required:tbl_information',   
                'info_number' => 'required|numeric|digits:10',
                'info_email' => 'required|email',
                'info_map' => 'required',
                'info_fanpage' => 'required',
                
            ],
            [
                'info_address.required' => 'Yêu cầu nhập địa chỉ',
                'info_number.required' => 'Yêu cầu thêm số điện thoại ',
                'info_number.numeric' => 'Không phải định dạng số điện thoại ',
                
                'info_number.digits' => 'Số điện thoại liên hệ chưa gồm 10 con số',
                'info_email.required' => 'Thêm địa chỉ email ',
                'info_email.email' => 'Không phải định dạng email ',
                'info_map.email' => 'Yêu cầu thêm địa chỉ cửa hàng ',
                'info_fanpage.required' => 'Yêu cầu thêm trang Fanpage ',
            ]
            );

        $contact = Contact::find($info_id);
        $contact->info_address = $data['info_address'];
        $contact->info_number = $data['info_number'];
        $contact->info_email = $data['info_email'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];
        $contact->save();

        Toastr::success('Cập nhật thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return redirect::to('dashboard');
    }

    public function save_information(Request $request){
        $data = $request->all();
        $data = $request->validate(
            [
                'info_address' => 'required:tbl_information',   
                'info_number' => 'required|numeric',
                'info_email' => 'required|email',
                'info_map' => 'required',
                'info_fanpage' => 'required',
                
            ],
            [
                'info_address.required' => 'Yêu cầu nhập địa chỉ',
                'info_number.required' => 'Yêu cầu thêm số điện thoại ',
                'info_number.numeric' => 'Không phải định dạng số điện thoại ',
                'info_email.required' => 'Thêm địa chỉ email ',
                'info_email.email' => 'Không phải định dạng email ',
                'info_map.email' => 'Yêu cầu thêm địa chỉ cửa hàng ',
                'info_fanpage.required' => 'Yêu cầu thêm trang Fanpage ',
            ]
            );
        $contact = new Contact();
        $contact->info_address = $data['info_address'];
        $contact->info_number = $data['info_number'];
        $contact->info_email = $data['info_email'];
        $contact->info_fanpage = $data['info_fanpage'];
        $contact->info_map = $data['info_map'];
        $contact->save();

        return redirect()->back()->with('Thêm thông tin thành công!');
    }

}
