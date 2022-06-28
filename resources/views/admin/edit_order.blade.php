@extends('admin-layout')
@section('admin-content')
    <a href="{{URL::to('/manage-order')}}"><i class="fa fa-reply icon-large"></i></a>
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
                    @foreach($view_order as $key=>$value)
                        <tr>
                            <td>{{$value->customer_name}}</td>
                            <td>{{$value->customer_number}}</td>
                            <td>{{$value->customer_email}}</td>
                        </tr>
                    @endforeach
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
                    @foreach($view_order as $key=>$value)
                        <tr>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->shipping_name}}</td>
                            <td>{{$value->shipping_number}}</td>
                            <td>{{$value->shipping_adress}}</td>
                            <td>{{$value->shipping_message}}</td>
                        </tr>
                    @endforeach
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
                        <th>Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($view_order as $key=>$value)
                        <tr>
                            <td>{{$value->product_name}}</td>
                            <td>{{$value->product_quantity}}</td>
                            <td>{{number_format($value->product_price)}}</td>
                            <td>{{explode('.',$value->order_total)[0]}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div><br>
@endsection
