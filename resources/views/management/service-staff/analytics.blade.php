@extends('management.main_index')
@section('title', 'Dashboard')
@section('content')
<div class="row m-0 p-1">
    <div class="col-lg-12 px-4 pt-4">
        <div class="row m-0">
            <div class="col-md-6 dashboard-heading ">
                <h3>Dashboard Service</h3>
                <small class="text-muted">You can view service requests data analytics and more here.</small>
            </div>
        </div>
    </div>
</div>
<div class="row m-0">
  <div class="col-lg-12 px-3">
    <hr class="my-2">
  </div>
</div>
<div class="row m-2">
  <div class="col-lg-12 px-0">
    <div class="dash-heading-warning px-4 py-2 m-1 border-bottom border-top border-right">
      <div class="row m-0 p-0">
        <div class="col-4 p-0 d-flex align-items-center">
          <h5 class="font-netflix m-0">Requests</h5>
        </div>
        <div class="col-8 p-0 d-flex justify-content-end">
          <a href="{{url('serv/generate-report/submissions')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
            <span class="pr-2">Download</span>
            <span class="material-symbols-outlined">
              csv
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 rounded px-4 py-3 m-1 border shadow-sm">
    <div class="requests-charts ">
      <h6 class="font-netflix-md my-0">Total Requests Received</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      <div class="form-group pt-2">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="requestsChartCategory" class="form-control">
              <option value="monthly" selected>This Month</option>
              <option value="yearly">This Year</option>
            </select>
          </div>
        </div>
      </div>
      <div id="monthlyReqLineGraph" class="monthlyReqChart">
        <canvas id="monthlyRequestsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
      <div id="yearlyReqLineGraph" class="yearlyReqChart">
        <canvas id="yearlyRequestsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
    </div>
  </div>
  <div class="col rounded px-4 py-3 m-1 border shadow-sm">
    <div class="requests-charts">
      <h6 class="font-netflix-md my-0">Types of Service Requests</h6>
      <small class="text-muted text-xs">You can view the different services requested by the user. Hover to view info.</small>
      <div class="form-group pt-2" id="monthlyReqTable">
        <div class="row m-0 py-2 monthlyReqChart" id="monthlyReqTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="monthlyRequestTypeChart" class="chart d-block w-100 monthlyReqChart"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center monthlyReqChart">
            <table class="table table-sm table-responsive table-hover rounded ">
              <thead class="thead-dark">
                <th>Type</th>
                <th>Pending</th>
                <th>Approved</th>
                <th>Rejected</th>
                <th>Total</th>
              </thead>
              <tbody>
                @foreach (["Training/Workshop", "Data Analytics", "Technical Assistance/Consultancy", "Survey Services"] as $type)
                @php
                $item = $monthlyServiceTypeRequestsStatus->firstWhere('service_request_type', $type);
                @endphp
                <tr>
                  <td class="font-netflix-md align-middle">{{ $type }}</td>
                  @if ($item)
                  <td class="align-middle text-center">{{ $item->pending }}</td>
                  <td class="align-middle text-center">{{ $item->approved }}<br><small class="text-xs font-netflix-md">{{'(' . number_format(($item->approved / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)' }}</small></td>
                  <td class="align-middle text-center">{{ $item->rejected }}<br><small class="text-xs font-netflix-md">{{'(' . number_format(($item->rejected / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)' }}</small></td>
                  <td class="align-middle text-center">{{ $item->pending + $item->approved + $item->rejected }}</td>
                  @else
                  <td class="align-middle text-center">0</td>
                  <td class="align-middle text-center">0 <br><small class="text-xs font-netflix-md">(0.00%)</small></td>
                  <td class="align-middle text-center">0 <br><small class="text-xs font-netflix-md">(0.00%)</small></td>
                  <td class="align-middle text-center">0</td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="form-group pt-2" id="yearlyReqTable">
        <div class="row m-0 py-2 yearlyReqChart" id="yearlyReqTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="yearlyRequestTypeChart" class="chart d-block w-100"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center yearlyReqChart">
            <table class="table table-sm table-responsive table-hover rounded ">
              <thead class="thead-dark">
                <th>Type</th>
                <th>Pending</th>
                <th>Approved</th>
                <th>Rejected</th>
                <th>Total</th>
              </thead>
              <tbody>
                @foreach (["Training/Workshop", "Data Analytics", "Technical Assistance/Consultancy", "Survey Services"] as $type)
                @php
                $item = $yearlyServiceTypeRequestsStatus->firstWhere('service_request_type', $type);
                @endphp
                <tr>
                  <td class="font-netflix-md align-middle">{{ $type }}</td>
                  @if ($item)
                  <td class="align-middle text-center">{{ $item->pending }}</td>
                  <td class="align-middle text-center">{{ $item->approved }}<br><small class="text-xs font-netflix-md">{{'(' . number_format(($item->approved / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)' }}</small></td>
                  <td class="align-middle text-center">{{ $item->rejected }}<br><small class="text-xs font-netflix-md">{{'(' . number_format(($item->rejected / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)' }}</small></td>
                  <td class="align-middle text-center">{{ $item->pending + $item->approved + $item->rejected }}</td>
                  @else
                  <td class="align-middle text-center">0</td>
                  <td class="align-middle text-center">0 <br><small class="text-xs font-netflix-md">(0.00%)</td>
                  <td class="align-middle text-center">0 <br><small class="text-xs font-netflix-md">(0.00%)</td>
                  <td class="align-middle text-center">0</td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
    var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    var currentMonthName = monthNames[ {{date('n', strtotime(now()))}} - 1];
    var currentYear = {{date('Y', strtotime(now()))}};

    var labels = @json($labels);
    var monthlyRequestData = @json($monthlyRequestData);
    var yearlyRequestsData = @json($yearlyRequestsData);
    var serviceTypeRequestsLabel = @json($serviceTypeRequestsLabel);
    var monthlyServiceTypeRequestsData = @json($monthlyServiceTypeRequestsData);
    var yearlyServiceTypeRequestsData = @json($yearlyServiceTypeRequestsData);

    var ctx = document.getElementById('monthlyRequestsChart');
    var ctx2 = document.getElementById('yearlyRequestsChart');
    var ctx3 = document.getElementById('monthlyRequestTypeChart');
    var ctx4 = document.getElementById('yearlyRequestTypeChart');

    var monthlyRequestsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Services',
                        data: monthlyRequestData,
                        tension: .4,
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Submission of Requests',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: currentMonthName+' ('+currentYear+')',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        // suggestedMin: 1,
                        suggestedMax: 10,
                        title: {
                            display: true,
                            text: 'Number of Submissions',
                        },
                    },
                    
                }
            }
        });
        var yearlyRequestsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [
                    {
                        label: 'Services',
                        data: yearlyRequestsData,
                        borderWidth: 1
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Submission of Requests',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Months'+'('+currentYear+')',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        // suggestedMin: 1,
                        suggestedMax: 20,
                        title: {
                            display: true,
                            text: 'Number of Submissions',
                        },
                    },
                    
                }
            }
        });
        var monthlyReqTypeChart = new Chart(ctx3, {    
            type: 'pie',
            data: {
                labels: serviceTypeRequestsLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: monthlyServiceTypeRequestsData,
                    },

                ]
            },
            options: {
                responsive: false, // Disable automatic resizing
                layout: {
                    padding: {
                        left: 20,  // Adjust the left padding
                        right: 20, // Adjust the right padding
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Type of Service Requests ('+currentMonthName+' '+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                    
                },
            }
        });
        var yearlyReqTypeChart = new Chart(ctx4, {
            type: 'pie',
            data: {
                labels: serviceTypeRequestsLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: yearlyServiceTypeRequestsData,
                    },

                ]
            },
            options: {
                responsive: false, // Disable automatic resizing
                layout: {
                    padding: {
                        left: 20,  // Adjust the left padding
                        right: 20, // Adjust the right padding
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Type of Service Requests ('+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        $('.yearlyReqChart').hide();
        $('#requestsChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#requestsChartCategory').val() === 'yearly'){
                $('.monthlyReqChart').hide();
                $('.yearlyReqChart').show();
            }else {
                $('.yearlyReqChart').hide();
                $('.monthlyReqChart').show();
            }
        });


});
</script>
@endsection