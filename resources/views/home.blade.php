@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
{{--                <div class="card bg-warning text-white mb-4">--}}
                    <a href="{{ route('tuition') }}" class="card bg-warning text-white mb-4">
                        <div class="card-body">Có {{$data}} học sinh nợ học phí</div>
                    </a>
{{--                </div>--}}
            </div>
        </div>
        <div class="row">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                        Biểu đồ học sinh nhập học theo từng năm
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
        <div class="row">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                        Biểu đồ học phí thu được theo từng niên khóa
            </div>
            <form action="{{ route('chartsearch')}}" method="post">
                @csrf
                <div class="d-flex">
                    <div class="row">
                        <label for="startYear">Từ năm:</label>
                        <input type="text" id="startYear" name="startYear" min="2000"
                               class="form-control" required>
                    </div>
                    <div class="row" style="margin-left: 50px">
                        <label for="endYear">Đến năm:</label>
                        <input type="text" id="endYear" name="endYear" min="2000"
                               class="form-control" required>
                    </div>
                    <div class="row" style="margin-left: 50px; margin-top: 30px">
                        <button type="submit" class="btn btn-primary form-control"> Tìm kiếm</button>
                    </div>
                </div>
            </form>
            <div class="card-body"><canvas id="BarChart1" style="display: block" width="100%" height="40"></canvas></div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($years) !!}');
        var _xdata=JSON.parse('{!! json_encode($yearsCount) !!}');
        var _adata = {!! $yearss !== null ? json_encode($yearss) : 'null' !!};
        var _bdata = {!! $totals !== null ? json_encode($totals) : 'null' !!};

    </script>
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: _ydata,
    datasets: [{
      label: "Số lượng học sinh",
      backgroundColor: "rgba(2, 117, 216, 1)",
      borderColor: "rgba(2, 117, 216, 1)",
      data: _xdata,
      borderWidth: 1,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'year'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 5,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          min: 0,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    },

  },
});
var ctt = document.getElementById("BarChart1");
var myLineChart1 = new Chart(ctt, {
  type: 'line',
  data: {
    labels: _adata,
    datasets: [{
      label: "Tổng tiền",
      backgroundColor: "rgba(255, 255, 255, 255)",
      borderColor: "rgba(2, 117, 216, 1)",
      data: _bdata,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'year'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 5,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true,
          min: 0,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    },

  },
});
    </script>
@endsection
