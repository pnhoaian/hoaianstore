@extends('admin_layout')
@section('admin_content')

<td>
  <a href="{{ URL::to('/add-product') }}">
      <button style="width: fit-content;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background: 	#CC0033 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;
      " class="button-chuyen" role="button"><i class="fa fa-long-arrow-right"
              style="padding-right: 5px;font-size:15px"></i>Thêm sản phẩm</button>
  </a>
</td>

<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Liệt kê bình luận
      </div>
      
      <div class="table-responsive">

        <table class="table table-striped b-t b-light" id="myTable">

          <thead>
            <tr>
              <th></th>
              <th style="width: 120px;">Tên khách hàng</th>
              <th style="width: 110px;">Tên sản phẩm</th>
              <th style="width: 750px;">Bình luận</th>
              <th>Ngày gửi</th>
              <th style="width: 115px;">Trạng thái</th>
              <th style="width: 80px;">Tác vụ</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($comment as $key => $comm)
              
            <tr>
              <td></td>
              <td>{{ $comm->comment_name }}</td>
              <td><a href="{{ url('/chi-tiet-san-pham/'.$comm->product->product_id) }}" target="_blank"></a>{{ $comm->product->product_name }}</td>
              <td>{{ $comm->comment }}
                

                <br><textarea row="5" class="form-control reply_comment_{{ $comm->comment_id }}"></textarea>
                <br /><button class="btn-reply-comment" data-comment_id="{{ $comm->comment_id }}"
                    data-product_id="{{ $comm->comment_product_id }}">Trả lời bình luận</button>
              </td>
              <td>{{ $comm->comment_date }}</td>
              {{---- status  ----}}
              <td><span class="text-ellipsis">
                <?php
                if($comm->comment_status == 0){
                ?>
                   <a href="{{URL::to('/active-comment/'.$comm->comment_id )}}">
                    {{-- <span class="fa-thump-styling-down fa fa-thumbs-down"></span> --}}
                    <button style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background: 	#CC0033 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                    class="button-chuyen" role="button">Từ chối</button>
                  </a>
                   {{-- echo'Ẩn'; --}}
                <?php
                }else{
            ?>
                  <a href="{{URL::to('/inactive-comment/'.$comm->comment_id )}}">
                    {{-- <span class="fa-thump-styling fa fa-thumbs-up"></span> --}}
                        <button style="width: 110px;padding: 0.5em 1em;text-align: center;float: inherit;margin: 0em auto;color: #ffffff;background: #00000026;border-radius:5px;background: #33CC33 !important;margin-bottom: 10px;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 700;" 
                        class="button-chuyen" role="button">Hiển thị</button>
                  </a>
                  {{--  echo'Hiện Thị'; --}}
                <?php 
                }
                ?>
              </span></td>

              <td>
                {{-- <a href="{{URL::to('/edit-comment/'.$comm->comment_id )}}" class="active styling" ui-toggle-class="">
                  <i class="fa fa-pencil-square-o text-success text-active"></i> --}}
                  
                <a onclick="return confirm('Xác nhận xóa Bình luận này?')" href="{{URL::to('/delete-comment/'.$comm->comment_id )}}" class="active styling" ui-toggle-class=""> 
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