
@extends('client.layouts.master')
@section('title')
@endsection
@section('content')
<style>
    .rounded-circle {
        border-radius: 50%; /* Biến ảnh thành hình tròn */
    }
</style>
<div class="profile__section section--padding ">

    <div class="card">
        <div class="card-body">
            <div class="user-avatar-section text-center">
                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 130px;">
                @endif

                <h4 class="mb-1">{{ $user->name }}</h4>
                <!-- <span class="badge bg-label-danger rounded-pill">Author</span> -->
            </div>
    
            <h5 class="pb-3 border-bottom mb-4 fw-bold h3">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled mb-4">
                    <li class="mb-3">
                        <span class="fw-bold h3">Username: </span>
                        <span class="fw-bold h3">{{ $user->name }}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold h3">Email: </span>
                        <span class="fw-bold h3">{{ $user->email }}</span>
                    </li>
                   
                    <li class="mb-3">
                        <span class="fw-bold h3">Phone: </span>
                        <span class="fw-bold h3">{{$user->phone}}</span>
                    </li>
                    <li class="mb-3">
                        <span class="fw-bold h3">Địa Chỉ: </span>
                        <span class="fw-bold h3">{{$user->address}}</span>
                    </li>
                    
    
                </ul>
                <div class="d-flex">
                    <a class="h3" href="{{ route('profile.edit', $user->id) }}" class="btn-primary me-3" data-bs-target="#editUser" >Sửa lại thông tin</a>
                </div>
            </div>
        </div>
    </div>



    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@endsection
