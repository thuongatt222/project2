@extends('layouts.app')

@section('custom_styles')
@endsection

@section('content')
    {{--    @include('Management.Tuition.add') --}}
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">Danh sách thu phí</h5>
                    <div class="d-flex">
                        <!-- Button trigger modal Add-->

                        <div class="flex-grow-1"></div>
                        <form action="{{ route('export.tuition') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success">Tải xuống file Exel</button>
                        </form>
                    </div>

                    <hr>
                    <form method="get" action="{{ route('search.tuition') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"><b>Tìm kiếm theo mã SV</b></label>
                            <div class="col-sm-10">
                                <input autocomplete="off" name="search" type="text" class="form-control"
                                    placeholder="Nhập tìm kiếm" value="{{ $search ?? '' }}">
                            </div>
                        </div>
                        <button type="submit" hidden></button>
                        @if (!empty($tuitionCount))
                            <div>
                                <p>Kết quả tìm kiếm</p>
                            </div>
                        @endif
                        @if (!empty($debt))
                            <div>
                                <p style="color: red">Có {{ $debt }} học sinh nợ học phí</p>
                            </div>
                        @endif
                    </form>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Số thứ tự</th>
                                        <th scope="col">Mã SV</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Số lần đóng</th>
                                        <th scope="col">Số tiền đã đóng</th>
                                        <th scope="col">Số đợt đóng</th>
                                        <th scope="col">Trạng thái học phí</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tuition as $f)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="student-code">
                                                <form class="search-form" method="get" action="{{ route('search.student') }}">
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
                                            <td>{{ $f->payment_times }}</td>
                                            <td>{{ number_format($f->fee * $f->payment_times, 0, ',', '.') }} VND</td>
                                            <td>{{ $f->fee_time }}</td>

                                            <form id="searchForm" method="get" action="{{ route('search.tuition') }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
                                                        <td>
                                                            @if ($f->school_payment_times >= $f->fee_time)
                                                                <button class="btn btn-success">Hoàn thành</button>
                                                            @else
                                                                <button class="btn btn-danger">Nợ học phí:
                                                                    {{ number_format((($f->original_fee - $f->scholarship) / 30) * ($f->fee_time - $f->school_payment_times), 0, ',', '.') }}
                                                                    VND</button>
                                                            @endif
                                                        </td>
                                                        <input hidden autocomplete="off" name="search" type="text"
                                                            class="form-control" placeholder="Nhập tìm kiếm"
                                                            value="{{ $f->student_code }}">
                                                    </div>
                                                </div>
                                            </form>

                                            @if ($f->payment_times < 30)
                                                <td>
                                                    <div class="d-flex">
                                                        <!-- Button to trigger the modal Edit-->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#staticBackdropEdit{{ $f->id }}"
                                                            style="margin-right: 20px">
                                                            Sửa
                                                        </button>
                                                        @include('Management.Tuition.edit')
                                                        @include('Management.Tuition.invoice')
                                                        <form action="{{ route('delete.tuition') }}" method="post">
                                                            @csrf
                                                            <input hidden name="id" value="{{ $f->id }}">
                                                            <button type="submit" class="btn btn-danger"
                                                                style="margin-right: 20px">
                                                                Xóa
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                            data-target="#staticBackdropInvoice{{ $f->id }}"
                                                            style="margin-right: 20px">
                                                            In hóa đơn
                                                        </button>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-success"
                                                        style="margin-right: 20px">
                                                        Đã hoàn Thành
                                                    </button>
                                                    @include('Management.Tuition.invoice')
                                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                                        data-target="#staticBackdropInvoice{{ $f->id }}"
                                                        style="margin-right: 20px">
                                                        In hóa đơn
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <th>Không có dữ liệu</th>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $tuition->appends(['search' => $search ?? ''])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection