@extends('management.main_index')
@section('title','Service Requests')
@section('content')
<div class="row m-0 p-1 ">
  <div class="col-lg-12 px-0 pt-4">
    <div class="row m-0">
      <div class="col-md-6 dashboard-heading ">
        <input type="text" id="staff_role" value="{{  Auth::guard('staff')->user()->staff_role}}" hidden>
          <h3 class="my-1">
            SERVICE REQUESTS 
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
{{-- DATA ANALYTICS BARS --}}
<div class="row m-2 ">
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
                <h2 class="font-netflix-md m-0"><span id="totalRequests">{{$serviceRequests->count()+$serviceResponses->count()}}</span></h2>
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
                <h2 class="font-netflix-md m-0"><span id="totalPending">{{$serviceRequests->count()}}</span></h2>
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
                <h2 class="font-netflix-md m-0"><span id="totalApproved">{{$serviceResponseApproved->count()}}</span></h2>
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
                <h2 class="font-netflix-md m-0"><span id="totalRejected">{{$serviceResponseRejected->count()}}</span></h2>
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
{{-- INBOX FOR PENDING --}}
<div class="row px-1 pb-3 m-2">
  <div class="col-lg-8 px-0">
    <div class="px-lg-4 px-2 py-4 bg-white border rounded shadow-sm">
      <h5 class="font-netflix-md px-2 m-0">Inbox (<span id="totalPending">{{$serviceRequests->count()}}</span>) <i class="fa fa-envelope-o px-1"></i></h5>
      <small class="muted-notes px-2"> You can scroll down to view more pending requests.</small>
      <div class="requests-container rounded">
        @if ($serviceRequests->count() === 0)
        <div class="empty-history bg-light m-2 p-5 text-center text-muted rounded">
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
        @foreach ($serviceRequests as $request) 
        <a id="requestModalTrigger" href="" data-target="#requestModal" data-toggle="modal" class="no-decoration"
          data-id="{{$request->service_request_id}}"
          data-name="{{$request->user->fname." ".$request->user->lname}}"
          data-email="{{$request->user->email}}"
          data-title="{{$request->service_request_type}}"
          data-client="{{ $request->service_request_client}}"
          data-training="{{ $request->service_request_training_topic}}"
          data-analysis="{{ $request->service_request_analysis}}"
          data-software="{{ $request->service_request_software}}"
          data-agency="{{$request->service_request_agency}}"
          data-purpose="{{$request->service_request_reason}}"
          data-time="{{date('h:i a', strtotime($request->created_at))}}"
          data-contact="{{ $request->user->contact}}"
          data-agency-classification="{{ $request->service_request_agency_classification}}"
          data-survey-target="{{ $request->service_request_survey_target }}"
          data-coverage="{{ $request->service_request_survey_coverage }}"
          data-survey-description="{{ $request->service_request_survey_description }}"
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
                    <small class="font-netflix font-weight-bold">
                      {{$request->service_request_type}}
                    </small>
                    <small class="text-muted font-netflix-light clip-one-line">
                      {{$request->service_request_reason}}
                    </small>
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
        @if ($serviceResponses->count() === 0)
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
          @foreach($serviceResponses as $response)
            <a href="" data-toggle="collapse">
              <div class="log-item border-bottom px-3 py-2">
                <div class="row m-0">
                  <div class="col-6 p-0">
                    @if ($response->service->service_request_status == 'Rejected')
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
                    <small class="font-netflix-md">{{date('m/d/Y',strtotime($response->created_at))}}</small>
                  </div>
                  <div class="col-12 px-2">
                    <small class="font-netflix-md">{{$response->service->user->fname." ".$response->service->user->lname}}</small>
                  </div>
                  <div class="col-12 px-2">
                    <small class="font-netflix">{{$response->service->service_request_type}} - </small>
                    <small class="font-netflix-light">
                      @if($response->service->service_request_type === 'Training/Workshop')
                      {{$response->service->service_request_training_topic}}
                      @elseif($response->service->service_request_type === 'Data Analytics')
                      {{$response->service->service_request_analysis}}
                      @elseif($response->service->service_request_type === 'Technical Assistance')
                      {{$response->service->service_request_software}}
                      @else
                      {{$response->service->service_request_type}}
                      @endif</small>
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
</div>
<!-- PREVIEW MODAL -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header pt-4 pl-4 bg-main text-light">
        <h5 class="admin-modal-title" id="modelTitle">Service Request</h5>
          <button type="button" class="close btn btn-sm" id="btnHiderequest">
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
              <h4 class="font-netflix-md mb-0" id="preview-title"></h4>
              <small class="text-muted"></small>
              <div class="py-2">
                <table>
                  <tr>
                    <td>
                      <small class="font-netflix-md"> Type </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-type"> </small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <small class="font-netflix-md"> Agency </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-agency"> </small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <small class="font-netflix-md"> Classification </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-agency-classification"> </small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <small class="font-netflix-md"> Type of Client </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-client-type"> </small>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <small class="font-netflix-md"> Contact </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-contact"> </small>
                    </td>
                  </tr>
                  <tr class="preview-survey-info">
                    <td>
                      <small class="font-netflix-md"> Survey target </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-survey-target"> </small>
                    </td>
                  </tr>
                  <tr class="preview-survey-info">
                    <td>
                      <small class="font-netflix-md"> Area of Coverage </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-survey-coverage"> </small>
                    </td>
                  </tr>
                  <tr class="preview-survey-info">
                    <td>
                      <small class="font-netflix-md"> Description of Survey </small>
                    </td>
                    <td>
                      <small class="font-netflix-light px-3" id="preview-survey-description"> </small>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="py-1 text-justify">
                <small class="font-netflix-md">Purpose & reason for request</small>
                <p>
                  <small class="font-netflix-light"  id="preview-purpose"> </small>
                </p>
              </div>
            </div>
          </div>
          <div class="row p-3 border-top mt-4">
            <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
              <button type="button" class="btn btn-success mx-1" id="btnApprove" data-toggle="modal" data-target="#review" data-dismiss="modal">Approve</button>
              <button type="button" class="btn btn-danger mx-1" id="btnReject" data-toggle="modal" data-target="#review" data-dismiss="modal" >Reject</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pt-4 pl-4 bg-main text-light">
              <h5 class="admin-modal-title" id="modelTitle">Review Requests</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="material-symbols-outlined pr-2 pt-1 text-light">
                    cancel
                  </span>
                </button>
            </div>
            <div class="modal-body pt-4 px-4 no-padding">
              <div class="container-fluid no-padding">
                <form action="" id="approveResponse">
                  <div class="row m-0 px-2 py-3 border rounded">
                    <div class="col-lg-12 px-0 font-netflix">
                      <div class="alert alert-success" role="alert">
                        You're about to <strong>accept</strong> this request!
                      </div>
                    </div>
                    <div class="modal-body p-0">
                      <small class="font-netflix px-2"> Please provide the details for the meeting.  </small>
                      <div class="form-group pt-3 mx-3" id="approveForm">
                        <small class="font-netflix-md"> Would you like to schedule a meeting?<small class="text-danger">*</small> </small>
                        <div id="radioGroup" class="row m-0 p-2">
                          <div class="col-lg-6">
                            <input id="radio" type="radio" name="choice" value="withMeeting" class="form-check-input">
                            <label> Yes </label>
                          </div>
                          <div class="col-lg-6">
                            <input type="radio" name="choice" value="noMeeting" class="form-check-input">
                            <label> No </label>
                          </div>
                        </div>
                        <div class="form-group" id="withMeeting">
                            <div class="form-group" id="meeting">
                              <div class="coolselect">
                                <label for="" class="select-label">Meeting Type<small class="text-danger">*</small></label>
                                <select name="service_response_meeting_type" id="meetingType" class="select">
                                    <option value="" selected disabled>- Select -</option>
                                    <option value="Online Meeting">Online Meeting</option>
                                    <option value="Face-to-Face Meeting">Face-to-Face Meeting</option>
                                </select>
                              </div>
                            </div>
                            <div id="formMeeting">
                                <div class="form-group">
                                  <div class="coolinput">
                                    <label for="" class="text">Schedule of Meeting<small class="text-danger">*</small></label>
                                    <input name="service_response_meeting_time" type="datetime-local" id="meeting_schedule" class="input border rounded p-2" placeholder=" Time and Date ">
                                  </div>
                                </div>
                                <div class="form-group" id="f2f_place">
                                  <div class="coolinput">
                                    <label for="" class="text">Venue of Meeting<small class="text-danger">*</small></label>
                                    <input name="service_response_meeting_place" type="text" id="f2f_venue" class="input" placeholder=" Meeting place ">
                                  </div>
                                </div>
                                <div class="form-group" id="online_link">
                                  <div class="coolinput">
                                    <label for="" class="text">Online Meeting Link<small class="text-danger">*</small></label>
                                    <input name="service_response_meeting_link" type="text" id="service_response_meeting_link" class="input" placeholder=" Insert link here ">
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="cooltextarea px-3">
                          <label for="" class="textarea-label px-2">Remarks<small class="text-danger">*</small></label>
                          <textarea name="service_response_remark_approve" id="service_response_remark_approve" cols="30" rows="3" class="textarea" required></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row p-3 border-top mt-4">
                    <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                      <button type="submit" class="btn btn-success" id="btnApproveProceed" data-id="">Proceed</button>
                    </div>
                  </div>
                </form>
              </div>
                <div class="container-fluid no-padding">
                  <form action="" id="rejectResponse">
                    <div class="row m-0 px-2 py-3 border rounded">
                      <div class="col-lg-12 px-0 font-netflix">
                        <div class="alert alert-warning" role="alert">
                          You're about to <strong>reject</strong> this request!
                        </div>
                      </div>
                      <div class="modal-body p-0">
                        <small class="font-netflix px-2"> Please provide the reason for rejection.  </small>
                        <div class="cooltextarea px-3">
                          <label for="" class="textarea-label px-2">Remarks<small class="text-danger">*</small></label>
                          <textarea name="service_response_remark_reject" id="service_response_remark_reject" cols="30" rows="4" class="textarea" required></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row p-3 border-top mt-4">
                      <div class="col-lg-12 d-flex align-items-center justify-content-end no-padding">
                        <button type="submit" class="btn btn-secondary mx-1" id="btnRejectProceed" data-id="">Proceed</button>
                        <button type="button" class="btn btn-danger mx-1" data-target="#requestModal" data-toggle="modal" id="btnResetRemarks" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
                {{-- <form action="" id="rejectResponse">
                    <div class="form-group">
                      <div class="cooltextarea">
                        <label for="" class="textarea-label px-2">Remarks</label>
                        <textarea name="service_response_remark_reject" id="service_response_remark_reject" cols="30" rows="3" class="textarea" required></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" id="btnRejectProceed">Proceed</button>
                    </div>
                </form> --}}
            </div>
            {{-- <div class="modal-footer">
                <form id="approve" action="" method="post">
                    @csrf
                    <button id="btnApprove" type="submit" class="btn btn-primary" data-id="{{$request->service_request_id}}">
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                    </button>
                </form>
                <form id="reject" action="" method="post" >
                    @csrf
                    <button id="btnReject" type="submit" class="btn btn-danger" data-id="{{$request->service_request_id}}">
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </button>
                </form>
            </div> --}}
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

    $('#btnHiderequest').click(function (e) { 
        $('#requestModal').modal('hide');
    });
    
    if($('#staff_role').val() === 'Service Staff' ){
      var staffRole = 'serv';
          // SHOW LIST OF STAFFS TABLE
    }else{
      var staffRole = 'admin';
    }

    var element = document.getElementById("preview-name");
    var text = element.textContent;

    var firstLetter = text.charAt(0);
    $('#round-initials').html(firstLetter);

    
    $('.preview-survey-info').hide();
    
    $('body').on('click', '#requestModalTrigger', function (e) {
      e.preventDefault();
      $('#service_response_remark_reject').val('');
      // var type = $(this).data('type'); 
      
      $('#btnApproveProceed').attr('data-id', $(this).data('id'));
      $('#btnRejectProceed').attr('data-id', $(this).data('id'));
      $('#preview-agency-classification').html($(this).data('agency-classification'));
      $('#preview-name').html($(this).data('name'));
      $('#preview-email').html($(this).data('email'));
      $('#preview-time').html($(this).data('time'));
      $('#preview-title').html($(this).data('title'));
      $('#preview-contact').html($(this).data('contact'));
      $('#preview-client-type').html($(this).data('client'));
      $('#preview-purpose').html($(this).data('purpose'));
      $('#preview-date').html($(this).data('date'));
      $('#preview-agency').html($(this).data('agency'));
      if($(this).data('title') == 'Training/Workshop'){
          $('#preview-type').html($(this).data('training'));
      }else if($(this).data('title') == 'Data Analytics'){
        $('#preview-type').html($(this).data('analysis'));
      }else if($(this).data('title') == 'Technical Assistance/Consultancy'){
        $('#preview-type').html($(this).data('software'));
      }else{
        $('#preview-type').html($(this).data('title'));
      }
      if($(this).data('title') == 'Survey Services'){
        $('#preview-survey-target').html($(this).data('survey-target'));
        $('#preview-survey-coverage').html($(this).data('coverage'));
        $('#preview-survey-description').html($(this).data('survey-description'));
        $('.preview-survey-info').show();
      }else{
        $('.preview-survey-info').hide();
      }

      
    var element = document.getElementById("preview-name");
    var text = element.textContent;

    var firstLetter = text.charAt(0);

      $('#round-initials').html(firstLetter);

    });

    $('#onlineMeeting').hide();
    $('#f2fMeeting').hide();
    $('#meeting').hide();
    $('#f2f_place').hide();
    $('#online_link').hide();
    $('.radio').removeAttr('required');
    
    $('body').on('click', '#btnApprove', function(e){
        $('#approveResponse').trigger('reset');
        $('#rejectResponse').hide();
        $('#withMeeting').hide();
        $('#radio').attr('required', true);
        $('#approveResponse').show();
        // $('#review').modal('show');
    });

    $('body').on('click', '#btnReject',function(e){
        $('#serviceResponse').trigger('reset');
        $('#withMeeting').hide();
        $('#approveResponse').hide();
        $('#radio').removeAttr('required');
        $('#rejectResponse').show();
        // $('#review').modal('show');
    });

    $('#radioGroup input[type="radio"]').on('change', function (e){
        if($(this).val() === 'noMeeting'){
            $('#f2f_venue').removeAttr('required');
            $('#meeting_schedule').removeAttr('required');
            $('#service_response_meeting_link').removeAttr('required');
            $('#meetingType').removeAttr('required');
            $('#withMeeting').hide();
            $('#formMeeting').hide();
            $('#f2f_place').hide();
            $('#online_link').hide();
            $('#meeting').hide();
            
        }else{
            $('#meetingType').attr('required', true);
            $('#withMeeting').show();
            $('#formMeeting').show();
            $('#meeting').show();
            
        }
    });

    $('#meetingType').on('change', function (e){
        if($(this).val() === 'Face-to-Face Meeting'){
            $('#formMeeting').show();
            $('#f2f_place').show();
            $('#online_link').hide();
            $('#service_response_meeting_link').removeAttr('required');
            $('#meeting_schedule').attr('required', true);
            $('#f2f_venue').attr('required', true);
        }else if($(this).val() === 'Online Meeting'){
            $('#formMeeting').show();
            $('#f2f_place').hide();
            $('#online_link').show();
            $('#f2f_venue').removeAttr('required');
            $('#meeting_schedule').attr('required', true);
            $('#service_response_meeting_link').attr('required', true);
        }else{
            $('#formMeeting').hide();
            $('#f2f_place').hide();
            $('#online_link').hide();
            $('#meeting_schedule').removeAttr('required');
            $('#f2f_venue').removeAttr('required');
            $('#service_response_meeting_link').removeAttr('required');
        }
    });

    $('body').on('submit','#approveResponse', function(e){
        e.preventDefault();
        
        var req_id = $('#btnRejectProceed').data('id');
        var type = $('#emeetingType').val();
        var time = $('#meeting_schdule').val();
        var place = $('#f2f_venue').val();
        var link = $('#online_link').val();
        var remark = $('#service_response_remark_approve').val(); 
        swal({
            title: "Approve this request?",
            text: "Once approved, the system will notify the user with the approval details.",
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
                    url: '/'+ staffRole +'/services/requests/approve/id='+req_id,
                    data: {
                        'service_response_request_id': req_id,
                        'service_response_meeting_type':type,
                        'service_response_meeting_time':time,
                        'service_response_meeting_place':place,
                        'service_response_meeting_link':link,
                        'service_response_remark':remark,
                    },
                    success: function (result) {
                        Swal.close();
                        console.log(result);
                        swal("Request has been approved!", {
                                icon: "success",
                        });
                        location.reload();
                            
                    },
                    error: function (result) {
                        Swal.close();
                        console.error(result);
                    }
                })
                        
            } 
        });

    });
    
    $('body').on('submit','#rejectResponse', function(e){
        e.preventDefault();
        var req_id = $('#btnRejectProceed').data('id');
        var remark = $('#service_response_remark_reject').val();
        swal({
            title: "Reject this request?",
            text: "Once rejected, you can't change it back.",
            icon: "warning",
            buttons: true,
        })
        .then((willReject) => {
            if (willReject) {
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
                    url: '/'+ staffRole +'/services/requests/reject/id='+req_id,
                    data: {
                        'service_response_request_id': req_id,
                        'service_response_remark':remark,
                    },
                    success: function (result) {
                        Swal.close();
                        location.reload();
                        swal("Request has been rejected!", {
                            icon: "info",
                        });
                        console.log(result);
                    },
                    error: function (result) {
                        Swal.close();
                        console.error(result);
                    }
                })
                        
            } 
        });

    });
    

});

</script>
@endsection