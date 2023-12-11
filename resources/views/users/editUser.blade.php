<div class="modal fade" id="staticBackdropEdit{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('update.user') }}" method="post">
                @csrf <!-- CSRF Protection -->
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Mã hoc sinh</label>
                                <input type="text" class="form-control"
                                       placeholder="Mã hoc sinh"
                                       name="name" value="{{$f->id}}" readonly>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control"
                                       placeholder="Họ và tên"
                                       name="name" value="{{$f->name}}" readonly>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control"
                                       placeholder="Số điện thoại"
                                       name="phone_number" value="{{$f->phone_number}}" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control"
                                       placeholder="Ngày sinh"
                                       name="birthday" value="{{$f->birthday}}" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Số căn cước công dân</label>
                                <input type="text" class="form-control"
                                       placeholder="CCCD"
                                       name="cccd" value="{{$f->cccd}}" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Email</label>
                                <input type="text" class="form-control"
                                       placeholder="Email"
                                       name="email" value="{{$f->email}}" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control"
                                       placeholder="Địa chỉ"
                                       name="address" value="{{$f->address}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>

        </div>
    </div>
</div>
