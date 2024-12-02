@extends('admin.layouts.master')
@section('content')
    <div id="app" class="container py-4">
        <div class="row">
            <!-- Danh sách phòng chat -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Danh sách phòng chat</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($rooms as $room)
                            <li class="list-group-item">
                                <a href="{{ route('chat.admin', ['roomId' => $room->id, 'receiverId' => Auth::user()->id]) }}"
                                    class="d-flex justify-content-between align-items-center text-decoration-none">
                                    <div class="d-flex align-items-center">
                                        @if ($room->user->image)
                                            <img src="{{ Storage::url($comment->user->img_thumbnail) }}"
                                                alt="{{ $room->user->name }}" class="rounded-circle me-3"
                                                style="width: 40px; height: 40px;">
                                        @else
                                            <img src="{{ asset('themes/image/logo.jpg') }}" alt="{{ $room->user->name }}"
                                                class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $room->user->name }}</h6>
                                            <small class="text-muted">ID: {{ $room->id }}</small>
                                        </div>
                                    </div>
                                    <span class="badge {{ $room->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $room->is_active ? 'Online' : 'Offline' }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            <!-- Khung chat -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Khung chat</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center text-muted">Vui lòng chọn phòng chat</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('style-libs')
    <script>
        let userId = {{ auth()->id() }};
        let receiverId = {{ $receiverId }};
        let roomId = {{ $roomId }};
        let roleId = {{ auth()->user()->role_id }};
        // console.log(roleId)
    </script>
@endsection --}}
