<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CategoryProduct extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $tbl_category=DB::table('tbl_category_product')->get();
        return view('admin.all_category_product',compact('tbl_category'));
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $category_product_name= $request->category_product_name;
        $category_product_decr= $request->category_product_decr;
        $category_status= $request->status;

        DB::table('tbl_category_product')->insert([
            "category_name"=>$category_product_name,
            "category_desc"=>$category_product_decr,
            "category_status"=>$category_status,
        ]);
        Session::put('message','Thêm danh mục sản phẩm thành công!');
        return Redirect::back();
    }
    public function unactive_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)
            ->update(["category_status"=>0]);
        Session::put('message1','Huỷ kích hoạt danh mục sản phẩm!');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)
            ->update(["category_status"=>1]);
        Session::put('message','Đã kích hoạt danh mục sản phẩm!');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_id){
        $this->AuthLogin();
        $edit_category=DB::table('tbl_category_product')->where('category_id',$category_id)->get();
        return view('admin.edit_category_product',compact('edit_category'));
    }
    public function update_category_product(Request $request,$category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)
            ->update(['category_name'=>$request->category_product_name,
                'category_desc'=>$request->category_product_desc
            ]);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product(Request $request,$category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_id)
            ->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }


    //End Funtion Admin Page
    public function show_category_home($category_id){
        $list_category= DB::table('tbl_category_product')
            ->where('category_status','=',1)->orderBy('category_id','desc')->get();
        $list_brand= DB::table('tbl_brand')
            ->where('brand_status','=',1)->orderBy('brand_id','desc')->get();
        $show_category=DB::table('tbl_product')
            ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            ->where('tbl_product.category_id',$category_id)
            ->get();
        $count= count($show_category);
        if($count>0) {
            $name_category = DB::table('tbl_product')
                ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)
                ->first()->category_name;
            return view('pages.category.show_category', compact('show_category', 'list_category', 'list_brand', 'name_category'));
        }
        else{
            return view('error404');
        }
    }

}
