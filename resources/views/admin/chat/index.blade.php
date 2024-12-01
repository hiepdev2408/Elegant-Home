@extends('admin.layouts.master')

@section('title')
    Trò Chuyện
@endsection

@section('menu-item-chat')
    active
@endsection

@section('content')
    <div class="container mt-5">
        <h3>Phòng Chat</h3>
        <ul class="list-group">
            @foreach ($rooms as $room)
                <li class="list-group-item d-flex justify-content-between align-items-center"
                    data-room-id="{{ $room->id }}">
                    Room ID: {{ $room->id }} - Tên khách hàng: {{ $room->user->name }}
                    <span class="badge {{ $room->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $room->is_active ? 'Hoạt Động' : 'Không Hoạt Động' }}
                    </span>
                    <a href="{{ route('chat.room', ['roomId' => $room->id, 'receiverId' => Auth::user()->id]) }}"
                        class="btn btn-primary btn-sm">Vào phòng chat</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('style-libs')
    <link rel="stylesheet" href="{{ asset('themes') }}/admin/vendor/css/pages/app-chat.css">
@endsection
@section('script-libs')
    <script src="{{ asset('themes') }}/admin/js/app-chat.js"></script>
@endsection
