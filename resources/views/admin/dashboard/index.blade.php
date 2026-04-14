@extends('admin.layouts.master')

@section('content')
  <div class="page-wrapper">
  <!-- Page header -->
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
           Dashboard
          </h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Page body -->
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        <div class="col-12">
          <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <i class="ti ti-currency-dollar"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ config('settings.currency_icon') }} {{ $sales['day'] }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Today\'s Sales') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <i class="ti ti-currency-dollar"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ config('settings.currency_icon') }} {{ $sales['week'] }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('This Week Sales') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <i class="ti ti-currency-dollar"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ config('settings.currency_icon') }} {{ $sales['month'] }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('This Month Sales') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-currency-dollar"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ config('settings.currency_icon') }} {{ $sales['year'] }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('This Year Sales') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-clock"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $statusCount['pending'] ?? 0 }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Pending Items') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-circle-dashed-x"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $statusCount['soft_rejected'] ?? 0 }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Soft Rejected Items') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-cancel"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $statusCount['hard_rejected'] ?? 0 }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Hard Rejected Items') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-rosette-discount-check"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $statusCount['approved'] ?? 0 }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Approved Items') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-certificate-2"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $kycCount }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('KYC Pending') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-basket-check"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $orderCount }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Total Orders') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-pig-money"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $withdrawCount }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Pending Withdrawals') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-primary text-white avatar">
                        <i class="ti ti-user-star"></i>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        <b>{{ $subscriberCount }}</b>
                      </div>
                      <div class="text-secondary">
                        {{ __('Total Subscribers') }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">{{ __('Yearly Sales Report') }}</h3>
                  <div class="card-actions">
                    <form action="" method="GET" class="year-form">
                      <select name="year" class="form-select year-select">
                        @foreach ($years as $year)
                          <option @selected(request()->year == $year) value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                      </select>
                    </form>
                  </div>
                </div>
                <div class="card-body">
                  <div id="chart-mentions" class="chart-lg"></div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table table-striped">
                    <thead>
                    <tr>
                      <th>N°</th>
                      <th>Author</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th class="w-8"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($withdrawRequests as $withdrawRequest)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          <div>{{ $withdrawRequest->author->name }}</div>
                          <div>{{ $withdrawRequest->author->email }}</div>
                        </td>
                        <td>{{ currencyPosition($withdrawRequest->amount_formatted) }}</td>
                        <td>
                          @if($withdrawRequest->status == 'pending')
                            <span class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                          @elseif($withdrawRequest->status == 'paid')
                            <span class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                          @else
                            <span class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                          @endif
                        </td>
                        <td>{{ formatDate($withdrawRequest->created_at) }}</td>
                        <td>
                          <a href="{{ route('admin.withdraw-requests.show', $withdrawRequest->id) }}">
                            <i class="ti ti-eye"></i>
                          </a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="6" class="text-center">{{ __('No withdraw requests found.') }}</td>
                      </tr>
                    @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-vcenter card-table table-striped">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Buyer</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th class="w-1"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                      <tr>
                        <td>#{{ $order->code }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td class="text-green">
                          {{ $order->transaction->paid_in_amount }}
                          {{ Str::upper($order->transaction->paid_in_currency_icon) }}
                        </td>
                        <td>
                          <span class="badge bg-green text-white">{{ $order->status }}</span>
                        </td>
                        <td>
                          <a href="{{ route('admin.orders.show', $order->id) }}">
                            <i class="ti ti-eye"></i>
                          </a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center">No orders found</td>
                      </tr>
                    @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
  <footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
      <div class="row text-center align-items-center flex-row-reverse">
        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
          <ul class="list-inline list-inline-dots mb-0">
            <li class="list-inline-item">
              Copyright &copy; {{ date('Y') }}
              <a href="." class="link-secondary">Tabler</a>.
              All rights reserved.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('assets/admin/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var options = {
        chart: {
          height: 380,
          type: 'line',
          stacked: true,
          toolbar: {
            show: true,
            tools: {
              download: true,
              selection: true,
              zoom: true,
              zoomin: true,
              zoomout: true,
              pan: true,
              reset: true
            }
          }
        },
        series: @json($chartData['series']),
        stroke: {
          width: [0, 4, 3],
          curve: 'smooth'
        },
        plotOptions: {
          bar: {
            columnWidth: '50%'
          }
        },
        fill: {
          opacity: [0.85, 1, 0.25],
          gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
          }
        },
        labels: @json($chartData['months']),
        markers: {
          size: 0
        },
        xaxis: {
          title: {
            text: 'Month'
          }
        },
        yaxis: {
          title: {
            text: 'Amount ($)'
          },
          labels: {
            formatter: function(value) {
              return '$' + value.toFixed(2);
            }
          },
          min: 0,
          max: function(max) {
            return max * 1;
          },
        },
        tooltip: {
          shared: true,
          intersect: false,
          y: {
            formatter: function(value) {
              return '$' + value.toFixed(2);
            }
          }
        },
        colors: ['#008FFB', '#00E396', '#FEB019'],
        title: {
          text: 'This Years Sales Analytics',
          align: 'center'
        },
        legend: {
          position: 'bottom'
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0.5
          }
        }
      };

      var chart = new ApexCharts(
        document.querySelector("#chart-mentions"),
        options
      )

      chart.render()

      // Formulaire Select Year
      $('.year-select').on('change', function () {
        $('.year-form').submit()
      })

    })

  </script>
@endpush
