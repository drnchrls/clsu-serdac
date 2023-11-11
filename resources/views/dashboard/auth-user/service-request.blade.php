@extends('index.index')
@section('title', 'Service Request')
@section('web-content')
<section id="publications"></section>
{{-- <div class="row m-0 justify-content-center">
  <div class="col-lg-9 text-center">
    <div class="pub-page-header mt-5 px-2">
      <h2>Service Request</h2>
      <p>Researchers are most welcome to visit SERDAC for data analytics, 
        library resources and technical assistance. Books in agriculture, economics, statistics and related fields 
        are available for reading at SERDAC.</p>
        <center>
          <hr style="width: 50%;">
        </center>
    </div>
  </div>
</div> --}}
<div class="row mx-0 mt-2 py-4 px-lg-0 px-3 d-flex justify-content-center align-items-center bg-white shadow">
  <div class="col-lg-12 px-lg-5">
    <div class="row m-0 px-lg-5">
      <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-2">
          <img src="{{ url('import\assets\images\contents\services-png\service-form.png') }}" class="d-block w-100 service-form-image" alt="">
        </div>
        <div class="col-lg-10 py-2">
          <h1 class="font-netflix-md text-main m-0">Service Request Form</h1>
          <small class="text-muted font-netflix-light">To ensure we understand your request fully, kindly provide the requested information in the form below. Your input is important for us to assist you effectively.</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-10 border-top py-3 mt-1">
    <div class="service-form-container">
      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show">
       <span>Request submitted <strong>Successfully!</strong></span>
        <button type="button" class="close" data-dismiss="alert">
          <span> &times; </span>
        </button>
      </div>
      @endif
      <form action="{{route('service.request.store')}}" id="service-request-form" method="POST" autocomplete="off">
        @csrf
        <div class="service-form-header">
          <h4 class="font-netflix-md m-0">Personal Information </h4> 
          <small class="text-muted font-netflix-light px-1"> All fields are autofill.</small>
        </div>
        <div class="form-row">
          <div class="col-6">
            <div class="coolinput">
              <label for="service_request_fname" class="text">First Name</label>
              <input type="text" name="service_request_fname" id="service_request_fname" class="input no-drop" value="{{old('service_request_fname', Auth::user()->fname)}}" placeholder="Firstname" disabled>
            </div>
            @error('service_request_fname')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="col-6">
            <div class="coolinput">
              <label for="service_request_lname" class="text">Last Name</label>
              <input type="text" name="service_request_lname" id="service_request_lname" class="input no-drop" value="{{old('service_request_lname', Auth::user()->lname)}}" placeholder="Lastname" disabled>
            </div>
            @error('service_request_lname')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-6">
            <div class="coolinput">
              <label for="service_request_email" class="text">Email</label>
              <input type="email" name="service_request_email" id="service_request_email" class="input no-drop" value="{{old('service_request_email', Auth::user()->email)}}" placeholder="Email" disabled>
            </div>
            @error('service_request_email')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="col-6">
            <div class="coolinput">
              <label for="service_request_contact" class="text">Contact</label>
              <input type="text" name="service_request_contact" id="service_request_contact" class="input no-drop" value="{{old('service_request_contact', Auth::user()->contact)}}" placeholder="Contact" disabled>
            </div>
            @error('service_request_contact')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-row pt-3 pb-1">
          <div class="col-lg-12">
            <div class="service-form-header">
              <h4 class="font-netflix-md m-0">Request Information </h4> 
              <small class="text-muted font-netflix-light px-1 text-xs"> All fields with <span class="text-danger">*</span> are required</small>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="coolinput">
              <label for="service_request_agency" class="text">Office/Agency<span class="text-danger">*</span></label>
              <input type="text" name="service_request_agency" id="service_request_agency" class="input" value="{{old('service_request_agency')}}" placeholder="Office/Agency" required>
            </div>
            @error('service_request_agency')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="col-lg-6">
            <div class="coolselect">
              <label for="service_request_agency_classification" class="select-label">Agency Classification:<span class="text-danger">*</span></label>
              <select name="service_request_agency_classification" id="service_request_agency_classification" class="select" value="{{old('service_request_agency_classification')}}" required>
                <option value="" selected disabled>- Select -</option>
                <option value="Public">Public Agency</option>
                <option value="Private">Private Agency</option>
                <option value="Government Organization">Government Organization</option>
                <option value="Non-Government Organization">Non-Government Organization</option>
                <option value="University">University</option>
                <option value="Others">Others</option>
                </select>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-lg-6">
            <div class="coolselect">
              <label for="service_request_client" class="select-label">Type of Client:<span class="text-danger">*</span></label>
              <select name="service_request_client" id="service_request_client" class="select" value="{{old('service_request_client')}}" required>
                <option value="" selected disabled>- Select -</option>
                <option value="Student">Student</option>
                <option value="Faculty">Faculty</option>
                <option value="Government Employee">Government Employee</option>
                <option value="Researcher">Researcher</option>
                <option value="Development Worker">Development Worker</option> 
                <option value="Policy Maker">Policy Maker</option>
                <option value="Others">Others</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6" id="service_request_specific_client">
            <div class="coolinput">
              <label for="service_request_specific_client" class="text">Please Specify:<span class="text-danger">*</span></label>
              <input type="text" name="service_request_specific_client" id="service_request_specific_client" class="input" placeholder="If others, please specify the type...">
            </div>
            @error('service_request_client')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="col-lg-6">
            <div class="coolselect">
              <label for="service_request_type" class="select-label">Request for:<span class="text-danger">*</span></label>
              <select name="service_request_type" id="service_request_type" class="select" value="{{old('service_request_type')}}" required>
                <option value="" selected disabled>- Select -</option>
                <option value="Training/Workshop">Training/Workshop</option>
                <option value="Technical Assistance/Consultancy">Technical Assistance/Consultancy</option>
                <option value="Data Analytics">Data Analytics</option>
                <option value="Survey Services">Survey Services</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="coolselect" id="training">
              <label for="service_request_training_topic" class="select-label">Training topics<span class="text-danger">*</span></label>
              <select name="service_request_training_topic" id="service_request_training_topic" class="select">
                <option value="" selected disabled>- Select Training Topics -</option>
                <option value="Internsip">Internship</option>
                <option value="Descriptive Analysis">Descriptive Analysis</option>
                <option value="Financial Analysis">Financial Analysis</option>
                <option value="Productivity Analysis">Productivity Analysis</option>
                <option value="Profitability Analysis">Profitability Analysis</option>
                <option value="Technical Efficiency Analysis">Technical Efficiency Analysis</option>
                <option value="Benefit Cost Analysis">Benefit Cost Analysis</option>
                <option value="Correlation">Correlation (Test of Association)</option>
                <option value="Regression Analysis">Regression Analysis</option>
                <option value="Spatial Econometrics">Spatial Econometrics</option>
                <option value="Time Series Analysis">Time Series Analysis</option>
                <option value="Econometric Modelling">Econometric Modelling</option>
                <option value="Impact Assessment">Impact Assessment</option>
                <option value="Research Proposal Writing">Research Proposal Writing</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-lg-12 pt-3 pb-1" id="survey">
            <div class="service-header-form">
              <h4 class="font-netflix-md m-0">Survey Information<span class="text-danger">*</span></h4> 
              <small class="text-muted font-netflix-light px-1 text-xs"> All fields with <span class="text-danger">*</span> are required.</small>
            </div>
            <div class="form-row">
              <div class="col-lg-6">
                <div class="col-lg-12 px-0">
                  <div class="coolinput">
                    <label for="service_request_survey_target" class="text"> Target of Survey<span class="text-danger">*</span></label>
                    <input type="text" name="service_request_survey_target" id="service_request_survey_target" class="input" placeholder="Target of Survey">
                  </div>
                </div>
                <div class="col-lg-12 px-0">
                  <div class="coolselect">
                    <label for="service_request_survey_coverage" class="select-label"> Area of Coverage<span class="text-danger">*</span></label>
                    <select name="service_request_survey_coverage" id="service_request_survey_coverage" class="select">
                      <option value="" selected disabled>- Select -</option>
                      <option value="Division">Division</option>
                      <option value="Regional">Regional</option>
                      <option value="National">National</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="cooltextarea">
                  <label for="service_request_survey_description" class="textarea-label">Brief description of Survey<span class="text-danger">*</span></label>
                  <textarea name="service_request_survey_description" id="service_request_survey_description" class="textarea" cols="30" rows="4"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="coolselect" id="analysis">
              <label for="service_request_analysis" class="select-label">Type of Analysis:<span class="text-danger">*</span></label>
              <select name="service_request_analysis" id="service_request_analysis" class="select">
                <option value="" selected disabled>- Select Analysis -</option>
                <option value="Descriptive Analysis">Descriptive Analysis</option>
                <option value="Financial Analysis">Financial Analysis</option>
                <option value="Productivity Analysis">Productivity Analysis</option>
                <option value="Profitability Analysis">Profitability Analysis</option>
                <option value="Technical Efficiency Analysis">Technical Efficiency Analysis</option>
                <option value="Benefit Cost Analysis">Benefit Cost Analysis</option>
                <option value="Correlation">Correlation (Test of Association)</option>
                <option value="Regression Analysis">Regression Analysis</option>
                <option value="Spatial Econometrics">Spatial Econometrics</option>
                <option value="Time Series Analysis">Time Series Analysis</option>
                <option value="Econometric Modelling">Econometric Modelling</option>
                <option value="Others" id="others">Others</option>
              </select>
            </div>
            <div class="coolselect" id="technical">
              <label for="service_request_software" class="select-label">Type of Software:<span class="text-danger">*</span></label>
              <select name="service_request_software" id="service_request_software" class="select">
                <option value="" selected disabled>- Select Software -</option>
                <option value="SPSS">SPSS</option>
                <option value="Financial Analysis">Financial Analysis</option>
                <option value="STATA">STATA</option>
                <option value="EViews">EViews</option>
                <option value="R">R</option>
                <option value="Frontier">Frontier</option>
                <option value="ArcGIS">ArcGIS</option>
                <option value="GAMS">GAMS</option>
                <option value="PlanBee">PlanBee</option>
                <option value="Grammarly">Grammarly</option>
                <option value="Stat Transfer">Stat Transfer</option>
                <option value="Others">Others</option>
              </select>
            </div>
            @error('service_request_type')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          <div class="col-lg-6">
            <div class="coolinput" id="technical_others">
              <label for="service_request_specific_technical" class="text">Specify others:<span class="text-danger">*</span></label>
              <input type="text" name="service_request_specific_technical" id="service_request_specific_technical" class="input" placeholder="If others, please specify...">
            </div>
            <div class="coolinput" id="analysis_others">
              <label for="service_request_specific_analysis" class="text">Specify others:<span class="text-danger">*</span></label>
              <input type="text" name="service_request_specific_analysis" id="service_request_specific_analysis" class="input" placeholder="If others, please specify...">
            </div>
          </div>
          <div class="col-lg-12 pt-3 pb-1">
            <div class="service-header-form">
              <h4 class="font-netflix-md m-0"> Purpose of Request </h4> 
              <small class="text-muted font-netflix-light px-1 text-xs"> Kindly inform us about the reason for this request. </small>
            </div>
            <div class="col-lg-12 px-0 pb-2">
                <div class="cooltextarea">
                  <label for="service_request_reason" class="textarea-label">Purpose<span class="text-danger">*</span></label>
                  <textarea name="service_request_reason" id="service_request_reason" cols="30" rows="3" placeholder="" class="textarea" value="{{old('service_request_reason')}}" required></textarea>
                </div>
                @error('service_request_reason')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
          </div>
        </div>
        <div class="form-row mb-2">
          <div class="col-lg-12">
            <button type="submit" class="btn btn-success w-100">Submit</button>
          </div>
        </div>
      </form>
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

    $('#service_request_specific_client').hide();
    $('#training').hide();
    $('#analysis').hide();
    $('#technical').hide();
    $('#technical_others').hide();
    $('#analysis_others').hide();
    $('#survey').hide();

    $('#service_request_client').on('change', function(){
        // var type = $(this).val();
        if($(this).val() === 'Others'){
            $('#service_request_specific_client').show();
            $('#service_request_specific_client').attr('required', true);
            
        }else{
            $('#service_request_specific_client').hide();
            $('#service_request_specific_client').removeAttr('required');
        }
    });

    $('#service_request_type').on('change', function(){
        // var type = $(this).val();
        if($(this).val() === 'Training/Workshop'){
            $('#training').show();
            $('#technical').hide();
            $('#analysis').hide();
            $('#analysis_others').hide();
            $('#technical_others').hide();
            $('#survey').hide();
            $('#analysis_others').removeAttr('required');
            $('#technical_others').removeAttr('required');
            $('#service_request_survey_target').removeAttr('required');
            $('#service_request_survey_description').removeAttr('required');
            $('#service_request_survey_coverage').removeAttr('required');
            $('#service_request_software').removeAttr('required');
            $('#service_request_analysis').removeAttr('required');
            $('#service_request_training_topic').attr('required', true);
        }
        else if($(this).val() === 'Data Analytics'){
            $('#analysis').show();
            $('#training').hide();
            $('#technical').hide();
            $('#survey').hide();
            $('#technical_others').hide();
            $('#service_request_survey_target').removeAttr('required');
            $('#service_request_survey_description').removeAttr('required');
            $('#service_request_survey_coverage').removeAttr('required');
            $('#service_request_training_topic').removeAttr('required');
            $('#service_request_software').removeAttr('required');
            $('#service_request_analysis').attr('required', true);

        }else if($(this).val() === 'Technical Assistance/Consultancy'){
            $('#training').hide();
            $('#technical').show();
            $('#analysis').hide();
            $('#analysis_others').hide();
            $('#survey').hide();
            $('#analysis_others').removeAttr('required');
            $('#service_request_training_topic').removeAttr('required');
            $('#service_request_survey_target').removeAttr('required');
            $('#service_request_survey_description').removeAttr('required');
            $('#service_request_survey_coverage').removeAttr('required');
            $('#service_request_analysis').removeAttr('required');
            $('#service_request_software').attr('required', true);
        }else{
            $('#training').hide();
            $('#technical').hide();
            $('#analysis').hide();
            $('#analysis_others').hide();
            $('#survey').show();
            $('#technical_others').hide();
            $('#analysis_others').removeAttr('required');
            $('#technical_others').removeAttr('required');
            $('#service_request_training_topic').removeAttr('required'); 
            $('#service_request_software').removeAttr('required');
            $('#service_request_analysis').removeAttr('required');
            $('#service_request_survey_target').attr('required', true);
            $('#service_request_survey_description').attr('required', true);
            $('#service_request_survey_coverage').attr('required', true);
        }
    });

    $('#service_request_analysis').on('change', function(){
        // var type = $(this).val();
        if($(this).val() == 'Others'){
            $('#analysis_others').show();
            $('#analysis_others').attr('required', true);
        }else{
            $('#analysis_others').hide();
            $('#analysis_others').removeAttr('required');
        }
    });

    $('#service_request_software').on('change', function(){
        // var type = $(this).val();
        if($(this).val() == 'Others'){
            $('#technical_others').show();
            $('#technical_others').attr('required', true);
        }else{
            $('#technical_others').hide();
            $('#technical_others').removeAttr('required');
        }
    });

    $('body').on('submit','#service-request-form', function(){
      
    Swal.fire({
            title: 'Please wait...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showConfirmButton: false,
            onOpen: ()=>{
                Swal.showLoading();
            },
        });
    });

});
</script>
@endsection