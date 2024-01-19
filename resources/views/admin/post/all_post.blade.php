@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-post') }}">
      <button style="width: fit-content;
      padding: 0.5em 1em;text-align: center;float: inherit;
      margin: 0em auto;
      color: #ffffff;
      background: #00000026;
      border-radius:5px;
      background: 	#CC0033 !important;
      margin-bottom: 10px;
      font-family: -apple-system, system-ui, BlinkMacSystemFont;
      font-weight: 700;
      " class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Thêm bài viết</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách Bài viết
      </div>
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th></th>
              <th style="width: 200px;">Tiêu đề Bài viết</th>
              <th style="width: 250px;">Mô tả ngắn</th>
              <th>Hình ảnh</th>
              <th>Danh mục</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}
             
            </tr>
          </thead>
          <tbody>
            @foreach ($all_post as $key => $post)
              
            <tr>
              <td></td>
              <td>{{ $post->post_title}}</td>
              <td>{{ $post->post_desc}}</td>
              
              <td>
                  <img src="public/upload/post/{{$post->post_image}}" height="100px" width="200px">
              </td>
              <td>{{ $post->cate_post->cate_post_name }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($post->post_status == 0){
                ?>
                   <a href="{{URL::to('/active-post/'.$post->post_id)}}">
                    {{-- <span class="fa-thump-styling-down fa fa-thumbs-down"></span> --}}
                    <button style="
                    width: 110px;
                    padding: 0.5em 1em;text-align: center;float: inherit;
                    margin: 0em auto;
                    color: #ffffff;
                    background: #00000026;
                    border-radius:5px;
                    background: 	#CC0033 !important;
                    margin-bottom: 10px;
                    font-family: -apple-system, system-ui, BlinkMacSystemFont;
                    font-weight: 700;" class="button-chuyen" role="button">Đang ẩn</button>

                  </a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-post/'.$post->post_id)}}">
                    {{-- <span class="fa-thump-styling fa fa-thumbs-up"></span> --}}
                    <button style="
                    width: 110px;
                    padding: 0.5em 1em;text-align: center;float: inherit;
                    margin: 0em auto;
                    color: #ffffff;
                    background: #00000026;
                    border-radius:5px;
                    background: 		#33CC33 !important;
                    margin-bottom: 10px;
                    font-family: -apple-system, system-ui, BlinkMacSystemFont;
                    font-weight: 700;" class="button-chuyen" role="button">Hiển thị</button>

                  </a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              {{-- <td><span class="text-ellipsis">10/07/2023</span></td> --}}
              <td>
                <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xác nhận xóa Bài viết này?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling" ui-toggle-class=""> 
                  <i class="fa fa-trash"></i></a>
              </td>
            </tr>

            @endforeach

          </tbody>
        </table>
      </div>

    </div>
  </div>

@endsection