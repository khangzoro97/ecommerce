<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function login_checkout(){
        return view('pages.checkout.login_checkout');
    }

    public function creat_customer(Request $request){
        $customer_name= $request->customer_name;
        $customer_id=DB::table('customer')->insert([
            'customer_number'=>$request->customer_number,
            'customer_email'=>$request->customer_email,
            'customer_name'=>$customer_name,
            'customer_password'=>md5($request->customer_password),
        ]);
        Session::put('message','Đăng ký thành công,vui lòng đăng nhập!');
        return Redirect::back();
    }
    public function customer_login(Request $request){
        $customer_number= $request->customer_number;
        $customer_password= md5($request->customer_password);
        $result= DB::table("customer")->where([["customer_number",$customer_number],
            ["customer_password",$customer_password]])->first();
        if($result){
            Session::put('customer_name',$result->customer_name);
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/trang-chu');
        }else{
            Session::put('message2',"Mật khẩu hoặc số điện thoại nhập sai. Vui lòng nhập lại!");
            return Redirect::back();
        }
    }
    public function checkout(){
        return view('pages.checkout.checkout');
    }
    public function save_shippng(Request $request){
        $now= Carbon::now('Asia/Ho_Chi_Minh');
        $customer_id=Session::get('customer_id');
        $payment_method= $request->payment;
        $shipping_number= $request->shipping_number;
        $shipping_email= $request->shipping_email;
        $shipping_name= $request->shipping_name;
        $shipping_adress= $request->shipping_adress;
        $shipping_message= $request->shipping_message;
        $contents= Cart::content();

        $shipping_id=DB::table('shipping')->insertGetId([
            'customer_id'=>$customer_id,
            'shipping_number'=>$shipping_number,
            'shipping_email'=>$shipping_email,
            'shipping_name'=>$shipping_name,
            'shipping_adress'=>$shipping_adress,
            'shipping_message'=>$shipping_message,
            'created_at'=>$now,
        ]);
        $payment_id=DB::table('tbl_payment')->insertGetId([
            'payment_method'=>$payment_method,
            'payment_status'=>"Đang chờ xử lý",
            'created_at'=>$now,
        ]);
        $order_id=DB::table('tbl_order')->insertGetId([
            'customer_id'=>$customer_id,
            'shipping_id'=>$shipping_id,
            'payment_id'=>$payment_id,
            'order_total'=>Cart::total(),
            'order_status'=>"Đang chờ xử lý",
            'created_at'=>$now,
        ]);
        foreach ($contents as $content) {
            DB::table('tbl_order_detail')->insert([
                'order_id' => $order_id,
                'product_id' => $content->id,
                'product_name' => $content->name,
                'product_price' => $content->price,
                'product_quantity' => $content->qty,
                'created_at'=>$now,
            ]);
        }
        Session::put('shipping_id',$shipping_id);
        if($payment_method==1){
            Cart::destroy();
            echo 'Thanh toán bằng thẻ ATM';
        }
        elseif($payment_method==2){
            Cart::destroy();
            return view('pages.checkout.thank_you');
        }
        elseif($payment_method==3){
            Cart::destroy();
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
    }
    public function logout_customer(){
        Session::flush();
        Auth::logout();
        return Redirect::to('/trang-chu');
    }


    //backend
    public function AuthLogin(){
        $admin_id= Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('/admin')->send();
        }
    }
    public function manage_order(){
        $this->AuthLogin();
        $list_order=DB::table('tbl_order')
            ->join('customer','tbl_order.customer_id','=','customer.customer_id')
            ->select('tbl_order.*','customer.customer_name')
            ->orderBy('tbl_order.order_id','desc')
            ->get();
        return view('admin.manage_order',compact('list_order'));
    }
    public function view_order($order_id){
        $this->AuthLogin();
        $view_order=DB::table('tbl_order')
            ->join('customer','tbl_order.customer_id','=','customer.customer_id')
            ->join('shipping','tbl_order.shipping_id','=','shipping.shipping_id')
            ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
            ->join('tbl_payment','tbl_order.payment_id','=','tbl_payment.payment_id')
            ->where('tbl_order.order_id','=',$order_id)
            ->get();

        return view('admin.edit_order',compact('view_order'));
    }
    public function delete_order($order_id){
        $this->AuthLogin();
        DB::table('tbl_order')->join('tbl_payment','tbl_order.payment_id','=','tbl_payment.payment_id')
            ->join('shipping','tbl_order.shipping_id','=','shipping.shipping_id')
            ->join('tbl_order_detail','tbl_order.order_id','=','tbl_order_detail.order_id')
            ->where('tbl_order.order_id','=',$order_id)
            ->delete();
        Session::put('message','Xoá đơn hàng thành công!!');
        return Redirect::back();
    }
}
