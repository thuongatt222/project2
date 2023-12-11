<div class="modal fade" id="staticBackdropEdit{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa thông tin phiếu thu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('update.tuition') }}" method="post">
                @csrf <!-- CSRF Protection -->
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row g-3">
                            <input hidden name="id" value="{{$f->id}}">
                            <div class="col">
                                <label for="payment_times" class="form-label">Lần đóng thứ</label>
                                <input type="number" class="form-control"
                                       placeholder="Lần đóng thứ"
                                       min="{{$f->payment_times}}"
                                       max="30"
                                       name="payment_times" value="{{$f->payment_times}}" required>
                            </div>
                        </div>
                        <div class="row g-3">

                            <div class="col">
                                <label for="nameStudent" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control"
                                          placeholder="Ghi chú"
                                          name="note" value="{{$f->note}}" >
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col" >
                                <label for="idClass" class="form-label">Mã sinh viên</label>
                                <input hidden name="id_student" value="{{$f->student_id}}">
                                <input class="form-control" type="text" value="{{$f->name}}" readonly>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="fee" class="form-label">Mã học phí</label>
                                <input class="form-control" type="text" value="Niên khóa: {{$f->number_course}} -- Chuyên ngành: {{$f->majors_name}} -- Số đợt đóng: {{$f->school_payment_times}}" readonly>
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
