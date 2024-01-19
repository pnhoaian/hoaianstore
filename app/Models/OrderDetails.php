<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false;
    protected $fillable=['Order_code','Product_id','Product_name','Product_price','Product_sales_quantity','Product_coupon'];
    
    protected $primaryKey = 'Order_details_id';
    protected $table = 'tbl_order_details';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
