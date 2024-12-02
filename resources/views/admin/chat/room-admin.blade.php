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
                        @foreach ($rooms as $item)
                            <li class="list-group-item">
                                <a href="{{ route('chat.admin', ['roomId' => $item->id, 'receiverId' => Auth::user()->id]) }}"
                                    class="d-flex justify-content-between align-items-center text-decoration-none">
                                    <div class="d-flex align-items-center">
                                        @if ($item->user->image)
                                            <img src="{{ Storage::url($item->user->image) }}"
                                                alt="{{ $item->user->name }}" class="rounded-circle me-3"
                                                style="width: 40px; height: 40px;">
                                        @else
                                            <img src="{{ asset('themes/image/logo.jpg') }}" alt="{{ $item->user->name }}"
                                                class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $item->user->name }}</h6>
                                            <small class="text-muted">ID: {{ $item->id }}</small>
                                        </div>
                                    </div>
                                    <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->is_active ? 'Online' : 'Offline' }}
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
                        <!-- Thay "Khung chat" thành tên khách hàng -->
                        <h5 class="mb-0">{{  $room->user->name}}</h5>
                        <span id="user-status">Đang kiểm tra...</span>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <hr>
                            <div id="message-box"
                                style="height: 400px; overflow-y: auto; background-color: #f8f9fa; padding: 10px;">
                                @foreach ($messages as $item)
                                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        @if (Auth::user()->id === $item->sender_id)
                                            <div class="message sent">
                                                <strong>Bạn: </strong>{{ $item->message }}
                                            </div>
                                        @else
                                            <div class="message received">
                                                <strong>Khách hàng: </strong>{{ $item->message }}
                                            </div>
                                        @endif
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        @if (Auth::user()->id === $item->sender_id)
                                            <div class="message sent">
                                                <strong>Bạn: </strong>{{ $item->message }}
                                            </div>
                                        @else
                                            <div class="message received">
                                                <strong>Quảng trị viên: </strong>{{ $item->message }}
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                            <!-- Form gửi tin nhắn -->
                            <div class="input-box">
                                <textarea class="form-control" id="message-input" placeholder="Nhập tin nhắn..." rows="3"></textarea>
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <button class="btn btn-primary" id="send-message-btn">Gửi</button>
                                    @if (Auth::user()->role_id == 3)
                                        <form action="{{ route('outChat', $roomId) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Thoát cuộc trò chuyện</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style-libs')
    <script>
        let userId = {{ auth()->id() }};
        let receiverId = {{ $receiverId }};
        let roomId = {{ $roomId }};
        let roleId = {{ auth()->user()->role_id }};
    </script>
@endsection
