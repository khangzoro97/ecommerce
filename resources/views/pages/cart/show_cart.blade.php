@extends('layout_not_content')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <?php
                use Gloudemans\Shoppingcart\Facades\Cart;
                $content= Cart::content();
                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng cộng</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($content as $key=>$value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="../upload/product/{{$value->options->image}}" alt="" width="70"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>
                            <p>Web ID: {{$value->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value->price,0,',','.')}} đ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/quantity-update/'.$value->rowId)}}" method="post">
                                    @csrf
                                <input class="cart_quantity_input" style="width: 60px!important;margin-right: 16px" type="number" name="quantity" value="{{$value->qty}}" autocomplete="off">
                                <button type="submit" class="fa fa-save btn btn-success" ></button>
                                </form>
                            </div>

                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">{{number_format($value->qty*$value->price,0,',','.')}} đ</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng cộng<span>{{Cart::priceTotal(0,',','.')}}</span></li>
                            <li>Thuế <span>{{Cart::tax(0,',','.')}}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{Cart::total(0,',','.')}}</span></li>
                        </ul>
                        <a class="btn btn-default update" href="{{URL::to('/trang-chu')}}">Mua thêm</a>

                        <?php
                        $customer_id= Session::get('customer_id');
                        if($customer_id!=null){
                        ?>
                        <a class="btn btn-default update" href="{{URL::to('/checkout')}}">Thanh toán</a>
                        <?php
                        }else{
                        ?>
                        <a class="btn btn-default update" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->

@endsection

