@extends('admin_layout')
@section('admin_content')

<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thông tin trang Giới thiệu Cửa Hàng
                </header>

                                {{-- //thông báo lỗi đầu vào ở header --}}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                {{-- End --}}
                                
                <div class="panel-body">
                    <?php 
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <div class="position-center">
                        @foreach ($intr as $key =>$val)
                        {{-- <form role="form" action="{{URL::to('/update-intro')}}" method="POST"> --}}

                            <form role="form" action="{{ URL::to('/update-intro/' . $val->intro_id) }}" method="post">


                            {{ csrf_field() }}

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả Giới thiệu cửa hàng</label>
                            <textarea style="resize:none" rows="6" name="intro_desc" class="form-control" id="ckeditor" placeholder="Thêm mô tả">
                                {{ $val->intro_desc }}
                            </textarea>
                        </div>

                        <div class="form-group">
                        <button type="submit" name="add_intro" class="btn btn-info">Cập nhật</button>
                    </form>
                    @endforeach
                    </div>

@endsection