@extends('layouts.app')
@section('title','Dashboard')
@push('before-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
@endpush

@section('content')
<div class="row match-height">
    <!-- Greetings Card starts -->
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-congratulations">
        <div class="card-body text-center">
            <img src="{{ asset('app-assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left" />
            <img src="{{ asset('app-assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right" />
            <div class="avatar avatar-xl bg-primary shadow">
                <div class="avatar-content">
                    <i data-feather="award" class="font-large-1"></i>
                </div>
            </div>
            <div class="text-center">
            <h1 class="mb-1 text-white">Welcome Back {{ Auth::user()->name }}</h1>
            </div>
        </div>
        </div>
    </div>
    <!-- Greetings Card ends -->

    <!-- Subscribers Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
                <div class="avatar bg-light-primary p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="users" class="font-medium-5"></i>
                    </div>
                </div>
                <h2 class="font-weight-bolder mt-1">{{$jumlahUser}}</h2>
                <p class="card-text">Jumlah User</p>
            </div>
            <div id="gained-chart"></div>
        </div>
    </div>
    <!-- Subscribers Chart Card ends -->
 
    <!-- Orders Chart Card starts -->
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
                <div class="avatar bg-light-warning p-50 m-0">
                    <div class="avatar-content">
                        <i data-feather="users" class="font-medium-5"></i>
                    </div>
                </div>
                <h2 class="font-weight-bolder mt-1">{{ $jumlahAdmin }}</h2>
                <p class="card-text">Jumlah Admin</p>
            </div>
            <div id="order-chart"></div>
        </div>
    </div>
    <!-- Orders Chart Card ends -->
</div>
<div class="row">


<div class="col-6">
      <div class="card">
          <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
              <div>
                  <h4 class="card-title mb-25">Statik Posisi</h4>
                 
              </div>
              
          </div>
          <div class="card-body">
             
            <canvas id="myChart" style="height:100px;" ></canvas>
            <table class="table">
              <tr>
                <th>POSISI</th>
                <th>JUMLAH</th>
                <th>PERSENTASE</th>
              </tr>
              @foreach($posisi as $row)
              <tr>
                <td>{{$row->nama}}</td>
                <td>{{ $row->jumlah }}</td>
                <td> 

                <div class="progress progress-bar-primary">
                    <div class="progress-bar" 
                    role="progressbar" 
                    aria-valuenow="{{ ($row->jumlah/$posisi->sum('jumlah'))*100}}" 
                    aria-valuemin="{{ ($row->jumlah/$posisi->sum('jumlah'))*100}}" 
                    aria-valuemax="100"
                     style="width: {{ ($row->jumlah/$posisi->sum('jumlah'))*100}}%">
                        {{($row->jumlah/$posisi->sum('jumlah'))*100}}%
                    </div>
                </div> 

                </td>
              </tr>
              @endforeach
            </table>
          </div>
      </div>
  </div>
  <div class="col-6">
      <div class="card">
          <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
              <div>
                  <h4 class="card-title mb-25">Statik Pangkat</h4>
                 
              </div>
              
          </div>
          <div class="card-body">
             
            <canvas id="pangkatStatistik" style="height:100px;" ></canvas>
            <table class="table">
              <tr>
                <th>Nama Pangkat</th>
                <th>JUMLAH</th>
                <th>PERSENTASE</th>
              </tr>
              @foreach($pangkat as $row)
              <tr>
                <td>{{$row->nama}}</td>
                <td>{{ $row->jumlah }}</td>
                <td> 

                <div class="progress progress-bar-primary">
                    <div class="progress-bar" 
                    role="progressbar" 
                    aria-valuenow="{{ ($row->jumlah/$pangkat->sum('jumlah'))*100}}" 
                    aria-valuemin="{{ ($row->jumlah/$pangkat->sum('jumlah'))*100}}" 
                    aria-valuemax="100"
                     style="width: {{ ($row->jumlah/$pangkat->sum('jumlah'))*100}}%">
                        {{($row->jumlah/$pangkat->sum('jumlah'))*100}}%
                    </div>
                </div> 

                </td>
              </tr>
              @endforeach
            </table>
          </div>
      </div>
  </div>

</div>
@endsection

@push('before-script')
<!-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js')}} "></script> -->
<!-- <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-list.js')}} "></script> -->
<!-- END: Page JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<!-- END: Page Vendor JS-->
@endpush

@push('after-script')
<script>
    $(document).ready(function(){
        $("#dataForm").validate();
    });
    </script> 
@endpush
@push('before-script')
<script>

$(window).on('load', function () {
  'use strict';

  var $avgSessionStrokeColor2 = '#ebf0f7';
  var $textHeadingColor = '#5e5873';
  var $white = '#fff';
  var $strokeColor = '#ebe9f1';

  var $gainedChart = document.querySelector('#gained-chart');
  var $orderChart = document.querySelector('#order-chart');
  var $avgSessionsChart = document.querySelector('#avg-sessions-chart');
  var $supportTrackerChart = document.querySelector('#support-trackers-chart');
  var $salesVisitChart = document.querySelector('#sales-visit-chart');

  var gainedChartOptions;
  var orderChartOptions;
  var avgSessionsChartOptions;
  var supportTrackerChartOptions;
  var salesVisitChartOptions;

  var gainedChart;
  var orderChart;
  var avgSessionsChart;
  var supportTrackerChart;
  var salesVisitChart;

  // On load Toast
  setTimeout(function () {
    toastr['success'](
      'Kemu Berhasil login',
      '👋 Selamat Datang'.{{Auth::user()->name}},
      {
        closeButton: true,
        tapToDismiss: false
      }
    );
  }, 2000);

  // Subscribed Gained Chart
  // ----------------------------------

  gainedChartOptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      }
    },
    colors: [window.colors.solid.primary],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]

      }
    },
    series: [
      {
        name: 'Subscribers',
        data: [1,3,2]
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: [
      {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: { left: 0, right: 0 }
      }
    ],
    tooltip: {
      x: { show: false }
    }
  };
  gainedChart = new ApexCharts($gainedChart, gainedChartOptions);
  gainedChart.render();
 
 
});

</script> 
<script>
var ctxPangkat = document.getElementById('pangkatStatistik').getContext('2d');
var pangkatStatistik = new Chart(ctxPangkat, {
    type: 'bar',
    data: {
        labels: {!! json_encode($namaPangkat) !!},
        datasets: [{
            label: 'Jumlah Pangkat',
            data: {!! json_encode($jumlahPangkat) !!},
            backgroundColor: [
                'rgba(22, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// grafik pangkat
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($namaPosisi) !!},
        datasets: [{
            label: 'Jumlah Posisi',
            data: {!! json_encode($jumlahPosisi) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
@endpush
