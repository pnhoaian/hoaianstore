@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-slider') }}">
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
              style="padding-right: 5px;font-size:15px"></i>Thêm Banner</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách Banner - Slider
      </div>
    
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th></th>
              <th>Tên Slider</th>
              <th>Hình ảnh</th>
              <th>Loại Banner</th>
              <th>Mô tả</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($all_slide as $key => $slide)
              
            <tr>
              <td></td>
              <td>{{ $slide->slider_name }}</td>
              
              <td>
                <?php
                if($slide->slider_type == 0){
                ?>
                   <img src="public/upload/slider/{{ $slide->slider_image }}" height="180px" width="400px"></td>
                   {{-- echo'Banner Lớn'; --}}
                <?php
                }else{
            ?>
                  <img src="public/upload/slider/{{ $slide->slider_image }}" height="120px" width="300px"></td>
                  {{--  echo'Banner Nhỏ'; --}}
                <?php 
                }
                ?>

              <td><span class="text-ellipsis">
              <?php
              if($slide->slider_type == 0){
              ?>
                 <span>Banner Lớn</span>
                 {{-- echo'Banner Lớn'; --}}
              <?php
              }else{
          ?>
                <span>Banner Nhỏ</span>
                {{--  echo'Banner Nhỏ'; --}}
              <?php 
              }
              ?>
              </span></td>

              <td>{{ $slide->slider_desc }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($slide->slider_status == 0){
                ?>
                   <a href="{{URL::to('/active-slider/'.$slide->slider_id)}}">
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
                  <a href="{{URL::to('/inactive-slider/'.$slide->slider_id)}}">
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
                {{-- <a href="{{URL::to('/edit-slider/'.$slide->slider_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i> --}}
                <a onclick="return confirm('Xác nhận xóa Slide - Banner này?')" href="{{URL::to('/delete-slider/'.$slide->slider_id)}}" class="active styling" ui-toggle-class=""> 
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