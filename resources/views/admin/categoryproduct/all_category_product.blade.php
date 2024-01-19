@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-category-product') }}">
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
              style="padding-right: 5px;font-size:15px"></i>Thêm danh mục</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Danh Mục
      </div>
      
      <div class="table-responsive" >

        {!! Toastr::message() !!}

        <table class="table table-striped b-t b-light" id="myTable">
          <thead>
            <tr>
              <th style="width: 0px"></th>
              <th style="width:200px">Tên Danh Mục</th>
              <th>Trạng thái</th>
              <th>Tác vụ</th>
              {{-- <th>Ngày thêm</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach ($all_category_product as $key => $cate_pro)
              
            <tr>
              <td></td>
              <td>{{ $cate_pro->category_name }}</td>
              {{-- status  --}}
              <td><span class="text-ellipsis">
                <?php
                if($cate_pro->category_status == 0){
                ?>
                   <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}">
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
                  <a href="{{URL::to('/inactive-category-product/'.$cate_pro->category_id)}}">
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
                <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i>
                <a onclick="return confirm('Xóa Danh mục sản phẩm này sẽ xóa luôn tất cả sản phẩm thuộc danh mục. Bạn có chắc chắn không?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active styling" ui-toggle-class=""> 
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