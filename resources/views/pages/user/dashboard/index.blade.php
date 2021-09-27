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
</div>

@endsection

@push('before-script')
 
<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}} "></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js')}} "></script>
<!-- END: Page Vendor JS-->
@endpush

@push('after-script')

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
@endpush
