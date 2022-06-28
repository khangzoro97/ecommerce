<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id= Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('/admin')->send();
        }
    }

    public function add_brand(){
        $this->AuthLogin();
        return view('admin.add_brand');
    }

    public function all_brand(){
        $this->AuthLogin();
        $tbl_brand=DB::table('tbl_brand')->get();
        return view('admin.all_brand',compact('tbl_brand'));
    }
    public function save_brand(Request $request){
        $this->AuthLogin();
        $brand_name= $request->brand_name;
        $brand_decr= $request->brand_decr;
        $brand_status= $request->status;

        DB::table('tbl_brand')->insert([
            "brand_name"=>$brand_name,
            "brand_desc"=>$brand_decr,
            "brand_status"=>$brand_status,
        ]);
        Session::put('message','Thêm thương hiệu thành công!');
        return Redirect::back();
    }
    public function unactive_brand($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)
            ->update(["brand_status"=>0]);
        Session::put('message1','Huỷ kích hoạt thương hiệu');
        return Redirect::to('all-brand');
    }
    public function active_brand($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)
            ->update(["brand_status"=>1]);
        Session::put('message','Đã kích hoạt thương hiệu');
        return Redirect::to('all-brand');
    }
    public function edit_brand($brand_id){
        $this->AuthLogin();
        $edit_brand=DB::table('tbl_brand')->where('brand_id',$brand_id)->get();
        return view('admin.edit_brand',compact('edit_brand'));
    }
    public function update_brand(Request $request,$brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)
            ->update(['brand_name'=>$request->brand_name,
                'brand_desc'=>$request->brand_desc
            ]);
        Session::put('message','Cập nhật thương hiệu thành công');
        return Redirect::to('all-brand');
    }

    public function delete_brand(Request $request,$brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_id)
            ->delete();
        Session::put('message','Xóa thương hiệu thành công');
        return Redirect::to('all-brand');
    }


    //show brand in home
    public function show_brand_home($brand_id){
        $list_category= DB::table('tbl_category_product')
            ->where('category_status','=',1)->orderBy('category_id','desc')->get();
        $list_brand= DB::table('tbl_brand')
            ->where('brand_status','=',1)->orderBy('brand_id','desc')->get();
        $show_brand=DB::table('tbl_product')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->where('tbl_product.brand_id',$brand_id)
            ->get();
        $count= count($show_brand);
        if($count>0) {
            $name_brand = DB::table('tbl_product')
                ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
                ->where('tbl_product.brand_id', $brand_id)
                ->first()->brand_name;
            return view('pages.brand.show_brand', compact('show_brand', 'list_category', 'list_brand', 'name_brand','count'));
        }
        else{
            return view('error404');
        }
    }
}
