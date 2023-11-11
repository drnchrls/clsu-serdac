@extends('management.main_index')
@section('title', 'Dashboard')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <h3>Dashboard</h3>
        <small class="text-muted">You can view web statistics, data analytics and more.</small>
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
  <div class="d-flex col-lg-8 px-0 rounded m-1 border shadow-sm">
    <div class="row m-0">
      <div class="col-lg-9 p-3">
        <div class="user-total ">
          <h4 class="font-netflix-md">Welcome back <span class="wlc-adm">{{ Auth::guard('staff')->user()->staff_fname }}!</span></h4>
          <p class="px-1">
            <small class="font-netflix-light text-muted">Welcome to your <strong>Dashboard</strong>, you can see the overview of the website statistics, data analytics, you can also generate and download data in
              <strong>CSV</strong> format for report generation.
            </small>
          </p>
        </div>
      </div>
      <div class="col-lg-3 p-0 position-relative overflow-hidden">
        <div class="position-absolute p-0" style="">
          <img src="{{ url('import/assets/images/contents/admin.png') }}" class="d-block w-100" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="col px-0 rounded pt-3 m-1 border shadow-sm">
    <div class="user-total">
      <div class="row m-0">
        <div class="col-12 text-lg-center text-left">
          <h6 class="font-netflix-md text-xs">Library Requests</h6>
        </div>
        <div class="col-12 d-flex justify-content-lg-center align-items-center p-lg-0 px-3">
          <div class="p-3 border text-gradient-success rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              mark_email_unread
            </span>
          </div>
          <div class="d-flex align-items-center px-2">
            <div>
              <h4 class="font-netflix-md m-0">{{$publicationRequestsPending}}</h4>
              <small class="text-muted text-xs">Pending</small>
            </div>
          </div>
        </div>
        <div class="col p-2 d-flex justify-content-center">
          <small>
            <a href="{{ route('admin.publications.requests') }}">View</a>
          </small>
        </div>
      </div>
    </div>
  </div>
  <div class="col px-0 rounded pt-3 m-1 border shadow-sm">
    <div class="user-total">
      <div class="row m-0">
        <div class="col-12 text-lg-center text-left">
          <h6 class="font-netflix-md text-xs">Service Requests</h6>
        </div>
        <div class="col-12 d-flex justify-content-lg-center align-items-center p-lg-0 px-3">
          <div class="p-3 border text-gradient-danger rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              mark_email_unread
            </span>
          </div>
          <div class="d-flex align-items-center px-2">
            <div>
              <h4 class="font-netflix-md m-0">{{$serviceRequestsPending}}</h4>
              <small class="text-muted text-xs">Pending</small>
            </div>
          </div>
        </div>
        <div class="col p-2 d-flex justify-content-center">
          <small>
            <a href="{{ route('admin.services.requests') }}">View</a>
          </small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 px-0">
    <div class="web-stat rounded px-4 py-3 m-1 border shadow-sm">
      <div class="row m-0">
        <div class="col-lg-12 px-0">
          <h5 class="font-netflix">Website Statistics</h5>
        </div>
        <div class="col-lg-3 col-6 border-right p-2 d-flex justify-content-center align-items-center">
          <span class="text-center">
            <span class="material-symbols-outlined sz-35 rounded-circle bg-light p-2 border shadow-sm">
              admin_panel_settings
            </span>
            <h4 class="font-netflix-md m-0">{{ $staffTotal }}</h4>
            <small class="text-xs text-muted font-netflix">Staff</small>
          </span>
        </div>
        <div class="col-lg-3 col-6 border-right responsive-border p-2 d-flex justify-content-center align-items-center">
          <span class="text-center">
            <span class="material-symbols-outlined sz-35 rounded-circle bg-light p-2 border shadow-sm">
              shield_person
            </span>
            <h4 class="font-netflix-md m-0">{{$userTotal}}</h4>
            <small class="text-xs text-muted font-netflix">Registered</small>
          </span>
        </div>
        <div class="col-lg-3 col-6 border-right p-2 d-flex justify-content-center align-items-center">
          <span class="text-center">
            <span class="material-symbols-outlined sz-35 rounded-circle bg-light p-2 border shadow-sm">
              book_5
            </span>
            <h4 class="font-netflix-md m-0">{{$publicationTotal}}</h4>
            <small class="text-xs text-muted font-netflix">Publications</small>
          </span>
        </div>
        <div class="col-lg-3 col-6 p-2 d-flex justify-content-center align-items-center">
          <span class="text-center">
            <span class="material-symbols-outlined sz-35 rounded-circle bg-light p-2 border shadow-sm">
              two_pager
            </span>
            <h4 class="font-netflix-md m-0">{{$datasetTotal}}</h4>
            <small class="text-xs text-muted font-netflix">Datasets</small>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 px-0">
    <hr>
    <div class="dash-heading-success px-4 py-2 m-1 border-bottom border-top border-right">
      <div class="row m-0 p-0">
        <div class="col-4 p-0 d-flex align-items-center">
          <h5 class="font-netflix m-0">Users</h5>
        </div>
        <div class="col-8 p-0 d-flex justify-content-end">
          <a href="{{url('admin/generate-report/users')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
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
    <div class="users-dash ">
      <h6 class="font-netflix-md my-0">Total Account Created</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      <div class="form-group pt-2">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="accChartCategory" class="form-control">
              <option value="monthly" selected>This Month</option>
              <option value="yearly">This Year</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-12 p-0" id="monthlyAccChart">
        <canvas id="monthlyAccountChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
      <div class="col-lg-12 p-0" id="yearlyAccChart">
        <canvas id="yearlyAccountChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
    </div>
  </div>
  <div class="col rounded px-4 py-3 m-1 border shadow-sm">
    <div class="users-charts">
      <h6 class="font-netflix-md my-0">User Demographics</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      <div class="form-group pt-2">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="userChartCategory" class="form-control">
              <option value="Gender" selected>Gender</option>
              <option value="Age">Age</option>
              <option value="Occupation">Occupation</option>
              <option value="Educational Level">Educational Level</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-12 p-0" id="genderChart">
        <div class=" d-flex justify-content-center align-items-center">
          <canvas id="usersGenderChart" class="chart d-block w-50"></canvas>
        </div>
      </div>
      <div class="col-12 p-0" id="ageChart">
        <div class="d-flex justify-content-center align-items-center">
          <canvas id="usersAgeChart" class="chart d-block w-50"></canvas>
        </div>
      </div>
      <div class="col-12 p-0" id="occChart">
        <div class="d-flex justify-content-center align-items-center">
          <canvas id="usersOccChart" class="chart d-block w-50"></canvas>
        </div>
      </div>
      <div class="col-12 p-0" id="elChart">
        <div class="d-flex justify-content-center align-items-center">
          <canvas id="usersELChart" class="chart d-block w-50"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 px-0">
    <hr>
    <div class="dash-heading-warning px-4 py-2 m-1 border-bottom border-top border-right">
      <div class="row m-0 p-0">
        <div class="col-4 p-0 d-flex align-items-center">
          <h5 class="font-netflix m-0">Requests</h5>
        </div>
        <div class="col-8 p-0 d-flex justify-content-end">
          <a href="{{url('admin/generate-report/submissions')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
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
      <div id="monthlyReqLineGraph">
        <canvas id="monthlyRequestsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
      <div id="yearlyReqLineGraph">
        <canvas id="yearlyRequestsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
    </div>
  </div>
  <div class="col rounded px-4 py-3 m-1 border shadow-sm">
    <div class="requests-charts">
      <h6 class="font-netflix-md my-0">Types of Requests</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      <div class="form-group pt-2" id="monthlyReqTable">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="monthlyTypeChartCategory" class="form-control">
              <option value="publication" selected>Publications Submission</option>
              <option value="service">Service Requests</option>
            </select>
          </div>
        </div>
        <div class="row m-0 py-4" id="monthlyPubTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="monthlyPublicationTypeChart" class="chart d-block w-100"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center" id="monthlyPubTypeTable">
            <table class="table table-sm table-responsive table-hover rounded ">
              <thead class="thead-dark">
                <th>Type</th>
                <th>Pending</th>
                <th>Approved</th>
                <th>Rejected</th>
                <th>Total</th>
              </thead>
              <tbody>
                @foreach (["Book", "Journal/Journal Article", "Technical Report/Research Paper", "Unclassified/Others"] as $type)
                @php
                $item = $monthlyPublicationTypeRequestsStatus->firstWhere('submission_publication_type', $type);
                @endphp
                <tr>
                  <td class="font-netflix-md align-middle">{{ $type }}</td>
                  @if ($item)
                  <td class="align-middle text-center">{{ $item->pending }}</td>
                  <td class="align-middle text-center">{{ $item->approved}} <br><small class="text-xs font-netflix-md">{{ '(' . number_format(($item->approved / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)'  }}</small></td>
                  <td class="align-middle text-center">{{ $item->rejected }} <br><small class="text-xs font-netflix-md">{{ ' (' . number_format(($item->rejected / ($item->pending + $item->approved + $item->rejected)) * 100, 2) . '%)'  }}</small></td>
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
        <div class="row m-0 py-4" id="monthlyReqTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="monthlyRequestTypeChart" class="chart d-block w-100"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center" id="monthlyReqTypeTable">
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
        <div class="form-row">
          <div class="col-12">
            <select name="" id="yearlyPubTypeChartCategory" class="form-control">
              <option value="publication" selected>Type of Submission Publications</option>
              <option value="service">Type of Service Requests</option>
            </select>
          </div>
        </div>
        <div class="row m-0 py-4" id="yearlyPubTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="yearlyPublicationTypeChart" class="chart d-block w-100"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center" id="yearlyPubTypeTable">
            <table class="table table-sm table-responsive table-hover rounded">
              <thead class="thead-dark">
                <th>Type</th>
                <th>Pending</th>
                <th>Approved</th>
                <th>Rejected</th>
                <th>Total</th>
              </thead>
              <tbody>
              @foreach (["Book", "Journal/Journal Article", "Technical Report/Research Paper", "Unclassified/Others"] as $type)
              @php
              $item = $yearlyPublicationTypeRequestsStatus->firstWhere('submission_publication_type', $type);
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
        <div class="row m-0 py-4" id="yearlyReqTypeChart">
          <div class="col-lg-5 px-0">
            <canvas id="yearlyRequestTypeChart" class="chart d-block w-100"></canvas>
          </div>
          <div class="col-lg-7 px-0 py-3 d-flex align-items-center justify-content-center" id="yearlyReqTypeTable">
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
  <div class="col-lg-12 px-0">
    <hr>
    <div class="dash-heading-info px-4 py-2 m-1 border-bottom border-top border-right">
      <div class="row m-0 p-0">
        <div class="col-4 p-0 d-flex align-items-center">
          <h5 class="font-netflix m-0">Downloads</h5>
        </div>
        <div class="col-8 p-0 d-flex justify-content-end">
          <a href="{{url('admin/generate-report/downloads')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
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
    <div class="users-dash ">
      <h6 class="font-netflix-md my-0">Total Downloads</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      <div class="form-group pt-2">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="downloadsChartCategory" class="form-control">
              <option value="monthly" selected>By This Month</option>
              <option value="yearly">By This Year</option>
            </select>
          </div>
        </div>
      </div>
      <div id="monthlyDownloadsLineGraph">
        <canvas id="monthlyDownloadsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
      <div id="yearlyDownloadsLineGraph">
        <canvas id="yearlyDownloadsChart" class="d-block w-100 border p-4 rounded"></canvas>
      </div>
    </div>
  </div>
  <div class="col rounded px-4 py-3 m-1 border shadow-sm">
    <div class="downloads-chart">
      <h6 class="font-netflix-md my-0">Total Download Reasons</h6>
      <small class="text-muted text-xs">You can change the category of the data displayed by clicking the button below.</small>
      {{-- monthly --}}
      <div class="form-group pt-2" id="monthlyReasonTable">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="monthlyReasonChartCategory" class="form-control">
              <option value="publication" selected>Publication</option>
              <option value="dataset">Dataset</option>
            </select>
          </div>
        </div>
        <div class="col-12 p-0" id="monthlyDatReasonChartContainer">
          <div class="d-flex justify-content-center align-items-center">
            <canvas id="monthlyDatReasonDownloadChart" class="chart d-block w-50"></canvas>
          </div>
        </div>
        <div class="col-12 p-0" id="monthlyPubReasonChartContainer">
          <div class="d-flex justify-content-center align-items-center">
            <canvas id="monthlyPubReasonDownloadChart" class="chart d-block w-50"></canvas>
          </div>
        </div>
      </div>
      {{-- yearly --}}
      <div class="form-group pt-2" id="yearlyReasonTable">
        <div class="form-row">
          <div class="col-12">
            <select name="" id="yearlyReasonChartCategory" class="form-control">
              <option value="publication" selected>Publication</option>
              <option value="dataset">Dataset</option>
            </select>
          </div>
        </div>
        <div class="col-12 p-0" id="yearlyPubReasonChartContainer">
          <div class="d-flex justify-content-center align-items-center">
            <canvas id="yearlyPubReasonDownloadChart" class="chart d-block w-50"></canvas>
          </div>
        </div>
        <div class="col-12 p-0" id="yearlyDatReasonChartContainer">
          <div class="d-flex justify-content-center align-items-center">
            <canvas id="yearlyDatReasonDownloadChart" class="chart d-block w-50"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 rounded px-4 py-3 m-1 border shadow-sm">
    <div class="users-dash ">
      <h6 class="font-netflix-md my-0">Top Downloads </h6>
      <div class="monthlyDownloadTable">
        <div class="monthlyTopDatasets">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most downloaded datasets for the month.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($monthlyTopDownloadDatasets as $monthlyTopDownloadDataset)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$monthlyTopDownloadDataset->download_dataset_title}}</h6>
                      <small class="text-xs clip-one-line">{{$monthlyTopDownloadDataset->download_dataset_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$monthlyTopDownloadDataset->count}}</h6>
                        <small class="text-xs font-netflix-md">Downloads</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
        <div class="monthlyTopPublications">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most downloaded publications for the month.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($monthlyTopDownloadPublications as $monthlyTopDownloadPublication)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$monthlyTopDownloadPublication->download_publication_title}}</h6>
                      <small class="text-xs clip-one-line">{{$monthlyTopDownloadPublication->download_publication_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$monthlyTopDownloadPublication->count}}</h6>
                        <small class="text-xs font-netflix-md">Downloads</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="yearlyDownloadTable">
        <div class="yearlyTopDatasets">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most downloaded datasets for the year.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($yearlyTopDownloadDatasets as $yearlyTopDownloadDataset)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$yearlyTopDownloadDataset->download_dataset_title}}</h6>
                      <small class="text-xs clip-one-line">{{$yearlyTopDownloadDataset->download_dataset_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$yearlyTopDownloadDataset->count}}</h6>
                        <small class="text-xs font-netflix-md">Downloads</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
        <div class="yearlyTopPublications">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most downloaded publications for the year.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($yearlyTopDownloadPublications as $yearlyTopDownloadPublication)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$yearlyTopDownloadPublication->download_publication_title}}</h6>
                      <small class="text-xs clip-one-line">{{$yearlyTopDownloadPublication->download_publication_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$yearlyTopDownloadPublication->count}}</h6>
                        <small class="text-xs font-netflix-md">Downloads</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col rounded px-4 py-3 m-1 border shadow-sm">
    <div class="downloads-chart">
      <h6 class="font-netflix-md my-0">Top Views</h6>
      <small class="text-muted text-xs"></small>
      <div class="monthlyDownloadTable">
        <div class="monthlyTopDatasets">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most viewed datasets for the month.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($monthlyTopViewDatasets as $monthlyTopViewDataset)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$monthlyTopViewDataset->publication->dataset_title}}</h6>
                      <small class="text-xs clip-one-line">{{$monthlyTopViewDataset->publication->dataset_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$monthlyTopViewDataset->count}}</h6>
                        <small class="text-xs font-netflix-md">Views</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
        <div class="monthlyTopPublications">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most viewed publications for the month.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($monthlyTopViewPublications as $monthlyTopViewPublication)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$monthlyTopViewPublication->publication->publication_title}}</h6>
                      <small class="text-xs clip-one-line">{{$monthlyTopViewPublication->publication->publication_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$monthlyTopViewPublication->count}}</h6>
                        <small class="text-xs font-netflix-md">Views</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="yearlyViewTable">
        <div class="yearlyTopDatasets">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most viewed datasets for the year.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($yearlyTopViewDatasets as $yearlyTopViewDataset)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$yearlyTopViewDataset->publication->dataset_title}}</h6>
                      <small class="text-xs clip-one-line">{{$yearlyTopViewDataset->publication->dataset_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$yearlyTopViewDataset->count}}</h6>
                        <small class="text-xs font-netflix-md">Views</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
        <div class="yearlyTopPublications">
          <div class="row">
            <div class="col-lg-12">
              <small class="text-muted text-xs">Here are the top most viewed publication for the year.</small>
            </div>
            <div class="col-lg-12">
              <div class="top-dl-container px-1 bg-light border-bottom border-top border-left rounded mt-3">
                @foreach($yearlyTopViewPublications as $yearlyTopViewPublication)
                <div class="download-stat border rounded bg-white p-3 my-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-8 px-2">
                      <h6 class="m-0 clip-one-line font-netflix-md">{{$yearlyTopViewPublication->publication->publication_title}}</h6>
                      <small class="text-xs clip-one-line">{{$yearlyTopViewPublication->publication->publication_author}}</small>
                    </div>
                    <div class="col-lg-2 col-4 px-0 d-flex align-items-center justify-content-end">
                      <span class="">
                        <h6 class="m-0 text-center">{{$yearlyTopViewPublication->count}}</h6>
                        <small class="text-xs font-netflix-md">Views</small>
                      </span>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="col-lg-12 p-1 text-center">
                <small class="text-muted text-xs"><strong class="text-danger">Only</strong> the <strong>top 10</strong> will be displayed.</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>{{-- end-row --}}

<script>
    $(document).ready(function () {
        
        var monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];

        var currentMonthName = monthNames[ {{date('n', strtotime(now()))}} - 1];
        var currentYear = {{date('Y', strtotime(now()))}};

        var labels = @json($labels);
        var monthlyPublicationData = @json($monthlyPublicationData);
        var monthlyDatasetData = @json($monthlyDatasetData);
        var yearlyPublicationData = @json($yearlyPublicationData);
        var yearlyDatasetData = @json($yearlyDatasetData);
        var monthlySubmissionData = @json($monthlySubmissionData);
        var monthlyRequestData = @json($monthlyRequestData);
        var yearlySubmissionData = @json($yearlySubmissionData);
        var yearlyRequestsData = @json($yearlyRequestsData);
        var usersDataGender = @json($usersDataGender);
        var usersLabelGender = @json($usersLabelGender);
        var usersDataEL = @json($usersDataEL);
        var usersLabelEL = @json($usersLabelEL);
        var usersDataOcc = @json($usersDataOcc);
        var usersLabelOcc = @json($usersLabelOcc);
        var monthlyAccountData = @json($monthlyAccountData);
        var yearlyAccountData = @json($yearlyAccountData);
        var monthlyPubReasonDownloadData = @json($monthlyPubReasonDownloadData);
        var monthlyDatReasonDownloadData = @json($monthlyDatReasonDownloadData);
        var yearlyPubReasonDownloadData = @json($yearlyPubReasonDownloadData);
        var yearlyDatReasonDownloadData = @json($yearlyDatReasonDownloadData);
        var reasonDownloadLabel = @json($reasonDownloadLabel);
        var publicationTypeRequestsLabel = @json($publicationTypeRequestsLabel);
        var serviceTypeRequestsLabel = @json($serviceTypeRequestsLabel);
        var monthlyPublicationTypeRequestsData = @json($monthlyPublicationTypeRequestsData);
        var monthlyServiceTypeRequestsData = @json($monthlyServiceTypeRequestsData);
        var yearlyPublicationTypeRequestsData = @json($yearlyPublicationTypeRequestsData);
        var yearlyServiceTypeRequestsData = @json($yearlyServiceTypeRequestsData);
        
        var ctx = document.getElementById('monthlyDownloadsChart');
        var ctx2 = document.getElementById('monthlyRequestsChart');
        var ctx3 = document.getElementById('yearlyRequestsChart');
        var ctx4 = document.getElementById('yearlyDownloadsChart');
        var ctx5 = document.getElementById('usersGenderChart');
        var ctx6 = document.getElementById('usersAgeChart');
        var ctx7 = document.getElementById('usersOccChart');
        var ctx8 = document.getElementById('usersELChart');
        var ctx9 = document.getElementById('monthlyPubReasonDownloadChart');
        var ctx10 = document.getElementById('monthlyPublicationTypeChart');
        var ctx11 = document.getElementById('monthlyRequestTypeChart');
        var ctx12 = document.getElementById('yearlyPublicationTypeChart');
        var ctx13 = document.getElementById('yearlyRequestTypeChart');
        var ctx14 = document.getElementById('monthlyDatReasonDownloadChart');
        var ctx15 = document.getElementById('yearlyPubReasonDownloadChart');
        var ctx16 = document.getElementById('yearlyDatReasonDownloadChart');
        var ctx17 = document.getElementById('monthlyAccountChart');
        var ctx18 = document.getElementById('yearlyAccountChart');

        var monthlyDownloadsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Publications',
                        data: monthlyPublicationData,
                        tension: .4,
                        borderWidth: 1,
                    },
                    {
                        label: 'Datasets',
                        data: monthlyDatasetData,
                        tension: .4,
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Downloads',
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
                            text: 'Number of Downloads',
                        },
                    },
                    
                }
            }
        });
        var monthlyRequestsChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Publications',
                        data: monthlySubmissionData,
                        tension: .4,
                        borderWidth: 1
                    },
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
        var yearlyRequestsChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [
                    {
                        label: 'Publications',
                        data: yearlySubmissionData,
                        borderWidth: 1
                    },
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

        var yearlyDownloadsChart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [
                    {
                        label: 'Publications',
                        data: yearlyPublicationData,
                        borderWidth: 1
                    },
                    {
                        label: 'Datasets',
                        data: yearlyDatasetData,
                        borderWidth: 1
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Downloads',
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

        var usersGenderChart = new Chart(ctx5, {
            type: 'pie',
            data: {
                labels: usersLabelGender,
                datasets: [
                    {
                        label: 'Count',
                        data: usersDataGender,
                    },

                ]
            },
            options: {
                responsive: false, // Disable automatic resizing
                layout: {
                    padding: {
                        left: 3,  // Adjust the left padding
                        right: 3, // Adjust the right padding
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Gender',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var usersAgeChart = new Chart(ctx6, {
            type: 'pie',
            data: {
                labels: @json($usersAgeData['labels']),
                datasets: [
                    {
                        label: 'Count',
                        data:@json($usersAgeData['data']),
                    },

                ]
            },
            options: {
                responsive: false, // Disable automatic resizing
                layout: {
                    padding: {
                        left: 3,  // Adjust the left padding
                        right: 3, // Adjust the right padding
                    },
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Age',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var usersOccChart = new Chart(ctx7, {
            type: 'pie',
            data: {
                labels: usersLabelOcc,
                datasets: [
                    {
                        label: 'Count',
                        data: usersDataOcc,
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
                        text: 'Occupation',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var usersELChart = new Chart(ctx8, {
            type: 'pie',
            data: {
                labels: usersLabelEL,
                datasets: [
                    {
                        label: 'Count',
                        data: usersDataEL,
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
                    // datalabels: {
                    //     color: 'black',
                    //     font: {
                    //         weight: 'bold',
                    //     },
                    //     formatter: (value, context) => {
                    //         // `value` is the data value for the current segment
                    //         // `context` contains information about the current data point
                    //         return value + '%'; // Format the label text as needed
                    //     },
                    // },

                    title: {
                        display: true,
                        text: 'Educational Level',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var monthlyPubReasonChart = new Chart(ctx9, {
            type: 'pie',
            data: {
                labels: reasonDownloadLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: monthlyPubReasonDownloadData,
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
                        text: 'Download Reasons for Publications ('+currentMonthName+' '+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var monthlyDatReasonChart = new Chart(ctx14, {
            type: 'pie',
            data: {
                labels: reasonDownloadLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: monthlyDatReasonDownloadData,
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
                        text: 'Download Reasons for Dataset ('+currentMonthName+' '+currentYear +')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        // 

        var yearlyPubReasonChart = new Chart(ctx15, {
            type: 'pie',
            data: {
                labels: reasonDownloadLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: yearlyPubReasonDownloadData,
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
                        text: 'Download Reasons for Publications ('+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var yearlyDatReasonChart = new Chart(ctx16, {
            type: 'pie',
            data: {
                labels: reasonDownloadLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: yearlyDatReasonDownloadData,
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
                        text: 'Download Reasons for Datasets ('+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var monthlyPubTypeChart = new Chart(ctx10, {
            type: 'pie',
            data: {
                labels: publicationTypeRequestsLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: monthlyPublicationTypeRequestsData,
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
                        text: 'Type of Submission Publications ('+currentMonthName+' '+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });
        var monthlyReqTypeChart = new Chart(ctx11, {
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
        
        var yearlyPubTypeChart = new Chart(ctx12, {
            type: 'pie',
            data: {
                labels: publicationTypeRequestsLabel,
                datasets: [
                    {
                        label: 'Count',
                        data: yearlyPublicationTypeRequestsData,
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
                        text: 'Type of Submission Publications ('+currentYear+')',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });
        var yearlyReqTypeChart = new Chart(ctx13, {
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

        var monthlyAccountChart = new Chart(ctx17, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Accounts',
                        data: monthlyAccountData,
                        tension: .4,
                        borderWidth: 1,
                    },
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Created Accounts',
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
                            text: 'Number of Account Created',
                        },
                    },
                    
                }
            }
        });
        var yearlyAccountChart = new Chart(ctx18, {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [
                    {
                        label: 'Accounts',
                        data: yearlyAccountData,
                        tension: .4,
                        borderWidth: 1,
                    },
                ]
            },
            options: {
                responsive:true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Created Accounts',
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
                            text: currentYear,
                        },

                    },
                    y: {
                        beginAtZero: true,
                        // suggestedMin: 1,
                        suggestedMax: 10,
                        title: {
                            display: true,
                            text: 'Number of Account Created',
                        },
                    },
                    
                }
            }
        });


        $('#ageChart').hide();
        $('#occChart').hide();
        $('#elChart').hide();
        $('#userChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#userChartCategory').val() === 'Gender'){
                $('#ageChart').hide();
                $('#occChart').hide();
                $('#elChart').hide();
                $('#genderChart').show();
            }else if($('#userChartCategory').val() === 'Age'){
                $('#occChart').hide();
                $('#elChart').hide();
                $('#genderChart').hide();
                $('#ageChart').show();
            }else if($('#userChartCategory').val() === 'Occupation'){
                $('#occChart').show();
                $('#elChart').hide();
                $('#genderChart').hide();
                $('#ageChart').hide();
            }else {
                $('#occChart').hide();
                $('#elChart').show();
                $('#genderChart').hide();
                $('#ageChart').hide();
            }
        });
        
        $('#yearlyReqChart').hide();
        $('#yearlyReqLineGraph').hide();
        $('#yearlyReqTable').hide();
        $('#monthlyReqTypeChart').hide();
        $('#yearlyReqTypeChart').hide();

        $('#requestsChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#requestsChartCategory').val() === 'yearly'){
                $('#monthlyReqChart').hide();
                $('#yearlyReqChart').show();
                $('#monthlyReqLineGraph').hide();
                $('#yearlyReqLineGraph').show();
                $('#monthlyReqTable').hide();
                $('#yearlyReqTable').show();
            }else {
                $('#yearlyReqChart').hide();
                $('#monthlyReqChart').show();
                $('#monthlyReqLineGraph').show();
                $('#yearlyReqLineGraph').hide();
                $('#monthlyReqTable').show();
                $('#yearlyReqTable').hide();
            }
        });

        $('#monthlyTypeChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#monthlyTypeChartCategory').val() === 'publication'){
                $('#monthlyReqTypeChart').hide();
                $('#monthlyPubTypeChart').show();
            }else {
                $('#monthlyPubTypeChart').hide();
                $('#monthlyReqTypeChart').show();
            }
        });

        $('#yearlyPubTypeChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#yearlyPubTypeChartCategory').val() === 'publication'){
                $('#yearlyReqTypeChart').hide();
                $('#yearlyPubTypeChart').show();
            }else {
                $('#yearlyPubTypeChart').hide();
                $('#yearlyReqTypeChart').show();
            }
        });

        $('#yearlyDownloadsLineGraph').hide();
        $('#yearlyReasonTable').hide();
        $('#yearlyDatReasonChartContainer').hide();
        $('#monthlyDatReasonChartContainer').hide();
        $('#yearlyDownloadTable').hide();
        $('#yearlyViewTable').hide();
        $('.monthlyTopDatasets').hide();
        $('.yearlyTopDatasets').hide();

        $('#downloadsChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#downloadsChartCategory').val() === 'yearly'){
                $('#monthlyDownloadsLineGraph').hide();
                $('#monthlyReasonTable').hide();
                $('#yearlyReasonTable').show();
                $('.monthlyDownloadTable').hide();
                $('#yearlyDownloadTable').show();
                $('#monthlyViewTable').hide();
                $('#yearlyViewTable').show();
                $('#yearlyDownloadsLineGraph').show();
            }else {
                $('#yearlyDownloadsLineGraph').hide();
                $('#monthlyReasonTable').show();
                $('#yearlyReasonTable').hide();
                $('.monthlyDownloadTable').show();
                $('#yearlyDownloadTable').hide();
                $('#monthlyViewTable').show();
                $('#yearlyViewTable').hide();
                $('#monthlyDownloadsLineGraph').show();
            }
        });

        $('#monthlyReasonChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#monthlyReasonChartCategory').val() === 'publication'){
                $('#monthlyPubReasonChartContainer').show();
                $('#monthlyDatReasonChartContainer').hide();
                $('.monthlyTopPublications').show();
                $('.monthlyTopDatasets').hide();
            }else {
                $('#monthlyDatReasonChartContainer').show();
                $('#monthlyPubReasonChartContainer').hide();
                $('.monthlyTopPublications').hide();
                $('.monthlyTopDatasets').show();
            }
        });

        $('#yearlyReasonChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#yearlyReasonChartCategory').val() === 'publication'){
                $('#yearlyPubReasonChartContainer').show();
                $('#yearlyDatReasonChartContainer').hide();
                $('.yearlyTopPublications').show();
                $('.yearlyTopDatasets').hide();
            }else {
                $('#yearlyDatReasonChartContainer').show();
                $('#yearlyPubReasonChartContainer').hide();
                $('.yearlyTopPublications').hide();
                $('.yearlyTopDatasets').show();
            }
        });

        $('#yearlyAccChart').hide();
        $('#accChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#accChartCategory').val() === 'yearly'){
                $('#monthlyAccChart').hide();
                $('#yearlyAccChart').show();
            }else {
                $('#yearlyAccChart').hide();
                $('#monthlyAccChart').show();
            }
        });


    });
    
</script>
@endsection
