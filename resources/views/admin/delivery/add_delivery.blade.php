@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
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
                    <form>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputFile">Chọn tỉnh/thành phố</label>
                            <select id="city" name="city" class="form-control input-lg m-bot15 choose city" required>
                                <option value="">--Chọn tỉnh/thành phố--</option>
                                @foreach($city as $key=>$value)
                                    <option value="{{$value->matp}}">{{$value->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Chọn quận/huyện</label>
                            <select id="province" name="province" class="form-control input-lg m-bot15 choose province" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Chọn xã/phường/thị trấn</label>
                            <select id="wards" name="wards" class="form-control input-lg m-bot15 wards" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" name="fee_ship" class="form-control fee_ship" id="fee_ship" required>
                        </div>

                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm vận chuyển</button>
                    </form>
                </div>
                <div id="load_delivery">

                </div>

            </div>
        </section>

    </div>
</div>
@endsection
