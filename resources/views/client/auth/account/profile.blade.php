@extends('client.auth.account.partials.master')

@section('content-account')
    <div class="product_rightst">
        <div class="conts">
            <div class="image_user">
                @if ($user->avatar)
                    <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width: 130px; border-radius: 15px">
                @endif
            </div>

            @if ($idf = 1)
                <h4>Xin Chào</h4>
                <h3> {{ $user->name }}</h3>
            @else
                <h4>Xin Chào</h4>
            @endif

        </div>
        <div class="smember">
            <div class="date">
                <h5>Ngày Tham Gia</h5>
                <i class="bi bi-calendar-check-fill"></i>
                <h6>12/10/2023</h6>
            </div>
            <div class="member_class">
                <h5>Hạng Thành Viên</h5>
                <i class="bi bi-award-fill"></i>
                <h6>Null</h6>
            </div>
            <div class="point">
                <h5>Điểm Tích Lũy</h5>
                <i class="bi bi-gear-wide-connected"></i>
                <h6>0</h6>
            </div>
        </div>
    </div>
@endsection
