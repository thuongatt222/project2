@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    @include('Management.Student.add')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Danh sách học sinh/ Học viên</h5>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdropAdd">
                        Thêm mới
                    </button>
                    <hr>
                    <form method="get" action="{{ route('search.student') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"><b>Tìm kiếm theo mã SV</b></label>
                            <div class="col-sm-10">
                                <input autocomplete="off" name="search" type="text" class="form-control"
                                    placeholder="Nhập tìm kiếm" value="{{ $search ?? '' }}">
                            </div>
                        </div>
                        <button type="submit" hidden></button>
                        @if (!empty($studentCount))
                            <div>
                                <p>Kết quả tìm kiếm</p>
                            </div>
                        @endif
                    </form>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã SV</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Học bổng</th>
                                        <th scope="col">Niên khóa</th>
                                        <th scope="col">Chuyên ngành</th>
                                        <th scope="col">Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($student as $f)
                                        <tr>
                                            <td class="student-code">
                                                <form class="search-form" method="get" action="{{ route('search.tuition') }}">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                            {{ $f->student_code }}
                                                            <input hidden autocomplete="off" name="search" type="text"
                                                                class="form-control" placeholder="Nhập tìm kiếm"
                                                                value="{{ $f->student_code }}">
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>{{ $f->name }}</td>
                                            <td>{{ $f->scholarship }}</td>
                                            <td>{{ $f->number_course }}</td>
                                            <td>{{ $f->majors_name }}</td>
                                            <td>
                                                @if ($f->status == 1)
                                                    <button class="btn btn-primary">Đang học</button>
                                                @elseif($f->status == 2)
                                                    <button class="btn btn-success">Đã học xong</button>
                                                @else
                                                    <button class="btn btn-danger">Bỏ học</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($f->status != 2)
                                                    <div class="d-flex">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#staticBackdropEdit{{ $f->id }}"
                                                            style="margin-right: 20px">
                                                            Sửa
                                                        </button>
                                                        @include('Management.Student.edit')
                                                        <form action="{{ route('delete.student') }}" method="post">
                                                            @csrf
                                                            <input hidden name="id" value="{{ $f->id }}">
                                                            <button type="submit" class="btn btn-danger">
                                                                Xóa
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <button class="btn btn-success">Hoàn thành</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <th>Không có dữ liệu</th>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $student->appends(['search' => $search ?? ''])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
