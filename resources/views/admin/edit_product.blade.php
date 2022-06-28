@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa sản phẩm
            </header>
            <?php
            use Illuminate\Support\Facades\Session;
            $message= Session::get('message');
            if ($message){
                echo '<span class="text-success" style="text-align: center;font-weight: bold">'.$message.'</span>';
                Session::put('message',null);
            }
            ?>
            <div class="panel-body">
                @foreach($edit_product as $key=>$value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('update-product/'.$value->product_id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" value="{{$value->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" value="{{$value->product_image}}" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('upload/product/'.$value->product_image)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="product_decr" id="ckeditor3">{{$value->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="4" class="form-control" name="product_content" id="ckeditor4">{{$value->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" value="{{$value->product_price}}" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="category_product" class="form-control input-lg m-bot15">
                                @foreach($category_product as $key=>$value2)
                                    @if($value2->category_id==$value->category_id)
                                       <option value="{{$value2->category_id}}" selected>{{$value2->category_name}}</option>
                                    @else
                                        <option value="{{$value2->category_id}}">{{$value2->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu</label>
                            <select name="brand" class="form-control input-lg m-bot15">
                                @foreach($brand as $key=>$value3)
                                    @if($value3->brand_id==$value->brand_id)
                                        <option value="{{$value3->brand_id}}" selected>{{$value3->brand_name}}</option>
                                    @else
                                        <option value="{{$value3->brand_id}}">{{$value3->brand_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" name="update_product" class="btn btn-info">Sửa sản phẩm</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection
