@extends('index.index')
@section('title', 'Submit Publication')
@section('web-content')
<section id="publications"></section>
{{-- <div class="row m-0 justify-content-center">
  <div class="col-lg-9 text-center">
    <div class="pub-page-header mt-5 px-2">
      <h2>Submission Request</h2>
      <p>Researchers are most welcome to visit SERDAC for data analytics, 
        library resources and technical assistance. Books in agriculture, economics, statistics and related fields 
        are available for reading at SERDAC.</p>
        <center>
          <hr style="width: 50%;">
        </center>
    </div>
  </div>
</div> --}}
{{-- !! In production !! --}}
<div class="row mx-0 mt-2 py-4 px-lg-0 px-3 d-flex justify-content-center align-items-center bg-white shadow">
  <div class="col-lg-12 px-lg-5">
    <div class="row m-0 px-lg-5">
      <div class="d-flex justify-content-center align-items-center">
        <div class="col-lg-2">
          <img src="{{ url('import\assets\images\contents\services-png\file-send.png') }}" class="d-block w-100 service-form-image" alt="">
        </div>
        <div class="col-lg-10 py-2">
          <h1 class="font-netflix-md text-main m-0">Submit Publication Form</h1>
          <small class="text-muted font-netflix-light">To submit your publication, kindly take a moment to complete the form below with all the necessary details. Your information is essential for a successful submission.</small>
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
      <form action="{{route('submission.publication.store')}}" id="submission-request-form" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="service-form-header">
          <h4 class="font-netflix-md m-0">Publication Information </h4> 
          <small class="text-muted font-netflix-light px-1 text-xs"> All fields with <span class="text-danger">*</span> are required</small>
        </div>
        <div class="form-group">
          <div class="form-row mb-2">
            <div class="col-lg-4">
              <div class="coolselect">
                <label for="submission_publication_type" class="select-label">Publication Type<span class="text-danger">*</span></label>
                <select id="submission_publication_type" name='submission_publication_type' class="select" required>
                  <option value="" selected disabled>-- Type --</option>
                  <option value="Journal/Journal Article">Journal/Journal Article</option>
                  <option value="Book">Book</option>
                  <option value="Technical Report/Research Paper">Technical Report/Research Paper</option>
                  <option value="Unclassified/Others">Unclassified/Others</option>
                </select>
              </div>
              @error('submission_publication_type')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-lg-4">
              <div class="coolselect">
                <label for="submission_publication_theme" class="select-label">Publication Theme<span class="text-danger">*</span></label>
                <select id="submission_publication_theme" name='submission_publication_theme' class="select" required>
                  <option value="" selected disabled>-- Theme --</option>
                  <option value="Socioeconomics">Socioeconomics</option>
                  <option value="Agriculture">Agriculture</option>
                  <option value="Horticulture">Horticulture</option>
                </select>
              </div>
              @error('submission_publication_type')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_date" class="text">Publication Date<span class="text-danger">*</span></label>
                <input type="date" name="submission_publication_date" id="submission_publication_date" class="input border rounded p-0-65" required>
              </div>
              @error('submission_publication_date')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col-lg-12">
              <div class="coolinput">
                <label for="submission_publication_title" class="text">Publication Title<span class="text-danger">*</span></label>
                <input type="text" name="submission_publication_title" id="submission_publication_title" class="input" placeholder="Title" required>
              </div>
              @error('submission_publication_title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col-lg-12">
              <div class="coolinput">
                <label for="submission_publication_author" class="text">Publication Author<span class="text-danger">*</span></label>
                <input type="text" name="submission_publication_author" id="submission_publication_author" class="input" placeholder="Author" required>
                <small class="text-info text-xs font-netflix">*Separate names only with comma and '&'. Include hyphen(-) for two-word surnames (Juan Dela-Cruz).</small>
              </div>
              @error('submission_publication_author')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col-lg-12">
              <div class="cooltextarea">
                <label for="submission_publication_description" class="textarea-label">Publication Description<span class="text-danger">*</span></label>
                <textarea name="submission_publication_description" id="submission_publication_description" rows="4" class="textarea" placeholder="Description" required></textarea>
                <small class="text-info text-xs font-netflix">*It can be the abstract or introduction of the paper.</small>
              </div>
              @error('submission_publication_description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_contributor" class="text">Contributor<span class="text-danger">*</span></label>
                <input type="text" name="submission_publication_contributor" id="submission_publication_contributor" placeholder="Contributor" class="input">
                <small class="text-info text-xs font-netflix">*It can be acronym or full text</small>
              </div>
              @error('submission_publication_contributor')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_publisher" class="text">Publisher<span class="text-danger">*</span></label>
                <input type="text" name="submission_publication_publisher" id="submission_publication_publisher" placeholder="Publisher" class="input">
                <small class="text-info text-xs font-netflix">*It can be acronym or full text</small>
              </div>
              @error('submission_publication_publisher')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_doi" class="text">DOI</label>
                <input type="text" name="submission_publication_doi" id="submission_publication_doi" placeholder="DOI" class="input">
                <small class="text-info text-xs font-netflix">*e.g. https://doi.org/DOI:10.1016/</small>
              </div>
              @error('submission_publication_doi')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2" id="form-journal">
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_volume" class="text">Volume<span class="text-danger">*</span></label>
                <input type="text" class="input" id="submission_publication_volume" name='submission_publication_volume' placeholder="Volume">
              </div>
              @error('submission_publication_volume')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-lg-4">
              <div class="coolinput">
                <label for="submission_publication_issue" class="text">Issue<span class="text-danger">*</span></label>
                <input type="text" class="input" id="submission_publication_issue" name='submission_publication_issue' placeholder="Issue">
              </div>
              @error('submission_publication_issue')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="form-row mb-2">
            <div class="col-lg-12 pt-3 pb-1">
              <div class="service-form-header">
                <h4 class="font-netflix-md m-0"> Upload File </h4> 
                <small class="text-muted font-netflix-light px-1"> We <strong class="text-danger">only</strong> accept <strong>PDF</strong> file format.  </small>
              </div>
              <div class="col-lg-4 px-0 py-2">
                <input type="file" name="submission_publication_file" id="submission_publication_file" class="form-control-file border rounded border p-1" accept=".pdf" required>
                @error('submission_publication_file')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
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

    $('#form-journal').hide();

    $('#submission_publication_type').on('change', function(){
        var type = $(this).val();
        if(type!='Journal/Journal Article'){
            $('#form-journal').hide();
        }else{
            $('#form-journal').show();
        }
    });

    $('body').on('submit','#submission-request-form', function(){
      
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