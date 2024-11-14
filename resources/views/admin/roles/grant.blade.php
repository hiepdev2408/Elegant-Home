@extends('admin.layouts.master')

@section('title')
    Danh sách role
@endsection
@section('menu-item-gant')
    open
@endsection

@section('menu-sub-index-gant')
    active
@endsection
@section('content')
    <div class="container">
        <form class="row g-3" action="{{ route('permissions.updateGant') }}" method="POST">
            @csrf
            <div class="col-12">
                <h4 class="mb-4 mt-5">
                    <span class="text-muted fw-light">Role Permissions</span>
                </h4>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center"></th>
                                @foreach ($roles as $role)
                                    <th scope="col" class="text-center">{{ $role->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $per)
                                <tr>
                                    <td class="fw-bold">{{ $per->name }} <span class="text-danger ">({{ $per->slug }})</span></td>
                                    @foreach ($roles as $role)
                                    {{-- @dd($per->roles->contains($role->id)) --}}
                                        <td class="text-center">
                                            <input type="hidden" name="permissions[{{ $role->id }}][{{ $per->id }}]" value="0">
                                            <input type="checkbox"
                                                   name="permissions[{{ $role->id }}][{{ $per->id }}]"
                                                   class="form-check-input"
                                                   value="1"
                                                   {{ $per->roles->contains($role->id) ? 'checked' : '' }}>
                                                   {{-- contains thực hiển kiểm tra id của role trong mảng xem có phù hợp với bảng has_per_rol --}}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </form>
    </div>
@endsection
@section('style-libs')
    <style>
        <style>.table-bordered th,
        .table-bordered td {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    </style>
@endsection
