@extends('admin-layout')
@section('admin-content')
    <div>
    <a href="{{URL::to('/manage-order')}}" style="margin-right: 16px"><i class="fa fa-reply icon-large"></i></a>
    <a class="btn btn-success" href="{{URL::to('print-order/'.$order_id)}}"><i class="fa fa-print"></i> Xuất hóa đơn</a>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->customer_number}}</td>
                            <td>{{$order->customer_email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Ngày đặt hàng</th>
                        <th>Tên người đặt</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú đơn hàng </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->shipping_name}}</td>
                            <td>{{$order->shipping_number}}</td>
                            <td>{{$order->shipping_adress}}</td>
                            <td>{{$order->shipping_message}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết đơn hàng
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành tiền</th>
                        <th>VAT</th>
                        <th>Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($view_order as $key=>$value)
                        <tr>
                            <td>{{$value->product_name}}</td>
                            <td>{{$value->product_quantity}}</td>
                            <td>{{number_format($value->product_price)}}</td>
                            <td>{{number_format($value->product_price*$value->product_quantity)}}</td>
                            <td>{{number_format(0.1*$value->product_price*$value->product_quantity)}}</td>
                            <td>{{number_format(1.1*$value->product_price*$value->product_quantity)}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tr>
                        <td colspan="5" class="text-center" style="color:red;"><b>Tổng tiền</b></td>
                        <td><b>{{explode('.',$value->order_total)[0]}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div><br>
@endsection
