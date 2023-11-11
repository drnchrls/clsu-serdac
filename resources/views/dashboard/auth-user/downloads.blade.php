@extends('dashboard.auth-user.dashboard')
@section('title', 'Downloads')
@section('account-content')
    <div class="col-lg-9">
        <div class="row dashboard-pane p-4 bg-white rounded">
            <div class="col-6 header text-left">
                <h4>Downloads</h4>
                <small class="text-muted">History</small>
            </div> 
            <div class="col-6 d-flex justify-content-end align-items-center">
                <span class="material-symbols-outlined sz-60">download</span>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <hr style="margin: 10px; width:90%;">
            </div>
            <div class="col-lg-12">
                <small class="text-muted">You can check your past downloads here. Click the button to expand.</small>
            </div>
            <div class="col-lg-12 profile-content px-lg-4 px-0 py-2 rounded">
                <div class="row m-0 border-bottom pb-1 mb-1">
                    <div class="col-6 d-flex align-items-center p-2 ">
                        <h5>Publications</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end p-2 ">
                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#publicationCollapse" aria-expanded="false" aria-controls="collapseExample">
                            <span class="material-symbols-outlined">
                                expand_more
                                </span>
                          </button>
                    </div>
                </div>
                @if ($downloadPublications->count() === 0)
                <div class="no-downloads text-center bg-light p-5 collapse" id="publicationCollapse">
                    <h6>
                        <small class="text-muted font-netflix-md">You haven't downloaded any yet.</small>
                    </h6>
                    <small class="text-muted font-netflix">Check our library
                        <a href="{{ url('/publications') }}"> here</a>
                    </small>
                </div>
                @else
                <div class="downloads-container px-4 collapse" id="publicationCollapse">
                    @foreach ($downloadPublications as $downloadPublication)
                    <a href="{{ url(( '/pub_id='.$downloadPublication->download_publication_id)) }}">
                        <div class="card card-body row bg-light p-2 rounded border">
                            <div class="col-12 d-flex no-padding d-flex align-items-center">
                                <span class="material-symbols-outlined sz-40-dl">
                                    draft
                                </span>
                                <div class="p-2">
                                    <h6 class="font-netflix"> {{$downloadPublication->download_publication_title}}
                                    </h6>   
                                    <span class="text-muted">{{ date('h:i A • M d, Y', strtotime($downloadPublication->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach 
                </div>
                @endif
            </div>
            <div class="col-lg-12 profile-content px-lg-4 px-0 py-2 rounded">
                <div class="row m-0 border-bottom pb-1 mb-1">
                    <div class="col-6 d-flex align-items-center p-2 ">
                        <h5>Datasets</h5>
                    </div>
                    <div class="col-6 d-flex justify-content-end p-2 ">
                        <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#datasetCollapse" aria-expanded="false" aria-controls="collapseExample">
                            <span class="material-symbols-outlined">
                                expand_more
                                </span>
                          </button>
                    </div>
                </div>
                @if ($downloadDatasets->count() === 0)
                <div class="no-downloads text-center bg-light p-5 collapse" id="datasetCollapse">
                    <h6>
                        <small class="text-muted font-netflix-md">You haven't downloaded any yet.</small>
                    </h6>
                    <small class="text-muted font-netflix">Check our datasets
                        <a href="{{ url('/datasets') }}"> here</a>
                    </small>
                </div>
                @else
                <div class="downloads-container px-4 collapse" id="datasetCollapse">
                    @foreach ($downloadDatasets as $downloadDataset)
                    <a href="{{ url(( '/dataset_id='.$downloadDataset->download_dataset_id)) }}">
                        <div class="row my-2 bg-light p-2 rounded border">
                            <div class="col-12 d-flex no-padding d-flex align-items-center">
                                <span class="material-symbols-outlined sz-40-dl">
                                    draft
                                </span>
                                    <div class="p-2">
                                        <h6 class="font-netflix"> {{$downloadDataset->download_dataset_title}}
                                        </h6>   
                                    <span class="text-muted">{{ date('h:i A • M d, Y', strtotime($downloadDataset->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach  
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection