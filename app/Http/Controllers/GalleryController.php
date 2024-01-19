<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\CatePost;
use App\Models\Gallery;
use App\Models\Rating;
use App\Models\Customer;
use App\Models\Product;
use Toastr;
session_start();

class GalleryController extends Controller
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

    public function add_gallery($product_id){
        $this->AuthLogin();
        $pro_id = $product_id; 
        // $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        // $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.gallery.add_gallery')->with(compact('pro_id'));
    }

    public function select_gallery(Request $request){
        $product_id =  $request->pro_id;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output = ' <form> 
        '.csrf_field().'
        <table class="table table-hover">
                            <thead>
                              <tr>
                              <th>STT</th>
                                <th>Tên hình ảnh</th>
                                <th>Hình ảnh</th>
                                <th>Tác vụ</th>
                              </tr>
                            </thead>
                            <tbody>
        
        ';
        if($gallery_count>0){
            $i=0;
            foreach($gallery as $key => $gal){
                $i++;
                $output.='
                
                <tr>            <td>'.$i.'</td>
                                <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                                <td>

                                <img src="'.url('public/upload/gallery/'.$gal->gallery_image).'" class="img-thumbnail" width="120px" height="120px">
                                <input type="file" class="file_image" style="width:40%" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'" name="file" accept="image/*">
                                </td>
                                <td>
                                <button type="button" data-gal_id="'.$gal->gallery_id.'" class="button-xoa delete-gallery">Xóa</button>
                                
                                </td>
                              </tr>
                              
                
                
                ';
            }
        }else{
            $output.='
                <tr>
                                <td colspan="4">Sản phẩm này chưa có thư viện ảnh</td>
                              </tr>
                
                
                ';
        }
        $output.='
            </tbody>
            </table>
            </form>
        ';
        echo $output;
    }
    

    public function insert_gallery($pro_id,Request $request){
        $get_image = $request->file('file');
        if($get_image){
            foreach($get_image as $image){
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/upload/gallery',$new_image);
                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
            }
        }
        Toastr::success('Thêm thư viện ảnh thành công!','Thông báo !', ["positionClass" => "toast-top-right","timeOut" => "2000","progressBar"=> true,"closeButton"=> true]);
        return Redirect()->back();
    }

    public function update_gallery_name(Request $request){
        $gal_id = $request->gal_id;
        $gal_text = $request->gal_text;
        $gallery = Gallery::find($gal_id);
        $gallery->gallery_name = $gal_text;
        $gallery->save();
    }

    public function delete_gallery(Request $request){
        $gal_id = $request->gal_id;
        $gallery = Gallery::find($gal_id);
        unlink('public/upload/gallery/'.$gallery->gallery_image);
        $gallery->delete();

    }
    public function update_gallery(Request $request){
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/upload/gallery',$new_image);
                $gallery = Gallery::find($gal_id);
                unlink('public/upload/gallery/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_image;
                $gallery->save();
            }
        }
    
    
}
