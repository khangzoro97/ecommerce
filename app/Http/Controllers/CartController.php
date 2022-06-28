<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function save_cart(Request $request){
        $product_id= $request->productid_hidden;
        $quantity= $request->qty;
        $cart_product=DB::table('tbl_product')->where('product_id','=',$product_id)->first();
        $data['id']=$cart_product->product_id;
        $data['name']=$cart_product->product_name;
        $data['qty']=$quantity;
        $data['price']=$cart_product->product_price;
        $data['weight']=1;
        $data['options']['image']=$cart_product->product_image;
        $cart=Cart::add($data);

        Cart::setGlobalTax(10);

        //add cart (id,name,quatity,price,weigt,image)
        return Redirect::back();
    }
    public function show_cart(){
        return view('pages.cart.show_cart');
    }
    public function delete_cart($rowId){
        Cart::remove($rowId);
        $cart= Cart::subtotal();

        if($cart!="0.00"){
            return back();
        }
        else{
            return Redirect::to('trang-chu');
        }

    }
    public function quantity_update($rowId,Request $request){
        Cart::update($rowId, ['qty' => $request->quantity]);
        return back();
    }
}
