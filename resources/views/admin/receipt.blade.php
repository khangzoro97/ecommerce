<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hóa đơn</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 5px;
        }
        .column {
            text-align: center;
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px; /* Should be removed. Only for demonstration */
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>

</head>
<body>
<div>
    <p style="text-align: right"><strong>Cộng hòa xã hội chủ nghĩa Việt Nam</strong></p>
    <p style="text-align: right;margin-right: 32px"><strong>Độc lập- Tự do -Hạnh phúc</strong></p>
    <p style="text-align: center;font-size: 16px;"><strong>HÓA ĐƠN SẢN PHẨM</strong></p>
    <p style="text-align: center;font-size: 13px">Ngày: {{$now}}</p>
    <p style="font-size: 14px"><strong>Thông tin người đặt</strong></p>

    <ul>
        <li>TÊN KHÁCH HÀNG:  {{$order->shipping_name}}</li>
        <li>SỐ ĐIỆN THOẠI :  {{$order->shipping_number}}</li>
        <li>EMAIL         :  {{$order->shipping_email}}</li>
        <li>ĐỊA CHỈ       :  {{$order->shipping_adress}}</li>
        <li>PHƯƠNG THỨC THANH TOÁN       :  Tiền mặt</li>
        <li>NGÀY ORDER       :  {{$order->created_at}}</li>
        <li>GHI CHÚ       :  {{$order->shipping_message}}</li>
    </ul>
    <p style="font-size: 14px"><strong>Thông tin đặt hàng</strong></p>
   <table  style="width: 100%;text-align: center;">
        <thead style="font-weight: bold;">
        <tr>
            <th style="vertical-align : middle;width: 5%;font-size: 14px;">STT</th>
            <th style="vertical-align : middle;width: 15%;font-size: 14px;">TÊN SẢN PHẨM</th>
            <th style="vertical-align : middle;width: 15%;font-size: 14px;">GIÁ SẢN PHẨM</th>
            <th  style="vertical-align : middle;width: 10%;font-size: 14px;">SỐ LƯỢNG</th>
            <th style="vertical-align : middle;width: 15%;font-size: 14px;">THÀNH TIỀN</th>
        </tr>
        </thead>
       <tbody>
       @foreach($view_order as $key =>$value)

           <tr>
               <td style="font-size: 14px;">{{$key+1}}</td>
               <td style="font-size: 14px;">{{$value->product_name}}</td>
               <td style="font-size: 14px;">{{number_format($value->product_price)}}</td>
               <td style="font-size: 14px;">{{$value->product_quantity}}</td>
               <td style="font-size: 14px;">{{number_format($value->product_price*$value->product_quantity)}}</td>
           </tr>
       @endforeach
       </tbody>
       <tr>
           <td colspan="4" class="text-center" style="color:red;font-size: 14px;"><b>Tổng</b></td>
           <td style="font-size: 14px;"><b>{{number_format((int)$value->order_total*1000/1.1)}}</b></td>
       </tr>
       <tr>
           <td colspan="4" class="text-center" style="color:red;font-size: 14px;"><b>Thuế VAT</b></td>
           <td style="font-size: 14px;"><b>{{number_format((int)$value->order_total*1000/11)}}</b></td>
       </tr>
       <tr>
           <td colspan="4" class="text-center" style="color:red;font-size: 14px;"><b>Tổng cộng</b></td>
           <td style="font-size: 14px;"><b>{{number_format((int)$value->order_total*1000)}} VNĐ</b></td>
       </tr>
     {{--  <tr>
           <td colspan="5" style="vertical-align : middle;font-size: 10px;"><strong>TỔNG CỘNG</strong></td>
           <td style="vertical-align : middle;font-size: 10px;"><strong></strong></td>
       </tr>--}}
    </table>
    <br><br>
    <p style="text-align: center;"><strong>DOKA SHOP</strong></p>



</div>

</body>
</html>

