<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    public $timestamps = false;
    protected $fillable=['info_desc','info_image'];
    
    protected $primaryKey = 'intro_id';
    protected $table = 'tbl_intro';
}
