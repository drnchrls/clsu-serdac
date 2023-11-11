@extends('management.main_index')
@section('title', 'Library')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <h3>Dashboard Library</h3>
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
<div class="col-lg-12 px-0">
  <div class="dash-heading-success px-4 py-2 m-1 border-bottom border-top border-right">
    <div class="row m-0 p-0">
      <div class="col-4 p-0 d-flex align-items-center">
        <h5 class="font-netflix m-0">Submissions</h5>
      </div>
      <div class="col-8 p-0 d-flex justify-content-end">
        <a href="{{url('libr/generate-report/submissions')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
          <span class="pr-2">Download</span>
          <span class="material-symbols-outlined">
            csv
          </span>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row m-2">
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
          </div>
          <div class="form-group pt-2" id="yearlyReqTable">
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
              <a href="{{url('libr/generate-report/downloads')}}" target="_blank" rel="noopener noreferrer" class="btn btn-success d-flex align-items-center">
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
        var yearlySubmissionData = @json($yearlySubmissionData);
        var monthlyPubReasonDownloadData = @json($monthlyPubReasonDownloadData);
        var monthlyDatReasonDownloadData = @json($monthlyDatReasonDownloadData);
        var yearlyPubReasonDownloadData = @json($yearlyPubReasonDownloadData);
        var yearlyDatReasonDownloadData = @json($yearlyDatReasonDownloadData);
        var reasonDownloadLabel = @json($reasonDownloadLabel);
        var monthlyPublicationTypeRequestsData = @json($monthlyPublicationTypeRequestsData);
        var yearlyPublicationTypeRequestsData = @json($yearlyPublicationTypeRequestsData);
        var publicationTypeRequestsLabel = @json($publicationTypeRequestsLabel);

        var ctx = document.getElementById('monthlyDownloadsChart');
        var ctx2 = document.getElementById('monthlyRequestsChart');
        var ctx3 = document.getElementById('yearlyRequestsChart');
        var ctx4 = document.getElementById('yearlyDownloadsChart');
        var ctx5 = document.getElementById('monthlyPubReasonDownloadChart');
        var ctx6 = document.getElementById('monthlyPublicationTypeChart');
        var ctx7 = document.getElementById('yearlyPublicationTypeChart');
        var ctx8 = document.getElementById('monthlyDatReasonDownloadChart');
        var ctx9 = document.getElementById('yearlyPubReasonDownloadChart');
        var ctx10 = document.getElementById('yearlyDatReasonDownloadChart');
    
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
                    }
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
                    }
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
        var monthlyPubReasonChart = new Chart(ctx5, {
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
                        text: 'Download Reasons (Publication)',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });
        var monthlyPubTypeChart = new Chart(ctx6, {
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
        var yearlyPubTypeChart = new Chart(ctx7, {
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

        var monthlyDatReasonChart = new Chart(ctx8, {
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
                        text: 'Download Reasons (Dataset)',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        // 

        var yearlyPubReasonChart = new Chart(ctx9, {
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
                        text: 'Download Reasons (Publication)',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });

        var yearlyDatReasonChart = new Chart(ctx10, {
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
                        text: 'Download Reasons (Dataset)',
                        position: 'top',
                        font: {
                            size: 16,
                        }
                    },
                },
            }
        });


        $('#yearlyReqLineGraph').hide();
        $('#yearlyReqTable').hide();

        $('#requestsChartCategory').on('change', function (e) {
            e.preventDefault();
            if($('#requestsChartCategory').val() === 'yearly'){
                $('#monthlyReqChart').hide();
                $('#monthlyReqLineGraph').hide();
                $('#yearlyReqLineGraph').show();
                $('#monthlyReqTable').hide();
                $('#yearlyReqTable').show();
            }else {
                $('#monthlyReqChart').show();
                $('#monthlyReqLineGraph').show();
                $('#yearlyReqLineGraph').hide();
                $('#monthlyReqTable').show();
                $('#yearlyReqTable').hide();
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
        
    // END
    });
</script>
@endsection