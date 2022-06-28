@extends('admin-layout')
@section('admin-content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục sản phẩm
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
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
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên danh mục</th>
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tbl_category as $key=>$value)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
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
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                            <li><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">4</a></li>
                            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
@endsection
