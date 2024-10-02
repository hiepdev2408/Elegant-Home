
@extends('admin.layouts.master')

@section('style-libs')

 @endsection
@section('title')
    Danh sách Loại Tin
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Search Filter</h5>
    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
      <div class="col-md-4 user_role"></div>
      <div class="col-md-4 user_plan"></div>
      <div class="col-md-4 user_status"></div>
    </div>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-users table">
      <thead class="border-top table-light">
        <tr>
          <th>STT</th>
          <th>Tên</th>
          <th>Email</th>
          <th>Mật khẩu</th>
          <th>Số điện thoại</th>
          <th>Ảnh</th>
          <th>Địa chỉ</th>
          <th>Điểm</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>

        @foreach($data as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->password}}</td>
            <td>{{$item->phone}}</td>
            <td><img src="{{$item->avatar}}" width="50px" alt=""></td>
            <td>{{$item->address}}</td>
            <td>{{$item->point}}</td>
            <td></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Offcanvas to add new user -->

</div>
@endsection



@section('script-libs')
<script src="../../assets/js/main.js"></script>


  <!-- Page JS -->
  <script src="../../assets/js/app-user-list.js"></script>
@endsection

c
