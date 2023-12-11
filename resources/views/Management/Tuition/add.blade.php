<div class="modal fade" id="staticBackdropAdd" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form thêm thông tin phiếu thu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('add.tuition') }}" method="post">
                @csrf <!-- CSRF Protection -->
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col">
                                <label for="payment_times" class="form-label">Lần đóng thứ</label>
                                <input type="number" class="form-control"
                                       placeholder="Lần đóng thứ"
                                       name="payment_times" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control"
                                       placeholder="Ghi chú"
                                       name="note" required>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Họ và tên</label>
                                <select class="form-control select selectpicker" data-live-search="true" name="id_student" id="student-select">
                                    <option selected>-- Chọn sinh viên --</option>
                                    @foreach($student as $s)
                                        <option value="{{$s->id}}">{{$s->id}} - {{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label for="fee" class="form-label">Mã học phí</label>
                                <select class="form-control selectpicker" data-live-search="true" name="id_fee">
                                    <option selected>-- Chọn học phí --</option>
                                    @foreach($fee as $s)
                                        <option value="{{$s->id}}">Niên khóa: {{$s->number_course}} --
                                            Chuyên ngành: {{$s->majors_name}} --
                                            Số đợt đóng: {{$s->school_payment_times}}
                                        </option>
                                    @endforeach
                                </select>
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
