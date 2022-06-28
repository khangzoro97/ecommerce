@extends('layout_not_content')
@section('content')

    <section id="form"><!--form-->
        <div class="container">
            <?php
            use Illuminate\Support\Facades\Session;
            $message= Session::get('message');
            $message2= Session::get('message2');
            if ($message){
                echo '<span class="text-success" style="font-weight: bold;font-size: 16px">'.$message.'</span>';
                Session::put('message',null);
            }
            if($message2){
                echo '<span class="text-danger" style="font-weight: bold;font-size: 16px">'.$message2.'</span>';
                Session::put('message2',null);
            }
            ?>
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập vào tài khoản</h2>
                        <form action="{{URL::to('/customer-login')}}" method="post">
                            @csrf
                            <input type="text" name="customer_number" placeholder="Số điện thoại" />
                            <input type="password" name="customer_password" placeholder="Password" />
                            <span>
								<input type="checkbox" class="checkbox">
								Ghi nhớ đăng nhập
							</span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Tạo tài khoản mới</h2>
                        <form action="{{route('creat_customer')}}" method="post">
                            @csrf
                            <input type="hidden" name="customer_id" value="{{}}" placeholder="Tên đăng nhập"/>
                            <input type="text" name="customer_name" placeholder="Tên đăng nhập"/>
                            <input type="text" name="customer_number" placeholder="Điện thoại"/>
                            <input type="email" name="customer_email" placeholder="Email"/>
                            <input type="password" name="customer_password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@endsection

