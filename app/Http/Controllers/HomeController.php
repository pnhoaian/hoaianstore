<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\Product;
use App\Models\CatePost;

use Toastr;
session_start();

class HomeController extends Controller
{
    public function index(){

        //slide
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',0)->take(4)->get();
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();
        //post
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_name','asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_name','asc')->get();
        
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(10)->get();

        $product_xem = DB::table('tbl_product')->where('product_status','1')->orderby('product_view','desc')->limit(10)->get();
        
        $product_ban = DB::table('tbl_product')->where('product_status','1')->orderby('product_sold','desc')->limit(5)->get();
        

        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $max_price_range = $max_price + 500000;
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // return view('admin.all_product')->with('all_product', $all_product);
        
        return view('pages.home')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('all_product',$all_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('product_xem',$product_xem)
        ->with('product_ban',$product_ban)
        
        ->with('min_price',$min_price)
        ->with('max_price',$max_price)
        ->with('max_price_range',$max_price_range)
        ;
    }
    
    public function search(Request $request){
        $category_post = CatePost::OrderBy('cate_post_id','Desc')->where('cate_post_status','1')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status','1')->take(4)->get();
        $cate_product =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $keyword = $request->keywords_submit;
        $slidermini = Slider::orderby('slider_id','desc')->where('slider_status','1')->where('slider_type',1)->take(3)->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->where('product_status','1')->get();
        
        $search_product_count = $search_product->count();

        return view('pages.product.search')
        ->with('category', $cate_product)
        ->with('brand', $brand_product)
        ->with('slider',$slider)
        ->with('slidermini',$slidermini)
        ->with('category_post',$category_post)
        ->with('search_product',$search_product)
        ->with('search_product_count',$search_product_count);
    }






    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){
            $product = Product::where('product_status',1)->where('product_name','LIKE','%'.$data['query'].'%')->limit(5)->get();
            $output ='<ul class="dropdown-menu" style="display:block;">';
            $count = $product->count();
            foreach($product as $key =>$val){
                $output.='
                <div style="display:flex;margin-bottom:5px">
                    <img style="width:70px; height:80px"  src="'.asset('public/upload/product/'.$val->product_image).'" alt="">
                    <div>
                        <li  class="li_search_ajax"><a style="font-weight: 600;" href="'.url('/chi-tiet-san-pham/' .$val->product_id).'">'.$val->product_name.'</a></li>
                        
                    </div>
                </div>
                
                ';
                
            }
            if($count == 0){
                $output.='
                <div style="display:flex;margin-bottom:5px">
                    <div>
                        <li  class="li_search_ajax"><a style="font-weight: 600;text-align:center; padding: 5px">Không tìm thấy</a></li>
                        
                    </div>
                </div>
                
                ';
            }
            // <li style="width:110px; class="li_search_ajax"><a>Giá: '.number_format($val->product_price_sale).' '.'đ'.'</a></li>
            $output .='</ul>';
            echo $output;
        }
    }
    
}