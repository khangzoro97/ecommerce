@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thương hiệu
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php
                    use Illuminate\Support\Facades\Session;
                    $message= Session::get('message');
                    if ($message){
                        echo '<span class="text-success" style="text-align: center">'.$message.'</span>';
                        Session::put('message',null);
                    }
                    ?>
                    <form role="form" action="{{route('save_brand')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên thương hiệu</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="brand_decr" id="exampleInputPassword1" placeholder="Mô tả thương hiệu"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="status" class="form-control input-lg m-bot15" required>
                                <option value="0">Ẩn</option>
                                <option value="1" selected>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_brand" class="btn btn-info">Thêm thương hiệu</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection
