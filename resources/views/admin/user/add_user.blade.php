@extends('admin_layout')
@section('admin_content')
    <td>
        <a href="{{ URL::to('/users') }}">
            <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
                    style="padding-right: 5px;font-size:15px"></i>Quản lý nhân sự</button>
        </a>
    </td>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Nhân Sự
                </header>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{ URL::to('store-users') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ và Tên</label>
                                <input type="text" name="admin_name" class="form-control"
                                    value="{{ old('admin_name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username đăng nhập</label>
                                <input type="text" name="admin_user" class="form-control"
                                    value="{{ old('admin_user') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="text" name="admin_phone" class="form-control"
                                    value="{{ old('admin_phone') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu</label>
                                <input type="text" name="admin_password" class="form-control"
                                    value="{{ old('admin_password') }}">
                            </div>

                            <button type="submit" name="add_user" class="button-them">Thêm nhân sự</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection