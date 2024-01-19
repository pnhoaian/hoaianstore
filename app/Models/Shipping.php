<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set time la false
    protected $fillable = ['shipping_name','shipping_address','shipping_phone','shipping_email','shipping_note','shipping_method_pay','shipping_method_receive'];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}