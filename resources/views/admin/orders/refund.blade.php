<div class="modal fade" id="rufund" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body py-3 py-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Chỉnh sửa thông tin người dùng</h3>
                    <p class="pt-1">Cập nhật thông tin chi tiết của người dùng sẽ nhận được kiểm toán quyền riêng
                        tư.</p>
                </div>
                <form id="editUserForm" class="row g-4" onsubmit="return false">
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                class="form-control" placeholder="John" />
                            <label for="modalEditUserFirstName">Tên</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                class="form-control" placeholder="Doe" />
                            <label for="modalEditUserLastName">Họ</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserName" name="modalEditUserName" class="form-control"
                                placeholder="john.doe.007" />
                            <label for="modalEditUserName">Tên người dùng</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="modalEditUserEmail" name="modalEditUserEmail" class="form-control"
                                placeholder="example@domain.com" />
                            <label for="modalEditUserEmail">Email</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">US (+1)</span>
                            <div class="form-floating form-floating-outline">
                                <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                    class="form-control phone-number-mask" placeholder="202 555 0111" />
                                <label for="modalEditUserPhone">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating form-floating-outline">
                            <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                aria-label="Default select example">
                                <option selected>Trạng thái</option>
                                <option value="1">Hoạt động</option>
                                <option value="2">Không hoạt động</option>
                                <option value="3">Đã tạm dừng</option>
                            </select>
                            <label for="modalEditUserStatus">Trạng thái</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="switch">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Sử dụng làm địa chỉ thanh toán?</span>
                        </label>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Gửi</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Hủy bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
