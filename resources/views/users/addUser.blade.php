<div class="modal fade" id="staticBackdropAdd" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form thêm tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('add.user') }}" method="post">
                @csrf <!-- CSRF Protection -->
                <div class="modal-body">
                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Mã hoc sinh</label>
                                <input type="text" class="form-control"
                                       placeholder="Mã hoc sinh"
                                       name="id" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control"
                                       placeholder="Họ và tên"
                                       name="name" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="role" class="form-label">Cấp quyền</label>
                                <select id="role" class="form-control" name="role">
                                    <option value="0">Học sinh</option>
                                    <option value="1">Thu ngân</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control"
                                       placeholder="Số điện thoại"
                                       name="phone_number" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control"
                                       placeholder="Ngày sinh"
                                       name="birthday" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Số căn cước công dân</label>
                                <input type="text" class="form-control"
                                       placeholder="CCCD"
                                       name="cccd" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Email</label>
                                <input type="text" class="form-control"
                                       placeholder="Email"
                                       name="email" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control"
                                       placeholder="Địa chỉ"
                                       name="address" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control"
                                       placeholder="Mật khẩu"
                                       name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>

        </div>
    </div>
</div>
