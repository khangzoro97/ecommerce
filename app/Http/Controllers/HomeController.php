<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        //SEO
        //end SEO
        $list_category= DB::table('tbl_category_product')
            ->where('category_status','=',1)->orderBy('category_id','desc')->get();
        $list_brand= DB::table('tbl_brand')
            ->where('brand_status','=',1)->orderBy('brand_id','desc')->get();
        $list_product= DB::table('tbl_product')->where('product_status','=',1)
            ->orderBy('product_id','desc')->limit(6)->get();
        return view('pages.home',compact('list_category','list_brand','list_product'));
    }
    public function search(Request $request){
        $keyword=$request->keyword;
        $list_category= DB::table('tbl_category_product')
            ->where('category_status','=',1)->orderBy('category_id','desc')->get();
        $list_brand= DB::table('tbl_brand')
            ->where('brand_status','=',1)->orderBy('brand_id','desc')->get();
        $search_product= DB::table('tbl_product')->where('product_status','=',1)
            ->where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.product.search_product',compact('list_category','list_brand','search_product'));
    }
    public function contact(){
        return view('pages.contact');
    }
    public function send_mail(Request $request){
        $name= $request->name;
        $email= $request->email;
        $subject= $request->subject;
        $mess= $request->message;
        Mail::send([], [], function ($message) use ($name, $email,$subject,$mess) {
            $message->to('khangzoro97@gmail.com')
                ->subject('Phản hồi DoKa: '.$subject)
                ->setBody($email.'('.$name.'): '.$mess);
        });
        return view('thank_you');
    }
}
