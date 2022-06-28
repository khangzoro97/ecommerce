@extends('layout')
@section('content')
    <div id="features_items" class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới nhất</h2>
        @foreach($list_product as $key=>$value)
        <a href="{{URL::to('chi-tiet-san-pham/'.$value->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <form action="{{route('save_cart')}}" method="post">
                        @csrf
                    <div class="productinfo text-center">
                        <img src="upload/product/{{$value->product_image}}" alt="" />
                        <h2>{{$value->product_name}}</h2>
                        <input name="qty" type="hidden" value="1" />
                        <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
                        <p style="color: green">{{number_format($value->product_price).'  VNĐ'}}</p>
                        <button type="submit" class="btn btn-fefault cart add-to-cart">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm giỏ hàng
                        </button>
                    </div>
                    </form>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-heart"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-compress"></i>So sánh</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </a>
        @endforeach

    </div><!--features_items-->
    <div class="fb-comments fa-border" data-href="http://127.0.0.1:8000/danh-muc-san-pham/8" data-width="" data-numposts="10"
         data-colorscheme="dark" data-width="100%"></div>

@endsection

