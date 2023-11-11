@extends('index.index')
@section('title', $announcements->announcement_title)
@section('web-content')
<div class="row m-0">
  <div class="col-lg-8 px-lg-5 pt-5 pb-3">
    <div class="post-container">
      <img class="d-block w-100 py-lg-3 p-2" src="{{ url('storage/'.$announcements->announcement_image) }}" alt="image">
      <div class="post-header px-2">
        <div class="row ">
          <div class="col-lg-6">
            <small class="text-muted font-netflix-light my-1 font-weight-bold">
              SERDAC - STORIES &nbsp;<i class="fa fa-check-circle text-success" aria-hidden="true"></i>
            </small>
          </div>
          <div class="col-lg-6 d-flex justify-content-lg-end">
            <small class="text-muted font-netflix-light my-1 font-weight-bold">
              Posted  {{ date('M d, Y', strtotime($announcements->created_at)); }}
            </small>
          </div>
        </div>
        <h3 class="font-netflix-md">{{ $announcements->announcement_title }}</h3>
      </div>
      <div class="post-description font-netflix-light text-justify p-2">
        <p>{!! nl2br(e($announcements->announcement_description)) !!}</p>
        @if ($announcements->announcement_links == '')
        <p class="font-netflix-light">
          There's no more further information about this post, you can
          <a href="/"> click here</a> to redirect back to main page.
        </p>
        @else
        <div class="other-links">
          <p class="font-netflix-light">For more information and further details about this post
            <a href="{{ $announcements->announcement_links}}" target="_blank">click here</a>.
          </p>
        </div>
        @endif
        <hr>
      </div>
    </div>
  </div>
  <div class="col-lg-4 py-lg-5 my-lg-3 py-2 my-0">
    @include('layouts.connections')
  </div>
</div>
@endsection