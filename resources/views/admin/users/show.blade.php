@section('style-libs')

@endsection
@section('title')
Danh sách Loại Tin
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="user-avatar-section text-center">
            <img class="img-fluid rounded-circle mb-3" src="{{ asset('themes') }}/admin/assets/img/avatars/10.png" height="120" width="120" alt="User avatar" />
            <h4 class="mb-1">{{ $user->name }}</h4>
            <!-- <span class="badge bg-label-danger rounded-pill">Author</span> -->
        </div>

        <h5 class="pb-3 border-bottom mb-4">Details</h5>
        <div class="info-container">
            <ul class="list-unstyled mb-4">
                <li class="mb-3">
                    <span class="fw-bold h6">Username:</span>
                    <span>{{ $user->name }}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold h6">Mật khẩu</span>
                    <span>{{ $user->password }}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold h6">Email:</span>
                    <span>{{ $user->email }}</span>
                </li>
                <!-- <li class="mb-3">
                    <span class="fw-bold h6">Status:</span>
                    <span class="badge bg-label-success rounded-pill">Active</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold h6">Role:</span>
                    <span>Author</span>
                </li> -->
                <!-- <li class="mb-3">
                    <span class="fw-bold h6">Tax ID:</span>
                    <span>Tax-8965</span>
                </li> -->
                <li class="mb-3">
                    <span class="fw-bold h6">Phone</span>
                    <span>{{$user->phone}}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold h6">Địa Chỉ</span>
                    <span>{{$user->address}}</span>
                </li>

            </ul>
            <div class="d-flex justify-content-center">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary me-3" data-bs-target="#editUser" >Edit</a>
                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspend</a>
            </div>
        </div>
    </div>
</div>

@extends('admin.layouts.master')



@endsection



@section('script-libs')


@endsection
