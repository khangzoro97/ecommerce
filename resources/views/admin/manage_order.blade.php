@extends('admin-layout')
@section('admin-content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tất cả đơn hàng
            </div>
            <?php
            use Illuminate\Support\Facades\Session;
            $message= Session::get('message');
            if ($message){
                echo '<span class="text-success" style="text-align: center">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                           STT
                        </th>
                        <th>Tên khách hàng</th>
                        <th>Tổng giá tiền</th>
                        <th>Tình trạng</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_order as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->customer_name}}</td>
                        <td>{{explode('.',$value->order_total)[0]}}  VND</td>
                        <td>{{$value->order_status}}</td>
                        <td>
                            <a href="{{URL::to('view-order/'.$value->order_id)}}" class="active" style="margin-right: 16px"><i class="fa fa-eye text-success text-active fa-thumb-styling icon-large"></i></a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng?')" href="{{URL::to('delete-order/'.$value->order_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-success text-danger fa-thumb-styling icon-large"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
