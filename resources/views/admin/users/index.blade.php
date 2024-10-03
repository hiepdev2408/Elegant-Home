@extends('admin.layouts.master')

@section('style-libs')


@endsection
@section('title')
Danh sách Loại Tin
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Danh sách người dùng</h5>
        <!-- <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
        </div> -->
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
                    <td>
                        <div class="d-flex justify-content-center">
                            <a
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-title="Show"
                                class="btn btn-info btn-sm me-1"
                                href="{{ route('users.show', $item) }}">
                                <i class="mdi mdi-eye"></i>
                            </a>
                            <a
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                data-bs-title="Update"
                                class="btn btn-warning btn-sm me-1"
                                href="{{ route('users.edit', $item) }}">
                                <i class="mdi mdi-pencil"></i>
                            </a>

                            <form action="{{ route('users.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button
                                    type="submit"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Delete"
                                    class="btn btn-danger btn-sm me-1"
                                    onclick="return confirm('Bạn có muốn xóa không?')">
                                    <i class="mdi mdi-delete-circle"></i>
                                </button>
                            </form>
                        </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Offcanvas to add new user -->
    <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="userFullname" aria-label="John Doe" />
                    <label for="add-user-fullname">Full Name</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                    <label for="add-user-email">Email</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" id="add-user-contact" class="form-control phone-mask" placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                    <label for="add-user-contact">Contact</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer" aria-label="jdoe1" name="companyName" />
                    <label for="add-user-company">Company</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <select id="country" class="select2 form-select">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="China">China</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                    </select>
                    <label for="country">Country</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <select id="user-role" class="form-select">
                        <option value="subscriber">Subscriber</option>
                        <option value="editor">Editor</option>
                        <option value="maintainer">Maintainer</option>
                        <option value="author">Author</option>
                        <option value="admin">Admin</option>
                    </select>
                    <label for="user-role">User Role</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <select id="user-plan" class="form-select">
                        <option value="basic">Basic</option>
                        <option value="enterprise">Enterprise</option>
                        <option value="company">Company</option>
                        <option value="team">Team</option>
                    </select>
                    <label for="user-plan">Select Plan</label>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </div>
    </div> -->
</div>

@endsection



@section('script-libs')


@endsection


