@extends('admin-layout')
@section('admin-content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <button class="btn btn-success dropdown-item" href="{{route('add_category_product')}}" data-remote="false"
                            data-toggle="modal" data-target="#modal-admin-action-edit"><i class="fa fa-plus"> Thêm danh mục</i></button>
                </div>
                <div class="col-sm-4">
                </div>

            </div>
            <div class="table-responsive" style="overflow-x: hidden!important;">
                <?php
                use Illuminate\Support\Facades\Session;
                $message= Session::get('message');
                if ($message){
                    echo '<span class="text-success" style="text-align: center;font-weight: bold">'.$message.'</span>';
                    Session::put('message',null);
                }
                ?>
                <?php
                $message1= Session::get('message1');
                if ($message1){
                    echo '<span style="color: red;font-weight: bold">'.$message1.'</span>';
                    Session::put('message1',null);
                }
                ?>
                <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            STT
                        </th>
                        <th>Tên danh mục</th>
                        <th>Hiển thị</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tbl_category as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$value->category_name}}</td>
                        <td><span class="text-ellipsis">
                                @if($value->category_status==0)
                                    <a href="{{URL::to('active-category-product/'.$value->category_id)}}"><span class="fa fa-thumb-styling fa-thumbs-down"></span></a>
                                @else
                                    <a href="{{URL::to('unactive-category-product/'.$value->category_id)}}"><span class="fa fa-thumb-styling fa-thumbs-up"></span></a>
                            @endif
                        </td></span></td>
                        <td>
                            <a href="{{URL::to('edit-category-product/'.$value->category_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square text-success text-active fa-thumb-styling"></i></a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa danh mục?')" href="{{route('delete_category_product',['category_id'=>$value->category_id])}}" class="active" ui-toggle-class=""><i class="fa fa-times text-success text-danger fa-thumb-styling"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="modal-admin-action-edit">
            <div class="modal-dialog" style="max-width: 600px" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <h3 style="font-weight: bold" class="modal-title">Thêm danh mục sản phẩm</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                    <form role="form" action="{{route('save_category_product')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none" rows="5" class="form-control" name="category_product_decr" id="exampleInputPassword1" placeholder="Mô tả danh mục" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name="status" class="form-control input-lg m-bot15" required>
                                <option value="0">Ẩn</option>
                                <option value="1" selected>Hiển thị</option>
                            </select>
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endsection
