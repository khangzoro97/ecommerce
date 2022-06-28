@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục sản phẩm
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
                @foreach($edit_category as $key=>$value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('update-category-product/'.$value->category_id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="exampleInputPassword1" >{{$value->category_desc}}</textarea>

                        </div>

                        <button type="submit" name="update_category_product" class="btn btn-info">Sửa danh mục</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection
