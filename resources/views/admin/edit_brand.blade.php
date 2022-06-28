@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa thương hiệu
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
                @foreach($edit_brand as $key=>$value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('update-brand/'.$value->brand_id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" value="{{$value->brand_name}}" name="brand_name" class="form-control" id="exampleInputEmail1" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="brand_desc" id="exampleInputPassword1" >{{$value->brand_desc}}</textarea>

                        </div>

                        <button type="submit" name="update_brand" class="btn btn-info">Sửa thương hiệu</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection
