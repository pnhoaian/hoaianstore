<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\CatePost;
use App\Models\Post;
use App\Models\Slider;
use Toastr;
session_start();

class PostController extends Controller
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

    public function add_post(){
        $this->AuthLogin();
        $cate_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));
    }

    public function all_post(){
        $this->AuthLogin();
        // $all_post = DB::table('tbl_post')->get(); 
        $all_post = Post::with('cate_post')->OrderBy('post_id','desc')->get();
        
        return view('admin.post.all_post')->with(compact('all_post'));
        //return view('admin.all_post');
        
    }

    public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $data = $request->validate(
            [
                'post_title' => 'required|max:255|unique:tbl_posts',   
                'post_desc' => 'required',
                'post_content' => 'required',
                'post_image' => 'required|image',
                'cate_post_id' => 'required',
                'post_status' => 'required',
                
            ],
            [
                'post_title.required' => 'Yêu cầu nhập tên bài viết',
                'post_title.unique' => 'Tên bài viết đã tồn tại trên hệ thống',
                'post_title.max' => 'Tên bài viết quá dài',

                'post_desc.required' => 'Yêu cầu nhập mô tả ngắn bài viết ',
                'post_image.required' => 'Thêm hình ảnh cho bài viết ',
                'post_content.required' => 'Yêu cầu nhập mô tả cho bài viết ',
                'post_image.image' => 'Không phải định dạng hình ảnh ',
                'cate_post_id.required' => 'Thêm danh mục cho bài viết ',
                'post_status.required' => 'Yêu cầu thêm trạng thái bài viết ',

            ]
            );


        $post = new Post();
        $post ->post_title = $data['post_title'];
        $post ->post_desc = $data['post_desc'];
        $post ->post_content = $data['post_content'];
        $post ->cate_post_id = $data['cate_post_id'];
        $post ->post_status = $data['post_status'];
        $get_image = $request->file('post_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $data['post_image'] = $new_image;
            $post->post_image = $new_image;
            $post->save();
            //insert du lieu va tbl-post
        // DB::table('tbl_post')->insert($data);
        Toastr::success('Thêm bài viết thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-post');
         }
        // else{
        //     Session::put('message', 'Chưa thêm ảnh bài viết');
        //     return Redirect::to('add-post');
        //  }
        
    }

    public function edit_post($post_id){
        $this->AuthLogin();
        $cate_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        $post = Post::find($post_id);
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }

    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        $post_image = $post->post_image;
        
        if($post_image){
            $path = ('public/upload/post/'.$post_image);
            unlink($path);
        }
        $post->delete();
        Toastr::warning('Xóa bài viết thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('/all-post');
        
    }

    public function update_post(Request $request, $post_id){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate(
            [
                'post_title' => 'required',   
                'post_desc' => 'required',
                'post_content' => 'required',
                'post_image' => 'image',
                'cate_post_id' => 'required',
                'post_status' => 'required',
                
            ],
            [
                'post_title.required' => 'Yêu cầu nhập tên bài viết',
                'post_desc.required' => 'Yêu cầu nhập mô tả ngắn bài viết ',
                'post_content.required' => 'Yêu cầu nhập mô tả cho bài viết ',
                'post_image.image' => 'Không phải định dạng hình ảnh ',
                'cate_post_id.required' => 'Thêm danh mục cho bài viết ',
                'post_status.required' => 'Yêu cầu thêm trạng thái bài viết ',

            ]
            );
        $post = Post::find($post_id);
        $post ->post_title = $data['post_title'];
        $post ->post_desc = $data['post_desc'];
        $post ->post_content = $data['post_content'];
        $post ->cate_post_id = $data['cate_post_id'];
        $post ->post_status = $data['post_status'];
        $get_image = $request->file('post_image');
        if ($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/post',$new_image);
            $post->post_image = $new_image;
         }
        
         $post->save();
         //insert du lieu va tbl-post
        // DB::table('tbl_post')->insert($data);
        Toastr::success('Đã cập nhật bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-post');
    }

    public function active_post($post_id ){
        $this->AuthLogin();
        DB::table('tbl_posts')->where('post_id',$post_id)->update(['post_status' =>1]);
        Toastr::success('Đã hiện thị bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-post');
    }

    public function inactive_post($post_id ){
        $this->AuthLogin();
        DB::table('tbl_posts')->where('post_id',$post_id)->update(['post_status' =>0]);
        Toastr::success('Đã ẩn bài viết!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-post');
    }

    public function danh_muc_bai_viet(Request $request, $post_id){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $catepost = CatePost::where('cate_post_id',$post_id)->take(1)->get();
        
        foreach($catepost as $key => $cate){
            $cate_id = $cate->cate_post_id;
            $meta_title = $cate->post_title;
        }

        $post = Post::with('cate_post')->where('post_status',1)->where('cate_post_id',$cate_id)->paginate(10);

        return view('pages.post.categorypost')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('slider',$slider)
        ->with('category_post',$category_post)
        ->with('post',$post)
        ->with('cate_post_id',$cate_id)
        ->with('category_post',$category_post)
        ->with('catepost',$catepost)
        ->with('slidermini',$slidermini)
        ->with('meta_title',$meta_title);
    }

    public function bai_viet(Request $request, $post_id){
        $category_post = CatePost::orderBy('cate_post_id','ASC')->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        // $catepost = CatePost::where('cate_post_id',$post_id)->take(1)->get();
        $post = Post::with('cate_post')->where('post_status',1)->where('post_id',$post_id)->take(1)->get();

        foreach($post as $key => $p){
            $cate_id = $p->cate_post_id;
            $meta_title = $p->post_title;
            $cate_post_id = $p->cate_post_id;
        }
        $posttt = Post::where('post_id',$post_id)->first();
        $posttt->post_view = $posttt->post_view + 1;
        $posttt->Save();

        $related = Post::with('cate_post')
        ->where('post_status',1)
        ->where('cate_post_id',$cate_post_id)
        ->whereNotIn('post_id',[$post_id])
        ->take(3)->get();

        return view('pages.post.post')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('slidermini',$slidermini)
        ->with('meta_title',$meta_title)
        ->with('slider',$slider)
        ->with('category_post',$category_post)
        ->with('post',$post)
        ->with('related',$related);
}
}