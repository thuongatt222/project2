<div class="modal fade" id="staticBackdropInvoice{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa thông tin phiếu thu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('print.tuition') }}" method="post">
                @csrf <!-- CSRF Protection -->
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row g-3">
                            <input hidden name="id" value="{{$f->id}}">
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label for="nameStudent" class="form-label">Lý do nộp</label>
                                <input type="text" class="form-control"
                                       placeholder="Ghi chú"
                                       name="reason" required>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col">
                                <label class="form-label">Hình thức nộp</label>
                                <select class="form-control" name="submission">
                                    <option selected>Hình thức nộp</option>
                                    <option value="1">Theo tháng</option>
                                    <option value="2">Theo quý</option>
                                    <option value="3">Theo năm</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="name" value="{{$f->name}}">
                        <input type="hidden" name="address" value="{{$f->address}}">
                        <input type="hidden" name="fee" value="{{$f->fee}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">In hóa đơn</button>
                </div>
            </form>
        </div>
    </div>
</div>

