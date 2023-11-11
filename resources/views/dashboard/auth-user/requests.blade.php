@extends('dashboard.auth-user.dashboard')
@section('title', 'Requests')
@section('account-content')
    <div class="col-lg-9">
        <div class="row dashboard-pane p-4 bg-white rounded">
            <div class="col-6 header text-left">   
                <h4>All Requests</h4>
                <small class="text-muted">Status/History</small>
            </div> 
            <div class="col-6 d-flex justify-content-end align-items-center">
                <span class="material-symbols-outlined sz-60">recent_actors</span>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <hr style="margin: 10px; width:90%;">
            </div>
            {{-- <div class="col-lg-12 profile-content px-4 bg-white py-2 rounded">  
                <div class="col-lg-12 profile-content px-4 py-2 empty-container d-flex align-items-center justify-content-center">
                    <img src="{{ url('import\assets\images\contents\empty.png') }}" class="w-50">
                </div>
                <div class="col-lg-12 text-center">
                    <h5 class="text-muted">No Pending Requests at the moment.</h5>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <small class="text-muted f">You can check your requests here. Click the button to expand. </small>
            </div>
            <div class="col-lg-12 profile-content px-lg-4 px-0 py-2 bg-white rounded"> 
                <div class="row m-0 border-bottom pb-1 mb-1">
                    <div class="col-6 d-flex align-items-center p-2 ">
                        <h5>Inclusion Requests</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end p-2 ">
                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#incRequestsCollapse" aria-expanded="false" aria-controls="collapseExample">
                            <span class="material-symbols-outlined">
                                expand_more
                                </span>
                          </button>
                    </div>
                </div>
                @if ($submissionPublications->count() === 0)
                <div class="no-downloads text-center bg-light p-5 collapse" id="incRequestsCollapse">
                    <h6>
                        <small class="text-muted font-netflix-md">No Pending Requests at the moment.</small>
                    </h6>
                    <small class="text-muted font-netflix">You can send a request 
                        <a href="{{ url('/submission-publication') }}"> here</a>
                    </small>
                </div>
                @else
                <div class="inclusion-requests-container collapse" id="incRequestsCollapse">
                    @foreach ($submissionPublications as $request) 
                    <div class="row bg-light p-2 m-1">
                        <div class="col-lg-9 no-padding">
                            <small class="text-muted font-netflix-md">
                                Created at {{date('M d, Y • h:i A', strtotime($request->created_at))}}
                            </small>
                            <div class="px-2 py-1">
                                <h6 class="h6-m-0">{{$request->submission_publication_title}}</h6>
                                <small class="text-muted font-netflix">{{$request->submission_publication_author}}</small>
                                <br>
                                <small class="text-muted font-netflix-light">{{$request->submission_publication_contributor}}</small>
                            </div>
                        </div>
                        <div class="col-lg-3 no-padding d-flex justify-content-lg-end align-items-center">
                            <div class="px-2 py-1 text-light font-netflix">
                                @if($request->submission_publication_status === 'Approved')
                                <small class="bg-outline-success p-2 rounded">
                                    {{$request->submission_publication_status}}
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                </small>
                                @elseif($request->submission_publication_status === 'Rejected')
                                <small class="bg-outline-danger p-2 rounded">
                                    {{$request->submission_publication_status}}
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </small>  
                                @else
                                <small class="bg-outline-warning p-2 rounded">
                                    {{$request->submission_publication_status}}
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col-lg-12 profile-content px-lg-4 px-0 py-2 bg-white rounded"> 
                <div class="row m-0 border-bottom pb-1 mb-1">
                    <div class="col-6 d-flex align-items-center p-2 ">
                        <div>
                            <h5>Service Requests</h5>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end p-2 ">
                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#servRequestsCollapse" aria-expanded="false" aria-controls="collapseExample">
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                          </button>
                    </div>
                </div>
                @if ($serviceRequests->count() === 0)
                <div class="no-requests text-center bg-light p-5 collapse" id="servRequestsCollapse">
                    <h6>
                        <small class="text-muted font-netflix-md">No Pending Requests at the moment.</small>
                    </h6>
                    <small class="text-muted font-netflix">You can send a request 
                        <a href="{{ url('/service-request') }}"> here</a>
                    </small>
                </div>
                @else
                <div class="service-requests-container collapse" id="servRequestsCollapse">
                    @foreach ($serviceRequests as $service) 
                    <div class="row bg-light p-2 m-1">
                        <div class="col-lg-9 no-padding">
                            <small class="text-muted font-netflix-md">
                                Created at {{date('M d, Y • h:i A', strtotime($service->created_at))}}
                            </small>
                            <div class="px-2 py-1">
                                @if($service->service_request_type === 'Training/Workshop')
                                    <h6 class="h6-m-0">{{$service->service_request_training_topic}}</h6>
                                @elseif($service->service_request_type === 'Data Analytics')
                                    <h6 class="h6-m-0">{{$service->service_request_analysis}}</h6>
                                @elseif($service->service_request_type === 'Technical Assistance')
                                    <h6 class="h6-m-0">{{$service->service_request_software}}</h6>
                                @else
                                    <h6 class="h6-m-0">{{$service->service_request_type}}</h6>
                                @endif
                                <small class="text-muted font-netflix">{{$service->service_request_type}}</small>
                                <br>
                                <small class="text-info font-netflix-light text-xs">Check <strong>email</strong> for info.</small>
                            </div>
                        </div>
                        <div class="col-lg-3 no-padding d-flex justify-content-lg-end align-items-center">
                            <div class="px-2 py-1 text-light font-netflix">
                                @if($service->service_request_status === 'Approved')
                                <small class="bg-outline-success p-2 rounded">
                                    {{$service->service_request_status}}
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                </small>
                                @elseif($service->service_request_status === 'Rejected')
                                <small class="bg-outline-danger p-2 rounded">
                                    {{$service->service_request_status}}
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </small>  
                                @else
                                <small class="bg-outline-warning p-2 rounded">
                                    {{$service->service_request_status}}
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </small>
                    @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection