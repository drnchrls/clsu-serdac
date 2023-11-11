@extends('index.index')
@section('title', 'Datasets')
@section('web-content')
<section id="publications"></section>
<div class="row m-0 mb-5">
  <div class="col-lg-12">
    <div class="row m-0 justify-content-center mb-5">
      <div class="col-lg-9 text-center">
        <div class="pub-page-header mt-5">
          <h3>We are waiting for you!</h3>
          <p>Resources from different Socio-Economic and other PCAARRD Funded Projects can be checked here.</p>
        </div>
      </div>
    </div>
    <div class="row m-0 px-2 mt-4">
      <div class="col-lg-12 pub-page">
        <h1> Datasets </h1>
      </div>
      <div class="col-lg-12 pub-search py-3 bg-light rounded border-top">
        <small>Use our search and filter to narrow down your search.</small>
        <div class="form-group mt-2">
          <form action="/datasets" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-lg-8">
                <input type="text" name="search" id="search" class="form-control" placeholder="Enter Book Title, Type or Author..." value="{{old('search')}}" autocomplete="off" required>
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
          @if ($datasets->count() === 0)
          <div class="no-results-div px-2 text-center">
            <p class="text-muted"> No results Found.</p>
          </div>
          @else
          @foreach ($datasets as $dataset)
          <a href="{{ url('/dataset_id='.$dataset->dataset_id) }}" id="incrementButton" data-id="{{$dataset->dataset_id}}">
            <div class="publication-item border-bottom pt-3 px-3 rounded">
              <h5>{{$dataset->dataset_title}}</h5>
              <div class="description mt-2 row m-0 font-netflix-light">
                <div class="col-lg-12 no-padding d-flex mb-3">
                  <div class="author-names">
                    <small><i class="fa fa-pencil-square-o pr-1"></i> {{$dataset->dataset_author}}
                    </small>
                  </div>
                  <div class="col">
                    <small>
                      <span class="px-3"><i class="fa fa-calendar-o pr-1"></i> {{ date('Y', strtotime($dataset->dataset_date)) }}</span>
                      <span class="px-3"><i class="fa fa-arrow-circle-o-down pr-1"></i> {{$downloadDatasets->where('download_dataset_id','=', $dataset->dataset_id)->count()}}</span>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </a>
          @endforeach
          @endif
          <div class="search-results mt-4">
            {{$datasets->links('pagination::bootstrap-5')}}
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="related-content py-3 mb-3 px-1">
          <div>
            <h6 class="solid-border-left pl-2 font-weight-bold">
              Discover more <i class="fa fa-rocket text-main px-2" aria-hidden="true"></i>
            </h6>
            <div class="p-1 bg-light">
              <div class="row m-0">
                <div class="col-5 res-col d-flex align-items-center justify-content-center">
                  <img class="w-100 p-1" src="{{ url('import/assets/images/contents/discover-more-1.png')}}" alt="">
                </div>
                <div class="col-7 res-col px-3 py-2 bg-white rounded d-flex align-items-center">
                  <div class="text-lg-left text-center">
                    <small>
                      <h6 class="font-weight-bold font-netflix m-1">Books & Journals</h6>
                      <p class="font-netflix mx-1 my-0">Discover books & journals in agriculture economics, statistics and related fields.</p>
                    </small>
                    <div class="d-flex justify-content-lg-start justify-content-center pt-1">
                      <a class="plain-text-link font-netflix-light" href="{{ url('/publications')}}">
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
        var dataset_id = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "{{url('/count-view/dataset_id=')}}"+dataset_id,
            data: {
                'dataset_id': dataset_id,
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