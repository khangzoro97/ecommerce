<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $category_product= DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand= DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('admin.add_product',compact('category_product','brand'));
    }

    public function all_product(){
        $this->AuthLogin();
        $tbl_product=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->orderBy('tbl_product.product_id','desc')->get();
        return view('admin.all_product',compact('tbl_product'));
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $product_name= $request->product_name;
        $product_image= "";
        $product_decr= $request->product_decr;
        $product_content= $request->product_content;
        $product_price= $request->product_price;
        $category_product= $request->category_product;
        $brand= $request->brand;
        $product_status= $request->status;

        $get_image= $request->file('product_image');
        if($get_image){
            $get_name_image= current(explode('.',$get_image->getClientOriginalName()));
            $new_image= $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('/upload/product',$new_image);
            $product_image=$new_image;
        }

        DB::table('tbl_product')->insert([
            "product_name"=>$product_name,
            "product_image"=>$product_image,
            "product_desc"=>$product_decr,
            "product_content"=>$product_content,
            "product_price"=>$product_price,
            "category_id"=>$category_product,
            "brand_id"=>$brand,
            "product_status"=>$product_status,
        ]);
        Session::put('message','Thêm sản phẩm thành công!');
        return Redirect::back();
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)
            ->update(["product_status"=>0]);
        Session::put('message1','Huỷ kích hoạt sản phẩm');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)
            ->update(["product_status"=>1]);
        Session::put('message','Đã kích hoạt sản phẩm');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->AuthLogin();
        $category_product= DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand= DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product=DB::table('tbl_product')->where('product_id',$product_id)->get();
        return view('admin.edit_product',compact('edit_product','category_product','brand'));
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $get_image= $request->file('product_image');
        if($get_image){
            $get_name_image= current(explode('.',$get_image->getClientOriginalName()));
            $product_image= $get_name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/product',$product_image);
        }else{
            $product_image=DB::table('tbl_product')->where('product_id',$product_id)->first()->product_image;
        }

        DB::table('tbl_product')->where('product_id',$product_id)
            ->update([
                "product_name"=>$request->product_name,
                "product_image"=>$product_image,
                "product_desc"=>$request->product_decr,
                "product_content"=>$request->product_content,
                "product_price"=>$request->product_price,
                "category_id"=>$request->category_product,
                "brand_id"=>$request->brand,
            ]);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }

    public function delete_product(Request $request,$product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)
            ->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }

    //end Admin page



    //frondend
    public function detail_product($product_id){
        $list_category= DB::table('tbl_category_product')
            ->where('category_status','=',1)->orderBy('category_id','desc')->get();
        $list_brand= DB::table('tbl_brand')
            ->where('brand_status','=',1)->orderBy('brand_id','desc')->get();
        $product_detail=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->where('tbl_product.product_id','=',$product_id)
            ->get();

        $category_id=DB::table('tbl_product')
            ->where('product_id','=',$product_id)
            ->first()->category_id;
        $product_recommend=DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
            ->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')
            ->where('tbl_product.category_id','=',$category_id)
            ->whereNotIn('tbl_product.product_id',[$product_id])
            ->get();

        return view('pages.product.product_detail',compact('list_category','list_brand','product_detail','product_recommend'));
    }
}
