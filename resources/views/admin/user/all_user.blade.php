@extends('admin_layout')
@section('admin_content')
    <td>
        <a href="{{ URL::to('/add-user') }}">
            <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
                    style="padding-right: 5px;font-size:15px"></i>Thêm nhân sự</button>
        </a>
    </td>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Quản lý nhân sự
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light"
                    style="font-family: -apple-system, system-ui, BlinkMacSystemFont;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Mật khẩu</th>
                            <th>Quản trị viên</th>
                            <th>Nhân viên</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>@php
                        $i = 0;
                    @endphp

                        @foreach ($admin as $key => $user)
                            @php
                                $i++;
                            @endphp
                            <form role="form" action="{{ URL::to('assign-roles') }}" method="post">
                                @csrf
                                <tr>

                                    <td>{{ $i }}</td>
                                    <td>{{ $user->admin_name }}</td>
                                    <td>{{ $user->admin_user }} <input type="hidden" name="admin_user"
                                            value="{{ $user->admin_user }}"></td>
                                    <td>{{ $user->admin_password }}</td>
                                    <td><input type="checkbox" class="checkbox-list" name="admin_role"
                                            {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
                                    <td><input type="checkbox" class="checkbox-list" name="user_role"
                                            {{ $user->hasRole('user') ? 'checked' : '' }}></td>
                                    <td></td>



                                    <td>


                                        <p><input type="submit" value="Cấp quyền" class="button-them"></p>
                                        <p><a class="button-xoa"
                                                onclick="return confirm('Bạn có muốn xóa nhân sự này không?')"
                                                style="margin-top:5px;width:80px;line-height:30px"
                                                href="{{ url('/delete-user-roles/' . $user->admin_id) }}">Xóa </a></p>
                                    </td>

                                </tr>
                            </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection