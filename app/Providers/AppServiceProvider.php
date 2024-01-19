<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Post;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetails;
use Session;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*',function($view){
            $customer1 = Customer::find(Session::get('customer_id'));
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $max_price_range = $max_price + 500000;
            $cate_product1 =DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();


            $productt = Product::all()->count();
            $product_vieww = Product::orderby('product_view','desc')->take(5)->get();
            $product_soldd = Product::orderby('product_sold','desc')->take(5)->get();
            
            $postt = Post::all()->count();
            $post_vieww = Post::orderBy('post_view','desc')->take(5)->get();

            $orderr = Order::all()->count();
            $customerr = Customer::all()->count();

            $sldon = DB::table('tbl_order')->where('order_date','like','2024')->get();
            $demsldon = $sldon->count();


            $view->with('min_price',$min_price)
            ->with('max_price',$max_price)
            ->with('max_price_range',$max_price_range)
            ->with('customer1',$customer1)
            ->with('cate_product1',$cate_product1)
            
            ->with('productt',$productt)
            ->with('product_vieww',$product_vieww)
            ->with('postt',$postt)
            ->with('post_vieww',$post_vieww)
            ->with('orderr',$orderr)
            ->with('customerr',$customerr)
            ->with('product_soldd',$product_soldd)

            ->with('sldon',$sldon)
            ->with('demsldon',$demsldon)
            
            
            ;


            // ->with('productt',$productt)
            // ->with('postt',$postt)
            // ->with('orderr',$orderr)
            // ->with('customerr',$customerr)
            // ->with('adminn',$adminn)
            // ->with('thongtinlienhe',$thongtinlienhe)
            // ->with('productbanchay',$productbanchay)
            // ->with('productkhongbanduoc',$productkhongbanduoc)
            // ->with('customerrrr',$customerrrr);

        });
    }
}