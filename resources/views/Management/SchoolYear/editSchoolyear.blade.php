<div class="modal fade" id="staticBackdropEdit{{$f->id}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form sửa niên khóa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('update.school_year', ['id'=>$f->id])}}" method="post">
            <div class="modal-body">
                <div class="card-body">
                    <div class="row g-3">
                        @csrf
                        <input hidden name="id" value="{{$f->id}}">
                        <div class="col">
                            <label for="nameStudent" class="form-label">Niên khóa</label>
                            <input type="number" class="form-control"
                                   placeholder="Niên khóa"
                                   name="number_course" value="{{$f->number_course}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Sửa</button>
            </div>
            </form>
        </div>
    </div>
</div>
