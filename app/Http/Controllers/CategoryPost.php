<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\CatePost;
use Toastr;
session_start();

class CategoryPost extends Controller
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
    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.categorypost.add_categorypost');
    }

    public function all_category_post(){
        $this->AuthLogin();
        // $all_category_post = DB::table('tbl_category_post')->get(); 
        $all_category_post = CatePost::OrderBy('cate_post_id','Desc')->paginate(5);
        
        return view('admin.categorypost.all_categorypost')->with(compact('all_category_post'));
        //return view('admin.all_category_post');
    }

    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
//Kiểm tra DL đầu vào
//* required bắt buộc
//* unique đã có rồi
        $data = $request->validate(
            [
                'cate_post_name' => 'required|max:255|unique:tbl_category_post',   
                'cate_post_desc' => 'required|max:255',
                'cate_post_status' => 'required'
            ],
            [
                'cate_post_name.required' => 'Yêu cầu nhập tên danh mục bài viết',
                'cate_post_name.unique' => 'Tên danh mục bài viết đã tồn tại trên hệ thống',
                'cate_post_name.max' => 'Tên danh mục bài viết quá dài',

                'cate_post_desc.required' => 'Yêu cầu nhập mô tả danh mục bài viết ',
                'cate_post_desc.max' => 'Mô tả danh mục bài viết quá dài',

                'cate_post_status.required' => 'Yêu cầu thêm trạng thái danh mục bài viết ',
            ]
            );
            
        $cate_post = new CatePost();
        $cate_post ->cate_post_name = $data['cate_post_name'];
        $cate_post ->cate_post_desc = $data['cate_post_desc'];
        $cate_post ->cate_post_status = $data['cate_post_status'];
        $cate_post->save();
        //insert du lieu va tbl-category-post
        // DB::table('tbl_category_post')->insert($data);
        Toastr::success('Thêm danh mục bài viết thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-post');
        //return view('admin.save_category_post');
    }

    public function active_cate_post($cate_post_id ){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('cate_post_id',$cate_post_id)->update(['cate_post_status' =>1]);
        Toastr::success('Đã hiện thị danh mục bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-post');
    }

    public function inactive_cate_post($cate_post_id ){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('cate_post_id',$cate_post_id)->update(['cate_post_status' =>0]);
        Toastr::success('Đã ẩn danh mục bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-post');
    }

    public function edit_category_post($category_post_id){
        $this->AuthLogin();

        $category_post = CatePost::find($category_post_id);

        return view('admin.categorypost.edit_categorypost')->with(compact('category_post'));
    }

    public function delete_category_post($cate_id ){
        $this->AuthLogin();
        $category_post = CatePost::find($cate_id);
        $category_post->delete();
        Toastr::warning('Xóa danh mục bài viết thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('/all-category-post');


        
    }

    public function update_category_post(Request $request, $cate_id){
        // $this->AuthLogin();
        // $data = $request->all();
        // $category_post = CatePost::find($cate_id);
        // $category_post ->category_post_name = $data['cate_post_name'];
        // $category_post ->category_post_desc = $data['cate_post_desc'];
        // $category_post ->category_post_slug = $data['cate_post_slug'];
        // $category_post ->category_post_status = $data['cate_post_status'];
        // $category_post ->save();
        // Session::put('message','Đã cập nhật danh mục bài viết');
        // return Redirect::to('/all-category-post');

        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate(
            [
                'cate_post_name' => 'required',   
                'cate_post_desc' => 'required',
                'cate_post_status' => 'required'
            ],
            [
                'cate_post_name.required' => 'Yêu cầu nhập tên danh mục bài viết',
                'cate_post_desc.required' => 'Yêu cầu nhập mô tả danh mục bài viết ',
                'cate_post_status.required' => 'Yêu cầu thêm trạng thái danh mục bài viết ',
                
            ]
            );
        $cate_post = CatePost::find($cate_id);
        $cate_post->cate_post_name = $data['cate_post_name'];
        $cate_post->cate_post_desc = $data['cate_post_desc'];
        $cate_post->cate_post_status = $data['cate_post_status'];
        $cate_post->save();
        //insert du lieu va tbl-category-post
        // DB::table('tbl_category_post')->insert($data);
        Toastr::success('Đã cập nhật danh mục bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-post');
    }
        //End Function Admin


    // *** Home  ***
    public function danh_muc_bai_viet($cate_post_slug){

    }



    // public function show_category_home(Request $request,$category_id){
    //     $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();

    //     $cate_product =DB::table('tbl_category_post')->where('category_status','1')->orderby('category_id','desc')->get();
       
    //     $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
    //     $category_by_id = DB::table('tbl_product')->join('tbl_category_post','tbl_product.category_id','=','tbl_category_post.category_id')
    //     ->where('tbl_product.category_id',$category_id)->get();
        
    //     $category_name = DB::table('tbl_category_post')->where('tbl_category_post.category_id',$category_id)->limit(1)->get();

    //     return view('pages.category.show_category')
    //     ->with('category', $cate_product)
    //     ->with('brand', $brand_product)
    //     ->with('category_by_id',$category_by_id)
    //     ->with('category_name',$category_name)
    //     ->with('slider',$slider);
    
    // }
}