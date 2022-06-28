@extends('layout_not_content')
@section('content')

    <div class="jumbotron text-center">
        <h1 class="display-3">THANK YOU!</h1>
        <p class="lead"><strong>Cảm ơn sự phản hồi của bạn.</strong></p>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{URL::to('/trang-chu')}}" role="button">Tiếp tục mua hàng</a>
        </p>
    </div>

@endsection

