@extends('management.main_index')
@section('title','Inclusion Requests')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <input type="text" id="staff_role" value="{{  Auth::guard('staff')->user()->staff_role}}" hidden>
        <h3 class="my-1">
          Publication Request 
        </h3>
        <small class="muted-notes"> You can view users requests details by clicking it. </small>
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
  {{-- <div class="col-lg-12 px-0 py-2">
    <div class="d-flex justify-content-start">
      <div class="px-2">
        <button type="button" class="btn btn-secondary">
          Total
        </button>
      </div>
      <div class="px-2">
        <form action="">
          <select name="" id="month" class="form-control">
            <option value="{{date('n', strtotime(now()))}}" selected>Month</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
        </form>
      </div>
      <div class="px-2">
        <form action="">
          <select name="" id="year" class="form-control">
            <option value="{{date('n', strtotime(now()))}}" selected>Year</option>
            @foreach ($years as $year)
              <option value="{{$year->year}}">{{$year->year}}</option>
            @endforeach

          </select>
        </form>
      </div>
    </div>
  </div> --}}
  <div class="col-lg-3 col-md-6 col-12 px-0">
    <div class="total_received rounded px-4 py-3 m-1 border shadow-sm">
      <div class="row m-0">
        <div class="col-12 px-0 d-flex pb-3">
        </div>
        <div class="col-12 d-flex p-0">
          <div class="p-3 border text-gradient-info rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              stacked_email
            </span>
          </div>
          <div class="col p-0 d-flex align-items-center">
            <div class="row m-0">
              <div class="col-12 px-3">
                <h2 class="font-netflix-md m-0"><span id="totalRequests">{{$requests->count()+$requestLogs->count()}}</span></h2>
              </div>
              <div class="col-12 pl-3">
                <small class="text-muted"> Total Requests</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12 px-0">
    <div class="total_received rounded px-4 py-3 m-1 border shadow-sm">
      <div class="row m-0">
        <div class="col-12 px-0 d-flex pb-3">
        </div>
        <div class="col-12 d-flex p-0">
          <div class="p-3 border text-gradient-warning rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              forward_to_inbox
            </span>
          </div>
          <div class="col p-0 d-flex align-items-center">
            <div class="row m-0">
              <div class="col-12 px-3">
                <h2 class="font-netflix-md m-0"><span id="totalPending">{{$requests->count()}}</span></h2>
              </div>
              <div class="col-12 pl-3">
                <small class="text-muted"> Total Pending</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12 px-0">
    <div class="total_received rounded px-4 py-3 m-1 border shadow-sm">
      <div class="row m-0">
        <div class="col-12 px-0 d-flex pb-3">
        </div>
        <div class="col-12 d-flex p-0">
          <div class="p-3 border text-gradient-success rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              notification_multiple
            </span>
          </div>
          <div class="col p-0 d-flex align-items-center">
            <div class="row m-0">
              <div class="col-12 px-3">
                <h2 class="font-netflix-md m-0"><span id="totalApproved">{{$requestLogsApproved->count()}}</span></h2>
              </div>
              <div class="col-12 pl-3">
                <small class="text-muted"> Total Approved</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-12 px-0">
    <div class="total_received rounded px-4 py-3 m-1 border shadow-sm">
      <div class="row m-0">
        <div class="col-12 px-0 d-flex pb-3">
        </div>
        <div class="col-12 d-flex p-0">
          <div class="p-3 border text-gradient-danger rounded d-flex align-items-center ">
            <span class="material-symbols-outlined sz-35">
              unsubscribe
            </span>
          </div>
          <div class="col p-0 d-flex align-items-center">
            <div class="row m-0">
              <div class="col-12 px-3">
                <h2 class="font-netflix-md m-0"><span id="totalRejected">{{$requestLogsRejected->count()}}</span></h2>
              </div>
              <div class="col-12 pl-3">
                <small class="text-muted"> Total Rejected </small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row px-1 pb-3 m-2">
  <div class="col-lg-8 px-0">
    <div class="px-lg-4 px-2 py-4 bg-white border rounded shadow-sm">
      <h5 class="font-netflix-md px-2 m-0">Inbox (<span id="totalRequests">{{$requests->count()}}</span>) <i class="fa fa-envelope-o px-1"></i></h5>
      <small class="muted-notes px-2"> You can scroll down to view more pending requests.</small>
      <div class="requests-container rounded">
        @if ($requests->count() === 0)
        <div class="empty-history m-2 bg-light p-5 text-center text-muted rounded">
          <div class="p-2">
            <span class="material-symbols-outlined sz-50">
              package_2
            </span>
          </div>
          <small class="text-uppercase font-netflix-md">
            Nothing to see here
          </small>
        </div>
        @else
        @foreach ($requests as $request) 
        <a id="inclusionModalTrigger" href="" data-target="#inclusionModal" data-toggle="modal" class="no-decoration"
          data-id="{{$request->submission_publication_id}}"
          data-name="{{$request->user->fname." ".$request->user->lname}}"
          data-email="{{$request->user->email}}"
          data-title="{{$request->submission_publication_title}}"
          data-type="{{$request->submission_publication_type}}"
          data-author="{{$request->submission_publication_author}}"
          data-description="{{$request->submission_publication_description}}"
          data-contributor="{{$request->submission_publication_contributor}}"
          data-volume="{{$request->submission_publication_volume}}"
          data-issue="{{$request->submission_publication_issue}}"
          data-time="{{date('h:i a', strtotime($request->created_at))}}"
          data-date="{{$request->submission_publication_date}}"
          data-file="{{$request->submission_publication_file}}"
          data-path="{{$request->submission_publication_file_path}}"
          data-publisher="{{ $request->submission_publication_publisher }}"
          data-doi="{{ $request->submission_publication_doi }}"
          data-theme="{{ $request->submission_publication_theme }}"
        >
          <div class="row text-dark bg-light requests-item m-1 pending-border">
            <div class="d-flex col-12 pr-lg-3 pl-lg-0 py-3">
              <div class="d-flex align-items-center justify-content-center">
                <span class="material-symbols-outlined p-3 sz-30 dismissible-material">
                  mark_email_unread
                </span>
              </div>
              <div class="col p-0">
                <div class="row m-0">
                  <div class="col-8 p-0">
                    <h6 class="m-0 font-netflix-md">{{$request->user->fname." ".$request->user->lname}}</h6>
                  </div>
                  <div class="col-4 p-0 d-flex justify-content-end">
                    <small class="font-netflix-md text-xs">{{ date('M d', strtotime($request->created_at)) }}</small>
                  </div>
                </div>
                <div class="row m-0">
                  <div class="col-lg-12 p-0">
                    <small class="font-netflix font-weight-bold">{{$request->submission_publication_title}}</small><br>
                    <small class="text-muted font-netflix-light clip-one-line">{{$request->submission_publication_description}}</small>
                    {{-- <div class="my-1">
                      <small class="text-light bg-outline-warning rounded px-2 py-1 font-netflix"> Pending <i class="fa fa-clock-o px-1"></i> </small>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </a>
        @endforeach
        @endif
        {{-- <div class="text-center py-3">
          <small class="text-muted font-netflix"> You've reached the bottom.</small>
        </div> --}}
      </div>
    </div>
  </div>
  <div class="col-lg-4 px-0">
    <div class=" ml-lg-2 ml-md-0 my-lg-0 ml-0 my-2 px-lg-4 px-2 py-4 bg-white border rounded shadow-sm">
      <h5 class="font-netflix-md px-2 m-0"> Requests Logs </h5>
      <small class="muted-notes px-2"> You can see completed requests here.</small>
      <div class="logs-container">
        @if ($requestLogs->count() === 0)
        <div class="empty-history bg-light p-5 m-2 text-center text-muted rounded">
          <div class="p-2">
            <span class="material-symbols-outlined sz-50">
              package_2
            </span>
          </div>
          <small class="text-uppercase font-netflix-md">
            Nothing to see here
          </small>
        </div> 
        @else
        <div class="history-logs p-2">
          @foreach($requestLogs as $request)
            <a href="#remarksCollapseId{{ $request->submission_response_id }}" data-toggle="collapse">
              <div class="log-item border-bottom px-3 py-2">
                <div class="row m-0">
                  <div class="col-6 p-0">
                    @if ($request->submission->submission_publication_status == 'Rejected')
                      <span class="rounded text-danger">
                        <small class="text-xs"><i class="fa fa-times-circle"></i> Rejected
                        </small>
                      </span>
                    @else
                      <span class="rounded text-success">
                        <small><i class="fa fa-check-circle"></i> Approved </small>
                      </span>
                    @endif
                  </div>
                  <div class="col-6 p-0 text-right">
                    <small class="font-netflix-md">{{date('m/d/Y',strtotime($request->created_at))}}</small>
                  </div>
                  <div class="col-12 px-2 py-1">
                    <small class="font-netflix-md">"{{$request->submission->submission_publication_title}}"</small>
                  </div>
                </div>
                <div class="collapse px-2" id="remarksCollapseId{{ $request->submission_response_id }}">
                  <small class="text-muted"> {{$request->submission_response_remark }} </small>
                </div>
              </div>
            </a>
          @endforeach
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
<!-- REJECT MODAL -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header pt-4 pl-4 bg-main text-light">
        <h5 class="admin-modal-title">Reject this file?</h5>
        <button type="button" class="close btn btn-sm" id="btnHidereject">
          <span class="material-symbols-outlined pr-2 pt-1 text-light">
            cancel
          </span>
        </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          <form action="" id="remarksForm">
            @csrf
            <div class="row m-0 px-2 py-3 border rounded">
              <div class="col-lg-12 px-0 font-netflix">
                <div class="alert alert-warning" role="alert">
                  You're about to <strong>reject</strong> this request!
                </div>
              </div>
              <div class="modal-body p-0">
                <small class="font-netflix px-2"> Please provide the reason for rejection.  </small>
                <div class="cooltextarea px-3">
                  <label for="submission_response_remark" class="textarea-label px-2">Remarks<small class="text-danger">*</small></label>
                  <textarea name="submission_response_remark" id="submission_response_remark" class="textarea" cols="30" rows="4" required></textarea>
                </div>
              </div>
            </div>
            <div class="row p-3 border-top mt-4">
              <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                <button type="submit" class="btn btn-secondary mx-1" id="btnRejectProceed" >Proceed</button>
                <button type="button" class="btn btn-danger mx-1" data-target="#inclusionModal" data-toggle="modal" id="btnResetRemarks" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- PREVIEW MODAL -->
<div class="modal fade" id="inclusionModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header pt-4 pl-4 bg-main text-light">
        <h5 class="admin-modal-title" id="modelTitle">Inclusion Request</h5>
          <button type="button" class="close btn btn-sm" id="btnHideinclusion">
            <span class="material-symbols-outlined pr-2 pt-1 text-light">
              cancel
            </span>
          </button>
      </div>
      <div class="modal-body pt-4 px-4 no-padding">
        <div class="container-fluid no-padding">
          <div class="row m-0 px-2 py-3 border rounded">
            <div class="col-12 d-flex px-lg-2 px-1">
              <div class="d-flex align-items-center justify-content-center">
                <div class="round p-4 d-flex align-items-center justify-content-center font-netflix-md">
                  <small id="round-initials"></small>
                </div>
              </div>
              <div class="col d-flex align-items-center px-0">
                <div class="col-12 px-1">
                  <div class="row m-0">
                    <div class="col-lg-10 col-12 pl-2">
                      <h6 class="m-0 font-netflix" id="preview-name"></h6>
                      <small class="text-muted font-netflix-light" id="preview-email"></small>
                    </div>
                    <div class="col-lg-2 pl-2">
                      <small class="text-muted font-netflix-light text-xs d-lg-flex justify-content-end" id="preview-time"></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 p-3">
              <h4 class="font-netflix-md" id="preview-title"></h4>
              <table>
                <tr>
                  <td>
                    <small class="font-netflix-md">Type </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-type"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md"> Theme </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-theme"></small>
                  </td>
                </tr>
                <tr class="preview-journal">
                  <td>
                    <small class="font-netflix-md">Volume </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-volume"></small>
                  </td>
                </tr>
                <tr class="preview-journal">
                  <td>
                    <small class="font-netflix-md">Issue </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-issue"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md">Author </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-author"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md">Publisher </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-publisher"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md">Contributor </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-contributor"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md">Published on </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-date"></small>
                  </td>
                </tr>
                <tr>
                  <td>
                    <small class="font-netflix-md"> DOI </small>
                  </td>
                  <td>
                    <small class="font-netflix-light px-2" id="preview-doi"></small>
                  </td>
                </tr>
              </table>
              <div class="py-1 text-justify">
                <small class="font-netflix-md">Description</small>
                <p>
                  <small class="font-netflix-light"  id="preview-description">
                  
                  </small>
                </p>
              </div>
              <div>
                <small class="font-netflix-md">Attached File</small>
              </div>
              <div class="d-flex align-items-center">
                <span class="material-symbols-outlined">
                  attach_file
                </span>
                <small id="preview-file" class="clip-on"></small>
              </div>
              <div class="pt-1 text-lg-right">
                <small class="text-muted">
                  Click 
                  <a href="" id="preview-path" target="_blank">here</a>
                  to review the file.
                </small>
              </div>
            </div>
          </div>
          <div class="row p-3 border-top mt-4">
            <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
              <button type="button" class="btn btn-success mx-1" id="btnApprove">Approve</button>
              <button type="button" class="btn btn-danger mx-1" data-target="#rejectModal" data-toggle="modal" data-dismiss="modal">Reject</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function () {
    
    $.ajaxSetup({
    // Cross-Site Request Forgery - CSRF
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // CLOSE MODAL
    // $('.btn-cancel-announcement').click(function (e) { 
    //     $('#announcementModal').modal('hide');
    // });
    $('#btnHideinclusion').click(function (e) { 
        $('#inclusionModal').modal('hide');
    });
    $('#btnHidereject').click(function (e) { 
        $('#rejectModal').modal('hide');
    });

    if($('#staff_role').val() === 'Library Staff' ){
      var staffRole = 'libr';
          // SHOW LIST OF STAFFS TABLE
    }else{
      var staffRole = 'admin';
    }

    $('.preview-journal').hide();
    
    $('body').on('click', '#inclusionModalTrigger', function (e) {
      e.preventDefault();
      $('#submission_response_remark').val('');
      var type = $(this).data('type'); 
      var doi = $(this).data('doi');
      
      $('#btnApprove').attr('data-id',$(this).data('id'));
      $('#btnRejectProceed').attr('data-id',$(this).data('id'));
      $('#preview-name').html($(this).data('name'));
      $('#preview-email').html($(this).data('email'));
      $('#preview-time').html($(this).data('time'));
      $('#preview-title').html($(this).data('title'));
      $('#preview-theme').html($(this).data('theme'));
      $('#preview-publisher').html($(this).data('publisher'));
      if(doi == ''){
        $('#preview-doi').html('N/A');
      }
      else{
        $('#preview-doi').html($(this).data('doi'));
      }
      $('#preview-type').html(type);
      $('#preview-author').html($(this).data('author'));
      $('#preview-contributor').html($(this).data('contributor'));
      $('#preview-date').html($(this).data('date'));
      $('#preview-description').html($(this).data('description'));
      $('#preview-file').html($(this).data('file'));
      $('#preview-path').attr('href', $(this).data('path'));
      if(type == 'Journal/Journal Article'){
        $('#preview-volume').html($(this).data('volume'));
        $('#preview-issue').html($(this).data('issue'));
        $('.preview-journal').show();
      }else{
        $('.preview-journal').hide();
      }

      
    var element = document.getElementById("preview-name");
    var text = element.textContent;

    var firstLetter = text.charAt(0);

      $('#round-initials').html(firstLetter);

    });

    
    $('body').on('click', '#btnApprove', function(e){
        e.preventDefault();
        var req_id = $('#btnApprove').data('id');
        // var req = $(this).data('req');
        // var title = ;
        swal({
            title: "Are you sure?",
            text: "Once approved, file will be be available in e-library.",
            icon: "info",
            buttons: true,
        })
        .then((willApprove) => {
            if (willApprove) {
                Swal.fire({
                    title: 'Please wait...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: ()=>{
                        Swal.showLoading();
                    },
                });
                $.ajax({
                    type: "POST",
                    url: '/'+ staffRole +'/publications/requests/approve/id='+req_id,
                    data: {id:req_id},
                    success: function (result) {
                        Swal.close();
                        location.reload();
                            swal("Request has been approved!", {
                                icon: "success",
                            });
                        },
                    error: function (result) {
                        Swal.close();
                        console.log('Error: ', result);
                    }
                })
                        
            } 
        });

    });
    
    $('#remarksForm').on('submit', function(e){
        e.preventDefault();
        var req_id = $('#btnRejectProceed').data('id');
        // var req = $(this).data('req');
        // var title = ;
        var remark = $('#submission_response_remark').val();
        swal({
            title: "Are you sure?",
            text: "Once rejected, file will not store in e-library.",
            icon: "warning",
            buttons: true,
        })
        .then((willApprove) => {
            if (willApprove) {
                Swal.fire({
                    title: 'Please wait...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onOpen: ()=>{
                        Swal.showLoading();
                    },
                });
                $.ajax({
                    type: "POST",
                    url: '/'+ staffRole +'/publications/requests/reject/id='+req_id,
                    data: {
                      id:req_id,
                      submission_response_remark: remark,
                    },
                    success: function (result) {
                        Swal.close();
                        location.reload();
                            swal("Request has been rejected!", {
                                icon: "info",
                            });
                        },
                    error: function (result) {
                        Swal.close();
                        console.log('Error: ', result);
                    }
                })
                        
            } 
        });

    });
    
    $('body').on('click', '#btnResetRemarks', function () {
      $('#submission_response_remark').val('');
    });


});

</script>
@endsection