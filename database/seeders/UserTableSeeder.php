<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // : void
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = Admin::create([
            'admin_user'=>'anadmin',
            'admin_name'=>'hoaian-Admin',
            'admin_password'=>md5('123456'),
        ]);

        $author = Admin::create([
            'admin_user'=>'anauthor',
            'admin_name'=>'hoaian-Author',
            'admin_password'=>md5('123456'),
        ]);

        $user = Admin::create([
            'admin_user'=>'anuser',
            'admin_name'=>'hoaian-User',
            'admin_password'=>md5('123456'),
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($adminRoles);
        $user->roles()->attach($adminRoles);
        
    }
}