<div class="modal fade" id="staticBackdropEdit{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa thông tin học sinh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('update.student')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row g-3">
                            <input hidden name="id" value="{{$f->id}}">
                            <div class="col">
                                <label for="idClass" class="form-label">Mã hoc sinh (BKC)</label>
                                <input type="text" class="form-control"
                                       placeholder="Mã hoc sinh" disabled
                                       value="{{$f->student_code}}">
                            </div>

                            <div class="col">
                                <label for="nameStudent" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control"
                                       placeholder="Họ và tên" disabled
                                       value="{{$f->name}}">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label for="idClass" class="form-label">Học bổng</label>
                                <input type="text" class="form-control"
                                       placeholder="Số tiền"
                                       name="scholarship" value="{{$f->scholarship}}" readonly>
                            </div>
                            <div class="col">
                                <label for="idClass" class="form-label">Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option selected>Trạng thái</option>
                                    <option value="1">Đang học</option>
                                    <option value="2">Đã học xong</option>
                                    <option value="3">Bỏ học</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Niên khóa</label>
                                <input type="text" class="form-control"
                                       placeholder="Niên khóa" value="{{$f->number_course}}" required>
                            </div>
                            <div class="col">
                                <label for="nameStudent" class="form-label">Chuyên ngành</label>
                                <select class="form-control selectpicker" data-live-search="true" name="id_major" required>
                                    <option value="{{$f->id_major}}">{{$f->majors_name}}</option>
                                    @foreach($major as $m)
                                        <option value="{{$m->id}}">{{$m->majors_name}}</option>
                                    @endforeach
                                </select>
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
