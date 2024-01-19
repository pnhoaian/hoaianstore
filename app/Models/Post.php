<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false; //set time la false
    protected $fillable = ['post_title', 'post_desc','post_content','post_image','post_status','cate_post_id','post_view'];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_posts';

    public function cate_post(){
      return $this->belongsTo('App\Models\CatePost','cate_post_id');
    }
}
