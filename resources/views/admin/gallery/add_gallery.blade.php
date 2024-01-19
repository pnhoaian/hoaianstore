@extends('admin_layout')
@section('admin_content')
    <td>
        <a href="{{ URL::to('/all-product') }}">
            <button class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
                    style="padding-right: 5px;font-size:15px"></i>Quản lý sản phẩm</button>
        </a>
    </td>
    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var pro_id = $('.pro_id').val();
                $.ajax({
                    url: '{{ url('/select-gallery') }}',
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        pro_id: pro_id
                    },
                    success: function(data) {
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function() {
                var error = '';
                var files = $('#file')[0].files;

                if (files.length > 5) {
                    error += '<p>Tối đa chỉ được thêm 5 ảnh</p>';
                } else if (files.length == '') {
                    error += '<p>Bạn không được bỏ trống ảnh</p>';
                } else if (files.size > 2000000) {
                    error += '<p>Kích thước ảnh quá lớn. Yêu cầu kích thước ảnh nhỏ hơn 2mb</p>';
                }

                if (error == '') {

                } else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                    return false;
                }


            });
            $(document).on('blur', '.edit_gal_name', function() {
                var gal_id = $(this).data('gal_id');
                var gal_text = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/update-gallery-name') }}',
                    method: "POST",
                    data: {
                        gal_id: gal_id,
                        gal_text: gal_text,
                        _token: _token
                    },
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhật tên hình ảnh thành công</span>'
                        );

                    }
                });
            });
            $(document).on('click', '.delete-gallery', function() {
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if (confirm('Bạn có chắc chắn muốn xóa hình ảnh này không?')) {
                    $.ajax({
                        url: '{{ url('/delete-gallery') }}',
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html(
                                '<span class="text-danger">Xóa hình ảnh thành công</span>');

                        }
                    });
                }
            });
            $(document).on('change', '.file_image', function() {
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-' + gal_id).files[0];
                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                form_data.append("gal_id", gal_id);


                $.ajax({
                    url: '{{ url('/update-gallery') }}',
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        load_gallery();
                        $('#error_gallery').html(
                            '<span class="text-danger">Cập nhật hình ảnh thành công</span>');

                    }
                });
            });
        });
    </script>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Thư viện ảnh
                </header>
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert>">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <form action="{{ url('/insert-gallery/' . $pro_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-6" style="margin-top: 30px;">
                            <input type="file" class="form-control" id="file" name="file[]" accept="image/*"
                                multiple>
                            <span id="error_gallery"></span>
                        </div>
                        <div class="col-md-3" style="margin-top: 30px;">
                            <input type="submit" name="upload" value="Tải lên" class="button-them">
                        </div>

                    </div>
                </form>
                <div class="panel-body">

                    <input type="hidden" value="{{ $pro_id }}" name="pro_id" class="pro_id">
                    <form>
                        @csrf
                        <div id="gallery_load">


                        </div>
                    </form>
                </div>
            </section>

        </div>
    </div>
@endsection
