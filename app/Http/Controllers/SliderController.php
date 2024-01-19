<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Slider;
use Carbon\Carbon;
use App\Models\CategoryPostModel;
use Session;
use Illuminate\Support\Facades\Redirect;
use Toastr;
session_start();

class SliderController extends Controller
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

    public function add_slider(){
        $this->AuthLogin();
        $all_slide = Slider::orderby('slider_id','desc')->get();
        return view('admin.slider.add_slider');
    }

    public function insert_slider(Request $request){
        $this->AuthLogin();
       
        $data = $request->validate(
            [
                'slider_name' => 'required:tbl_slider',   
                'slider_image' => 'required|image',
                 'slider_status' => 'required',
                 'slider_type' => 'required',
            ],
            [
                'slider_name.required' => 'Yêu cầu nhập tên Banner',
                'slider_image.required' => 'Yêu cầu thêm Banner ',
                'slider_image.image' => 'Không đúng định dạng hình ảnh ',
                'slider_status.required' => 'Yêu cầu nhập mô tả Banner ',
                'slider_type.required' => 'Yêu cầu nhập mô tả Banner ',
            ]
            );

        $all_slide = Slider::orderby('slider_id','desc')->get();
        $get_image = $request->file('slider_image');
        
        if($get_image){
            //lấy file hình ảnh
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/slider',$new_image);
            
            $slider = new Slider();
            $slider -> slider_name = $data['slider_name'];
            $slider -> slider_image = $new_image;
            // $slider -> slider_desc = $data['slider_desc'];
            $slider -> slider_status = $data['slider_status'];
            $slider -> slider_type = $data['slider_type'];
            $slider->save();
            Toastr::success('Thêm Banner thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('manage-banner');
        }else{
            Toastr::error('Chưa thêm hình ảnh Banner','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
            return Redirect::to('manage-banner');
        }
        //insert du lieu va tbl-slider
        
    }

    public function manage_banner(){
        $this->AuthLogin();
        $all_slide = Slider::orderby('slider_id','desc')->get();

        return view('admin.slider.list_slider')->with(compact('all_slide'));
    }

    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status' =>1]);
        Toastr::success('Đã hiện thị Banner!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('manage-banner');
    }

    public function inactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status' =>0]);
        Toastr::success('Đã ẩn Banner!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('manage-banner');
    }

    public function edit_slider($slider_id){
        $this->AuthLogin();
        $cate_slider =DB::table('tbl_category_slider')->orderby('category_id','desc')->get();
        $brand_slider = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        
        $edit_slider = DB::table('tbl_slider')->where('slider_id',$slider_id)->get();
        Toastr::success('Đã cập nhật Banner!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return view('admin.slider.edit_slider')->with('edit_slider', $edit_slider)->with('cate_slider', $cate_slider)->with('brand_slider', $brand_slider);
    }

    public function delete_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        Toastr::warning('Xóa Banner thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('manage-banner');
    }

}
