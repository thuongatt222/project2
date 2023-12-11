<div class="modal fade" id="staticBackdropEdit{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa chuyên ngành</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('update.major')}}" method="post">
            <div class="modal-body">
                <div class="card-body">
                    <div class="row g-3">
                        @csrf
                        <input hidden name="id" value="{{$f->id}}">
                        <div class="col">
                            <label for="nameStudent" class="form-label">Chuyên ngành</label>
                            <input type="text" class="form-control"
                                   placeholder="Chuyên ngành"
                                   name="majors_name" value="{{$f->majors_name}}" required>
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
