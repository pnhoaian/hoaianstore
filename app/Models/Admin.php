<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    public $timestamps = false; //set time la false
    protected $fillable = ['admin_user','admin_password','admin_name','admin_phone'];
    protected $primaryKey = 'admin_id';

    protected $table = 'tbl_admin';

    public function roles(){
        return $this->belongsToMany('App\Models\Roles','id_roles');
    }

    public function getAuthPassword(){
        return $this->admin_password;
    }

    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }

    public function hasRoles($roles){
        return null !== $this->roles()->whereIn('name',$role)->first();
    }
}