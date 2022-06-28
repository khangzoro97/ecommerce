@extends('layout_not_content')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                    <li class="active">Thanh toán</li>
                </ol>
            </div><!--/breadcrums-->


            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
            </div><!--/register-req-->

            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
            </div>

            <div class="table-responsive cart_info">
                <?php
                use Gloudemans\Shoppingcart\Facades\Cart;
                $content= Cart::content();
                ?>
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu" style="background-color: #00a6b2">
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
                                    {{$value->qty}}
                                </div>

                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($value->qty*$value->price,0,',','.')}} đ</p>
                            </td>
                            <td >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Tổng cộng</td>
                                        <td>{{Cart::priceTotal(0,',','.')}}</td>
                                    </tr>
                                    <tr>
                                        <td>Thuế</td>
                                        <td>{{Cart::tax(0,',','.')}}</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Phí shipping</td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td>Thành tiền</td>
                                        <td><span>{{Cart::total(0,',','.')}}</span></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <div class="shopper-informations">
                <div class="row">
                        <div class="bill-to">
                            <p>Thông tin mua hàng:</p>
                            <div class="form-one" style="margin-left: 32px">
                                <form action="{{URL::to('save-shipping')}}" method="post">
                                    @csrf
                                    <input type="text" name="shipping_number" placeholder="Điện thoại*" required>
                                    <input type="text" name="shipping_email" placeholder="Email" required>
                                    <input type="text" name="shipping_name" placeholder="Họ và tên" required>
                                    <input type="text" name="shipping_adress" placeholder="Địa chỉ nhận hàng" required>
                                    <textarea rows="3" name="shipping_message"  placeholder="Ghi chú đơn hàng"></textarea>
                                    <div style="margin-top: 16px;color: blue">
                                        <span><input type="radio" name="payment" value="1">Trả bằng thẻ ATM</span>
                                        <span style="margin-left: 16px"><input type="radio" name="payment" value="2">Nhận tiền mặt</span>
                                        <span style="margin-left: 16px"><input type="radio" name="payment" value="3">Thanh toán thẻ ghi nợ</span>
                                    </div>
                                    <button style="margin-top: 16px;width: 150px" type="submit" class="btn btn-success center-block">Đặt hàng</button>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
            <br>

        </div>
    </section> <!--/#cart_items-->

@endsection

