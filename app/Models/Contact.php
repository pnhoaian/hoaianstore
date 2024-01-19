<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable=['info_address','info_map','info_email','info_number','info_fanpage'];
    
    protected $primaryKey = 'info_id';
    protected $table = 'tbl_information';
}
