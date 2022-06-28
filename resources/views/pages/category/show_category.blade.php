@extends('layout')
@section('content')
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Danh mục <strong>{{$name_category}}</strong></h2>
        @foreach($show_category as $key=>$value)
        <a href="{{URL::to('chi-tiet-san-pham/'.$value->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="../upload/product/{{$value->product_image}}" alt="" />
                        <h2>{{$value->product_name}}</h2>
                        <p style="color: green">{{number_format($value->product_price).'  VNĐ'}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
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

@endsection

