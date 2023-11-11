@extends('index.index')
@section('title', 'Publications')
@section('web-content')
<section id="publications"></section>
<div class="row m-0 mb-5">
  <div class="col-lg-12">
    <div class="row m-0 justify-content-center mb-5">
      <div class="col-lg-9 text-center">
        <div class="pub-page-header mt-5">
          <h3>We are waiting for you!</h3>
          <p>Researchers are most welcome to visit SERDAC for data analytics, 
            library resources and technical assistance. Books in agriculture, economics, statistics and related fields 
            are available for reading at SERDAC.</p>
        </div>
      </div>
    </div>
    <div class="row m-0 px-2 mt-4">
      <div class="col-lg-12 pub-page">
        <h1> Publications </h1>
      </div>
      <div class="col-lg-12 pub-search py-3 bg-light rounded border-top">
        <small>Use our search and filter to narrow down your search.</small>
        <div class="form-group mt-2">
          <form action="/publications" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-lg-8">
                <input type="text" name="search" id="search" class="form-control" placeholder="Enter Publication Title, Type or Author..." value="{{old('search')}}" autocomplete="off" required>
              </div>
              <div class="form-group col">
                <button type="submit" value="Search" class="form-control btn-submit">
                  Search
                </button>
              </div>
              <div class="form-group col">
                <input type="reset" value="Clear" class="form-control btn-clear">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <hr class="hr-success">
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="results-container ml-lg-1 py-2">
          @if ($publications->count() === 0)
          <div class="no-results-div px-2 text-center">
            <p class="text-muted"> No results Found. </p>
          </div>
          @else
          @foreach ($publications as $publication)
          <a href="{{ url('/pub_id='.$publication->publication_id) }}" id="incrementButton" data-id="{{$publication->publication_id}}">
            <div class="publication-item border-bottom pt-3 px-3 rounded">
              <h5>{{$publication->publication_title}}</h5>
              <div class="description mt-2 row m-0 font-netflix-light">
                <div class="col-lg-12 no-padding d-flex mb-3">
                  <div class="author-names">
                    <small><i class="fa fa-pencil-square-o pr-1"></i> {{$publication->publication_author}}
                    </small>
                  </div>
                  <div class="col">
                    <small>
                      <span class="px-3"><i class="fa fa-calendar-o pr-1"></i> {{ date('Y', strtotime($publication->publication_date)) }}</span>
                      <span class="px-3"><i class="fa fa-arrow-circle-o-down pr-1"></i> {{$downloadPublications->where('download_publication_id','=', $publication->publication_id)->count()}}</span>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
          @endif
          <div class="search-results mt-4">
            {{$publications->links('pagination::bootstrap-5')}}
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="related-content py-3 mb-3 px-1">
          {{-- MOST-VIEWED --}}
          <div class="top-viewed">
            <h6 class="solid-border-left pl-2 font-weight-bold">
              Most Viewed Publications <i class="fa fa-bullhorn text-main px-2" aria-hidden="true"></i>
            </h6>
            <div class="top-container px-2 py-3 bg-light">
              @if ($topViewPublications->count() == 0)
              <div class="no-data text-center bg-white rounded-circle m-4">
                <img src="{{ url('import/assets/images/contents/no-data.png') }}" class="img-fluid" alt="">
                <h5 class="text-uppercase text-muted p-1">No data at the moment.</h5>
                <small class="text-muted">Please check in another time!</small>
              </div>
              @else
                <?php $counter = 1; ?>
                  @foreach ($topViewPublications as $topViewPublication)
                    <div class="item p-3 m-1 bg-white dark-link border-bottom d-flex position-relative">
                      <img src="{{ url('import/assets/images/contents/ranking/top-1.gif') }}" class="ribbon"  alt="">
                      <div class="pr-3 pl-2 d-flex justify-content-center align-items-center">
                        <h3 class="font-netflix-md font-weight-bold m-0">{{$counter}}</h3>
                      </div>
                      <div class="pr-3">
                        <a href="#">
                          <small class="font-netflix-light font-weight-bold">{{ $topViewPublication->publication->publication_title}}</small>
                        </a>
                        <div class="d-flex">
                          {{-- <small class="text-muted font-netflix-light pr-4">2023</small> --}}
                          <small class="text-muted font-netflix-light pr-4">{{$topViewPublication->count}} Views</small>
                        </div>
                      </div>
                      <?php $counter ++; ?>
                    </div>  
                  @endforeach

              @endif
            </div>
          </div>
          {{-- MOST-DOWNLOADS --}}
          <div class="top-downloads pt-4">
            <h6 class="solid-border-left pl-2 font-weight-bold">
              Most Downloaded Publications <i class="fa fa-bullhorn text-main px-2" aria-hidden="true"></i>
            </h6>
            <div class="top-container px-2 py-3 bg-light">
              @if ($topDownloadPublications->count() == 0)
              <div class="no-data text-center bg-white rounded-circle m-4">
                <img src="{{ url('import/assets/images/contents/no-data.png') }}" class="img-fluid" alt="">
                <h5 class="text-uppercase text-muted p-1">No data at the moment.</h5>
                <small class="text-muted">Please check in another time!</small>
              </div>
              @else
              {{-- @foreach ($datasets as $dataset) --}}
              
                <?php $counter = 1; ?>
                  @foreach ($topDownloadPublications as $topDownloadPublication)
                  
                  <div class="item p-3 m-1 bg-white dark-link border-bottom d-flex position-relative">
                    <img src="{{ url('import/assets/images/contents/ranking/top-1.gif') }}" class="ribbon"  alt="">
                    <div class="pr-3 pl-2 d-flex justify-content-center align-items-center">
                      <h3 class="font-netflix-md font-weight-bold m-0">{{$counter}}</h3>
                    </div>
                    <div class="pr-3">
                      <a href="#">
                        <small class="font-netflix-light font-weight-bold">{{$topDownloadPublication->download_publication_title}}</small>
                      </a>
                      <div class="d-flex">
                        {{-- <small class="text-muted font-netflix-light pr-4">2023</small> --}}
                        <small class="text-muted font-netflix-light pr-4">{{$topDownloadPublication->count}} Downloads</small>
                      </div>
                    </div>
                    <?php $counter ++; ?>
                  </div>  
                @endforeach

      
              {{-- @endforeach --}}
              {{-- <div class="font-netflix text-center p-1">
                <small><a href="{{ url("/datasets") }}">Check our datasets!</a></small>
              </div> --}}
              @endif
            </div>
          </div>
          <div>
            <hr>
            <h6 class="solid-border-left pl-2 font-weight-bold">  
              Be part of our community <i class="fa fa-handshake-o text-main px-2" aria-hidden="true"></i>
            </h6>
            <div class="p-1 bg-light">
              <div class="row m-0">
                <div class="col-5 res-col d-flex align-items-center justify-content-center">
                  <img class="w-100 p-1" src="{{ url('import/assets/images/contents/inclusion.png')}}" alt="">
                </div>
                <div class="col-7 res-col px-3 py-2 bg-white rounded d-flex align-items-center">
                  <div class="text-lg-left text-center">
                    <small>
                      <h6 class="font-weight-bold font-netflix m-1">Online Library</h6>
                      <p class="font-netflix m-1">You can now include your own publication on SERDAC Online Library.</p>
                    </small>
                    <div class="d-flex justify-content-lg-start justify-content-center pt-1">
                      <a class="plain-text-link font-netflix-light" href="{{ url('/submission-publication')}}">
                        <button class="btn btn-outline-success">Submit now <i class="fa fa-paper-plane pl-2"></i></button>
                      </a>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
          <div>
            <hr>
            <h6 class="solid-border-left pl-2 font-weight-bold">
              Discover more <i class="fa fa-rocket text-main px-2" aria-hidden="true"></i>
            </h6>
            <div class="p-1 bg-light">
              <div class="row m-0">
                <div class="col-5 res-col d-flex align-items-center justify-content-center">
                  <img class="w-100 p-1" src="{{ url('import/assets/images/contents/discover-more.png')}}" alt="">
                </div>
                <div class="col-7 res-col px-3 py-2 bg-white rounded d-flex align-items-center">
                  <div class="text-lg-left text-center">
                    <small>
                      <h6 class="font-weight-bold font-netflix m-1">Datasets</h6>
                      <p class="font-netflix mx-1 my-0">Resources from different Socio-Economic and other PCAARRD Funded Projects.</p>
                    </small>
                    <div class="d-flex justify-content-lg-start justify-content-center pt-1">
                      <a class="plain-text-link font-netflix-light" href="{{ url('/datasets')}}">
                        <button class="btn btn-outline-success">Check here <i class="fa fa-external-link pl-2"></i></button>
                      </a>
                    </div>
                  </div>
                </div> 
              </div>
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
  $('body').on('click', '#incrementButton', function(e){
    // e.preventDefault();
        var pub_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "{{url('/count-view/pub_id=')}}"+pub_id,
            data: {
                'publication_id': pub_id,
            },
            // dataType: "dataType",
            success: function (result) {
                console.log(result);
            },
            error: function(result){
                console.error(result);
            }
        });
  });  
});
</script>
@endsection
