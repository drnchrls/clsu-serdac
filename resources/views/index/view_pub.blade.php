@extends('index.index')
@section('title', $view_pub->publication_title)
@section('web-content')
<section id="view_pub"></section>
<div class="row mx-0 my-lg-5 py-5 p-lg-2 p-lg-0 p-4 mb-3">
  <div class="col-lg-12 px-lg-2 px-0">
    <div class="m-0 pb-2">
      <small>
        <span class="bg-outline-secondary-tag px-2 py-1 shadow-sm rounded font-netflix"> 
          <i class="fa fa-file-text px-1"></i>
          {{ $view_pub->publication_type }}</span>
      </small>
    </div>
    <h2 class="view-pub-title m-0">{{$view_pub->publication_title}}</h2>
    <div class="view-pub-details font-netflix py-1">
      <small>
        <span class="pr-1"><i class="fa fa-institution pr-1"></i> {{$view_pub->publication_contributor}}</span>
        <span class="pr-1"><i class="fa fa-calendar-o pr-1"></i> {{date('F Y', strtotime($view_pub->publication_date))}}</span>
        <span class="pr-1"><i class="fa fa-eye pr-1"></i> {{$viewCount}} </span>
        {{-- <span> <i class="fa fa-arrow-circle-down px-1"></i> {{$downloadview_pub->where('download_publication_id','=', $view_pub->publication_id)->count()}} Downloads</span> --}}
      </small>
    </div>
  </div>
  <div class="col-lg-8 px-lg-2 px-0 text-justify">
    @if ($view_pub->publication_volume == null)
    
    @else
    <div class="view-pub-details font-netflix my-2 d-flex">
      <div class="px-lg-2 pr-3">
        <small class="text-muted">VOLUME NO.</small>
        <div>
          <span><i class="fa fa-file-text-o pr-2"></i>  {{$view_pub->publication_volume}}</span>
        </div>
      </div>
      <div class="px-lg-2 pr-3">
        <small class="text-muted">ISSUE NO.</small>
        <div>
          <span><i class="fa fa-file-text-o pr-2"></i>  {{$view_pub->publication_issue}}</span>
        </div>
      </div>
    </div>
    @endif
    <p class="view-pub-description px-lg-2 px-0 pt-3 border-top">{{ $view_pub->publication_description }}</p>
    <div class="row m-0 border-bottom px-lg-2 px-0 pb-4">
      <div class="col-lg-12 p-0">
        <div class="citation-div font-netflix-light">
          You can <b>cite</b> this publication by clicking this
          <button class="btn-secondary shadow px-3 py-1 mx-1 rounded" data-target="#citationModal" data-toggle="modal" id="btnCitation" data-id="{{$view_pub->publication_id}}"> cite <i class="fa fa-quote-right"></i> </button> button.
        </div>
      </div>
    </div>
    <div class="row m-0 py-3">
      <div class="col-lg-12 px-lg-2 py-1 px-0">
        <div>
          <small class="text-uppercase font-netflix-md font-weight-bold">Author</small>
          <div>
            <span class="font-netflix-light" id="needAuth" >{{$view_pub->publication_author}}</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4 px-lg-2 py-1 px-0">
        <small class="text-uppercase font-netflix-md font-weight-bold">Contributor</small>
        <div>
          <span class="font-netflix-light">{{$view_pub->publication_contributor}}</span>
        </div>
      </div>
      <div class="col-lg-4 px-lg-2 py-1 px-0">
        <small class="text-uppercase font-netflix-md font-weight-bold">Publisher</small>
        <div>
          <span class="font-netflix-light">{{$view_pub->publication_publisher}}</span>
        </div>
      </div>
      <div class="col-lg-4 px-lg-2 py-1 px-0 text-lg-center">
        <small class="text-uppercase font-netflix-md font-weight-bold">Downloads</small>
        <div>
          <span class="font-netflix-md">{{$downloadPublications->where('download_publication_id','=', $view_pub->publication_id)->count()}}</span> times
        </div>
      </div>
      @if ($view_pub->publication_doi == '')
      <div class="col-lg-12 px-lg-2 py-1 px-0">
        <small class="text-uppercase font-netflix-md font-weight-bold">DOI</small>
        <div>
          <span class="font-netflix-light text-muted">DOI is not available</span>
        </div>
      </div>
      @else
      <div class="col-lg-12 px-lg-2 py-1 px-0">
        <small class="text-uppercase font-netflix-md font-weight-bold">DOI</small>
        <div class="plain-text-link">
          <i class="fa fa-external-link-square" aria-hidden="true"></i>
          <a href="https://doi.org/{{$view_pub->publication_doi}}" target="_blank" class="plain-text-link"><span class="font-netflix-light">{{$view_pub->publication_doi}}</span></a>
        </div>
      </div>
      @endif
    </div>
    <div class="row m-0 border-bottom p-0">
      @auth('web')
      <div class="col-lg-12 d-flex justify-content-center px-2 pb-4">
        <button type="button" class="download-btn py-2 px-3 rounded font-netflix-light " data-user="{{Auth::user()->id}}" data-publication="{{$view_pub->publication_id}}" data-toggle="modal" data-target="#downloadModal">
          Download Publication <i class="fa fa-file-o px-2" aria-hidden="true"></i>
        </button>
      </div>
      @else
        @if (Route::has('login'))
        <div class="col-lg-12 d-flex justify-content-center px-2">
          <a name="" id="" href="{{ route('login') }}" role="button">
            <button type="button" class="download-btn py-2 px-3 rounded font-netflix-light" data-target="#required">
              Download Publication <i class="fa fa-arrow-circle-o-down px-2" aria-hidden="true"></i>
            </button>
          </a>
        </div>
        <div class="col-lg-12">
          <p class="text-center">
            <small class="text-muted">You need an account to download this.</small>
          </p>
        </div>
        @endif
      @endauth
    </div>
  </div>
  <div class="col-lg-4 my-lg-0 my-3 px-lg-3 p-0">
    <div class="related-content mb-3 px-1">
      <h6 class="solid-border-left pl-2 font-netflix font-weight-bold">
         You might also like<i class="fa fa-thumbs-up text-main px-2" aria-hidden="true"></i>
      </h6>
      <div class="suggested-container p-2 bg-light">
        @if ($relatedPublications->count() === 0)
        <div class="no-data text-center rounded-circle m-4">
          <img src="{{ url('import/assets/images/contents/no-data.png') }}" class="img-fluid" alt="">
          <h4 class="text-uppercase text-muted p-1">No data at the moment.</h4>
          <small class="text-muted">Please check in another time!</small>
        </div>
        @else
        @foreach ($relatedPublications as $publication)
        <div class="item px-3 py-2 bg-white m-1 dark-link border-bottom">
          <a href="{{ url('/pub_id='.$publication->publication_id) }}" id="incrementButton" data-id="{{$publication->publication_id}}">
            <div>
              <small class="font-netflix-light font-weight-bold">{{$publication->publication_title}}</small>
            </div>
          </a>
          <div class="d-flex pt-1">
            <span>
              <small class="text-muted font-netflix-light pr-3"> {{ date('Y', strtotime($publication->publication_date)) }} </small>
            </span>
            <span>
              <small class="text-muted font-netflix-light related-authors">{{ $publication->publication_author }} </small>
            </span>
          </div>
        </div> 
        @endforeach
        <div class="font-netflix text-center p-1">
          <small><a href="{{ url('/publications') }}">Check out more!</a></small>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
{{-- CITATION MODAL --}}
<div class="modal fade" id="citationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-main">
        <h5 class="modal-header-title text-white text-uppercase font-netflix-md m-0" id="exampleModalLabel">Citation</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-light rounded m-3 generated-citation" id="citation">
        {{$view_pub->generateCitation($view_pub)}}
      </div>
      <div class="row mx-2 my-1">
        <div class="col p-3">
          <button type="button" class="copy-citation-btn px-4 py-2 mr-3 rounded" data-clipboard-target="#citation">Copy to clipboard</button>
          <button type="button" class="cancel-citation-btn px-4 py-2 mr-3 rounded" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>
{{--DOWNLOAD MODAL --}}
<div class="modal fade rounded" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-title pt-3 pb-3 px-4">
        <h5>Download Publication</h5>
        <small>Kindly inform us of your purpose for downloading this publication and provide additional information to enhance our services, rest assured that your responses will be kept strictly confidential and not shared with
          any external parties. Thank you.
        </small>
      </div>
      <div class="modal-body bg-light rounded m-3">
        <form action="{{url('download/pub_id='.$view_pub->publication_id)}}" method="POST" enctype="multipart/form-data" id="downloadForm">
          @csrf
          <div class="form-row">
            <div class="col-md-12 form-group">
              <small>Reason*</small>
              <select class="form-control" name="download_reason" id="download_reason" required>
                <option value="" disabled selected>- Select -</option>
                <option value="in preparing school curriculum/course">in preparing school curriculum/course</option>
                <option value="in preparing school reports/papers/theses">in preparing school reports/papers/theses</option>
                <option value="in preparing news and features articles/columns/editorials">in preparing news and features articles/columns/editorials</option>
                <option value="in writing research studies/projects">in writing research studies/projects</option>
                <option value="in formulating policies, laws, or ordinances">in formulating policies, laws, or ordinances</option>
                <option value="in developing programs, projects, or services">in developing programs, projects, or services</option>
                {{-- <option value="in making judicial decisions">in making judicial decisions</option> --}}
                <option value="Others">Others</option>
              </select>
              @error('download_reason')
              <span class="text-danger" role="alert">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="row mx-2 my-1">
            <div class="col-lg-12 p-3 d-flex justify-content-center">
              <div class="row">
                <div class="col">
                  <button id="btnDownload" type="submit" class="download-now-btn px-4 py-2 rounded" data-id="{{$view_pub->publication_id}}">Download</button>
                </div>
                <div class="col">
                  <button type="reset" class="cancel-download-btn px-4 py-2 rounded" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {

      // $('.modal-backdrop').hide();
      // $('.modal').hide();

    $.ajaxSetup({
    // Cross-Site Request Forgery - CSRF
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    new ClipboardJS('.copy-citation-btn');
      
      $('.copy-citation-btn').click(function (e) {
        e.preventDefault();
        Swal.fire({
          title: 'Great!',
          showConfirmButton:false,
          text: 'Text copied to clipboard!',
          timerProgressBar: true,
          timer:1500
          });
      });
      
    $('#downloadForm').submit(function (e) { 
        e.preventDefault();
        var pub_id = $('#btnDownload').data('id');
        var download_reason = $('#download_reason').val();
        // $('#downloadModal').hide();
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
            url: "{{url('download/pub_id=')}}"+pub_id,
            data: {
                "download_reason": download_reason,
            },
            dataType: "json",
            success: function (result) {
                
                // Create a Blob object containing the file data.
                var blob = new Blob([result.data], { type: result.mime_type });

                // Create a URL for the Blob object.
                var url = window.URL.createObjectURL(blob);

                // Create a fake <a> element and trigger a click event to download the file.
                var a = document.createElement('a');
                a.href = url;
                a.download = result.filename;
                document.body.appendChild(a);
                a.click();

                // Clean up by revoking the Object URL to release resources.
                window.URL.revokeObjectURL(url);
                Swal.close();
                swal("File Downloaded!", {
                      icon: "success",
                });
                // $('#downloadModal').hide();
                console.log('Success: ',result);
            },
            error: function(xhr, status, error){
                Swal.close();
                console.error(error);
            },
        });
    });
});
</script>
@endsection