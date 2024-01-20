<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use Toastr;
use App\Models\CateProduct;
use App\Models\CatePost;
use App\Models\Product;
session_start();

class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.categoryproduct.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        return view('admin.categoryproduct.all_category_product')->with('all_category_product', $all_category_product);
        //return view('admin.all_category_product');
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate(
            [
                'category_name' => 'required|max:255|unique:tbl_category_product',   
                'category_desc' => 'required',
                'category_status' => 'required',
            ],
            [
                'category_name.required' => 'Yêu cầu nhập tên danh mục sản phẩm',
                'category_name.unique' => 'Tên danh mục sản phẩm đã tồn tại trên hệ thống',
                'category_name.max' => 'Tên danh mục sản phẩm quá dài',

                'category_desc.required' => 'Yêu cầu nhập mô tả danh mục sản phẩm ',
                'category_status.required' => 'Yêu cầu nhập tình trạng hiển thị danh mục sản phẩm ',
            ]
            );
        $cate_p = new CateProduct();
        $cate_p->category_name = $data['category_name'];
        $cate_p->category_desc = $data['category_desc'];
        
        $cate_p->category_status = $data['category_status'];

        $cate_p->save();
       Toastr::success('Thêm danh mục sản phẩm thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
       return Redirect::to('all-category-product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>1]);
        Toastr::success('Đã hiện thị danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function inactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' =>0]);
        Toastr::success('Đã ẩn danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        return view('admin.categoryproduct.edit_category_product')->with('edit_category_product', $all_category_product);
        //return view('admin.all_category_product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Toastr::warning('Xóa danh mục sản phẩm thành công','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }

    public function update_category_product(Request $request, $category_id){
        $this->AuthLogin();
        $data = $request->all();
        $data = $request->validate(
            [
                'category_name' => 'required|max:255',   
                'category_desc' => 'required',
            ],
            [
                'category_name.required' => 'Yêu cầu nhập tên danh mục sản phẩm',
                'category_name.max' => 'Tên danh mục sản phẩm quá dài',

                // 'category_name.unique' => 'Tên danh mục sản phẩm đã tồn tại trên hệ thống',
                'category_desc.required' => 'Yêu cầu nhập mô tả danh mục sản phẩm ',
            ]
            );
        $cate_p = CateProduct::find($category_id);
        $cate_p->category_name = $data['category_name'];
        $cate_p->category_desc = $data['category_desc'];
        

        $cate_p->save();
        Toastr::success('Đã cập nhật danh mục sản phẩm','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect::to('all-category-product');
    }
        //End Function Admin

    public function show_category_home(Request $request,$category_id){
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',0)->take(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->get();
        
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();


        $min_price = Product::min('product_price_sale');
        $max_price = Product::max('product_price_sale');

        $category_by_slug = CateProduct::where('category_id',$category_id)->get();
        foreach ($category_by_slug as $key => $cate) {
            $category_id = $cate->category_id;
        }

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->orderBy('product_price_sale','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->orderBy('product_price_sale','ASC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->orderBy('product_name','DESC')->paginate(10)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->orderBy('product_name','ASC')->paginate(10)->appends(request()->query());
            }
        }elseif(isset($_GET['start_price']) && $_GET['end_price']){
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->whereBetween('product_price',[$min_price,$max_price])->orderBy('product_price','ASC')->paginate(10)->appends(request()->query());

        }else {
            $category_by_id = Product::with('category')->where('category_id',$category_id)->where('product_status',1)->orderBy('product_id','DESC')->paginate(10);
        }

        
        
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name)
        ->with('category_post',$category_post)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('min_price',$min_price)
        ->with('max_price',$max_price)
        // ->with('max_price_range',$max_price_range)
        ;
    }

}