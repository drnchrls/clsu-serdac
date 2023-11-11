@extends('index.index')
@section('title', 'CLSU-SERDAC')
@section('slider-content')
<section id="home"></section>
<div class="row m-0">
  <div class="col-lg-12 no-padding">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="carousel-filter d-flex align-items-center justify-content-center">
            <div class="carousel-title-card text-center">
              <div class="carousel-header">
                <h1 class="text-uppercase">Welcome to SERDAC-Luzon </h1>
                <hr class="carousel-divider">
                <h6 class="px-lg-5 mx-lg-5">Socio-Economic Research and Data Analytics Center</h6>
                <div class="learn-btn py-lg-4 p-1">
                  <a href="#about-us">Learn More &nbsp; <i class="fa fa-info-circle"></i> </a>
                </div>
              </div>
            </div>
          </div>
          <img class="d-block w-100 " src="{{ url('import\assets\images\carousel\carousel-1.jpg') }}" alt="">
        </div>
        <div class="carousel-item">
          <div class="carousel-filter d-flex align-items-center justify-content-center">
            <div class="carousel-title-card text-center">
              <div class="carousel-header">
                <h1 class="text-uppercase"> We are waiting for you! </h1>
                <hr class="carousel-divider">
                <h6 class="px-lg-5 mx-lg-5">Researchers are most welcome to visit SERDAC for data analytics, library resources and technical assistance. Books in agriculture, economics, statistics and related fields are available for reading at SERDAC.</h6>
                <div class="learn-btn py-lg-4 p-1">
                  <a href="#publications">Learn More &nbsp; <i class="fa fa-info-circle"></i></a>
                </div>
              </div>
            </div>
          </div>
          <img class="d-block w-100 " src="{{ url('import\assets\images\carousel\carousel-2.jpg') }}" alt="">
        </div>
        @foreach($sliders as $slider)
        <div class="carousel-item">
          <div class="carousel-filter d-flex align-items-center justify-content-center">
            <div class="carousel-title-card text-center">
              <div class="carousel-header">
                <h1 class="text-uppercase">{{ $slider->slider_title }} </h1>
                <hr class="carousel-divider px-lg-5 mx-lg-5">
                <h6>{{ $slider->slider_description }}</h6>
              </div>
            </div>
          </div>
          <img class="d-block w-100 " src="{{ url('storage/'.$slider->slider_image)}}" alt="">
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
@endsection
{{-- ANNOUNCEMENT SECTION --}}
@section('web-content')
<section id="news"></section>
<div class="row m-0 mt-4">
  <div class="col-lg-12">
    <div class="news-section-header text-center">
      <p class="text-uppercase hr-uplines">
        <small class="font-netflix-md">News<i class="fa fa-newspaper-o pl-2" aria-hidden="true"></i>
        </small>
      </p>
      <h2 class="hr-lines">Our Latest Updates.</h2> 
    </div>
  </div>
  <div class="col-lg-12">
    @if ($announcements->count() === 0)
    <div class="no-announcement text-center px-1 py-4">
      <img src="{{ url('import\assets\images\contents\notes.png') }}" width="300" class="img-fluid" alt="">
      <h4 class="text-uppercase text-muted p-1">No announcement at the moment.</h4>
      <small class="text-muted">Please check in another time!</small>
    </div>
    @else
    <div class="owl-carousel" id="announcementCarousel">
      @foreach($announcements as $announcement)
      <div class="col p-2">
        <div class="post-card bg-light border shadow-sm">
          <div class="post-img-container position-relative overflow-hidden">
            <div class="post-type text-uppercase px-3 text-white font-netflix-md">
              <small>{{$announcement->announcement_type}}</small>
            </div>
            <div class="post-date m-1 text-center">
              <div class="circle-date text-white font-netflix-md text-uppercase d-flex justify-content-center align-items-center">
                <small>
                  {{ date('d', strtotime($announcement->created_at)) }}
                  <span>{{ date('M', strtotime($announcement->created_at)) }}</span>
                </small>
              </div>
            </div >
            <img class="d-block w-100" src="{{ url('storage/'.$announcement->announcement_image) }}" alt="News">
          </div>
          <div class="post-description position-relative">
            <h5 class="post-header px-4 pt-3 pb-0  font-netflix-md">
              {{$announcement->announcement_title}}
            </h5>
            <div class="post-information px-4 font-netflix text-justify">
              <small>
                {{$announcement->announcement_description}}
              </small>
            </div>
            <div class="post-author px-2 my-3">
              <div class="row m-0">
                <div class="col-6">
                  <small class="text-muted font-netflix">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp;CLSU - SERDAC
                  </small>
                </div>
                <div class="col-6 text-right">
                  <small><a href="{{ url('/blog_id='.$announcement->announcement_id) }}" class="text-success">Read More</a></small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
{{-- SERVICES SECTION --}}
<section id="services"></section>
<div class="row m-0 mt-4">
  <div class="col-lg-12">
    <div class="services-section-header text-center">
      <p class="text-uppercase hr-uplines">
        <small class="font-netflix-md">Services <i class="fa fa-cogs pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">What We Offer.</h2>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="services-section-card row m-0 px-1 py-4 text-center">
      <div class="col-lg-4 p-4 shadow-sm rounded border bg-white">
        <img src="{{ url('import\assets\images\contents\services-png\data-analytics.png') }}" width="200" alt="">
        <h5>Data Analytics</h5>
        <p>
          <small>The center provides socio-economic, econometric and statistical analysis.</small>
        </p>
      </div>
      <div class="col-lg-4 p-4 shadow-sm rounded border bg-white">
        <img src="{{ url('import\assets\images\contents\services-png\training.png') }}" width="200" alt="">
        <h5>Training</h5>
        <p>
          <small>The center provides trainings and workshops to initiate research capability building activities.</small>
        </p>
      </div>
      <div class="col-lg-4 p-4 shadow-sm  rounded border bg-white">
        <img src="{{ url('import\assets\images\contents\services-png\technical-assistance.png') }}" width="200" alt="">
        <h5>Technical Assistance/Consultancy</h5>
        <p>
          <small>The center provides assistance to further develop the capability of clients.</small>
        </p>
      </div>
      <div class="col-lg-4 p-4 shadow-sm rounded border bg-white">
        <img src="{{ url('import\assets\images\contents\services-png\research-implementations.png') }}" width="200" alt="">
        <h5>Survey Services</h5>
        <p>
          <small>Provides survey services like construction of survey instruments and sample size determination.</small>
        </p>
      </div>
      <div class="col-lg-4 p-4 shadow-sm rounded border bg-white">
        <img src="{{ url('import\assets\images\contents\services-png\library.png') }}" width="200" alt="">
        <h5>Library</h5>
        <p>
          <small>Selected books and journals on socio-economics, econometrics, statistics, and related subjects are available.
            Go to our <a class="library-link" href="{{ url('/publications') }}">Online Library</a> for the copy of the needed article and more.
          </small>
        </p>
      </div>
      <div class="col p-4 border rounded bg-light d-flex align-items-center justify-content-center">
        {{-- <img src="{{ url('import\assets\images\contents\services-png\consultancy.png') }}" width="200" alt=""> --}}
        <div>
          <img src="{{ url('import\assets\images\contents\services-png\forms.png') }}" width="200" alt="">
          <h5>Ready to get started?</h5>
          <p>
            <small>
              Click the button below to access our services request form and get started. If you have any questions or require further assistance, don't hesitate to reach out to our team.
            </small>
            </p>
            <div class="">
              <a href="/service-request" class="btn btn-success px-3 py-1" > Click here </a>
            </div>
        </div>
      </div>
      <div class="d-flex justify-content-center col-lg-12">
        
      </div>
    </div>
  </div>
</div>
{{-- GALLERY SECTION --}}
<section id="gallery"></section>
<div class="row m-0 mt-4">
  <div class="col-lg-12">
    <div class="gallery-section-header text-center">
      <p class="text-uppercase hr-uplines">
        <small class="font-netflix-md">Gallery <i class="fa fa-picture-o pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">Training & Seminars.</h2> 
    </div>
  </div>
  <div class="col-lg-12">
    @if($galleries->count() === 0)
    <div class="col text-center p-4 rounded m-0">
      <div class="no-announcement">
        <img src="{{ url('import\assets\images\contents\no-gallery-cat.png') }}" width="300" class="img-fluid" alt="">
        <h4 class="text-uppercase text-muted p-1">Our gallery is empty.</h4>
        <small class="text-muted">Please check in another time!</small>
      </div>
    </div>
    @else
    <div class="owl-carousel py-4" id="galleryCarousel">
      @foreach ($galleries as $gallery)
      <div class="col bg-white border p-0 shadow-sm ">
        <div class="p-1">
          <div class="image-holder overflow-hidden position-relative bg-white">
            <img src="{{ url('storage/'.$gallery->gallery_image) }}" class="d-block img-fluid" alt="">
            <span class="image-tag">
              @if ($gallery->gallery_type === 'Training/Workshop')
              <small class="bg-warning-so text-light px-3 py-1 shadow rounded-right">{{$gallery->gallery_type}}</small>
              @else
              <small class="bg-info-so text-light px-3 py-1 shadow rounded-right">{{$gallery->gallery_type}}</small>
              @endif
            </span>
            <a href="{{ url('storage/'.$gallery->gallery_image) }}" data-lightbox="{{$gallery->gallery_id}}" data-title="Click anywhere outside to close.">
              <div class="img-filter d-flex justify-content-center align-items-center"> 
                <span class="material-symbols-outlined sz-70">
                  zoom_in
                  </span>
              </div>
            </a>
            <div class="expand-gallery">
              <button type="button" class="bg-white" data-target="#galleryCollapse{{ $gallery->gallery_id }}" data-toggle="collapse">
                <span class="material-symbols-outlined">
                  expand_more
                </span>
              </button>
            </div>
          </div>
        </div>
        <div class="collapse" id="galleryCollapse{{ $gallery->gallery_id }}">
          <div class="photo-card">
            <div class="col-12 px-2">
              <div class="col-12 pt-1 pb-0 px-1 text-left photo-card-header">
                <small class="text-muted font-netflix font-weight-bold text-uppercase">Title</small>
              </div>
              <div class="col-12 px-2 py-0 text-center">
                <h6 class="font-netflix-md m-0 pb-3">{{ $gallery->gallery_title }}</h6>
              </div>
            </div>
            <div class="row m-0 border-top bg-light">
              <div class="stack-date col-3 px-2 py-1 text-center border-right my-2">
                <small class="font-netflix text-uppercase"> 
                  <span> {{ date('M', strtotime($gallery->gallery_date)) }} </span> <br>
                  <span class="stack-day"> 12 </span> <br>
                  <span> {{ date('Y', strtotime($gallery->gallery_date)) }}</span><br>
                </small>
              </div>
              <div class="col-9 px-2">
                <div class="col-12 pt-1 pb-0 px-1 text-left photo-card-header">
                  <small class="text-muted font-netflix font-weight-bold text-uppercase">Participants</small>
                </div>
                <div class="col-12 px-2 py-0">
                  <small class="font-netflix-md">{{ $gallery->gallery_participants }}</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
{{-- PUBLICATIONS SECTION --}}
<section id="publications"></section>
<div class="row m-0 mt-4">
  <div class="col-lg-12">
    <div class="publications-section-header text-center">
      <p class="text-uppercase hr-uplines">
        <small class="font-netflix-md"> E-Library <i class="fa fa-book pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">What we have.</h2> 
      <p class="text-center mx-4 px-4 font-netflix">
        Researchers are most welcome to visit SERDAC for data analytics, library resources and technical assistance.
        Books in agriculture, economics, statistics and related fields are available for reading at SERDAC.
      </p>
    </div>
  </div>
  <div class="datasets-section col-lg mx-lg-4 m-4 text-center p-5 shadow rounded border">
    <img src="{{ url('import\assets\images\contents\datasets.png') }}" width="150" alt="">
    <span class="datasets-counter">{{$countDatasets}}</span>
    <sup class="datasets">Datasets</sup>
    <small>
      <p>
        Resources from different Socio-Economic and other PCAARRD Funded Projects can be checked here.
      </p>
    </small>
    <a class="datasets-button px-lg-5 px-3 py-2 shadow-sm rounded" href="{{ url('/datasets') }}">
      View <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
  <div class="books-section col-lg mx-lg-4 m-4 text-center p-5 shadow rounded border">
    <img src="{{ url('import\assets\images\contents\books.png') }}" width="150" alt="">
    <span class="books-counter">{{$countPublications}}</span>
    <sup class="books">Books & Journals</sup>
    <small>
      <p>
        Books in agriculture, economics, statistics and related fields are available for reading at SERDAC.
      </p>
    </small>
    <a class="books-button px-lg-5 px-3 py-2 shadow-sm rounded" href="{{ url('/publications') }}">
      View <i class="fa fa-arrow-circle-right"></i>
    </a>
  </div>
</div>
{{-- ABOUT-US SECTION --}}
<section id="about-us"></section>
<div class="row m-0 mt-4 d-flex justify-content">
  <div class="col-lg-12">
    <div class="about-us-section-header text-center">
      <p class="text-uppercase hr-uplines">
        <small class="font-netflix-md">About Us <i class="fa fa-info-circle pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">What is SERDAC.</h2>
      <p class="text-center mx-lg-5 px-4 font-netflix">
        The <span class="serdac-colored">Socio-Economic Research and Data Analytics Center in Luzon (SERDAC-Luzon)</span> was established on the 29th of September 2017, through a grant provided by the Department of Science and Technology - Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development (DOST-PCAARRD). 
      </p>
    </div>
  </div>
  <div class="col-lg-12 no-padding">
    <div class="row m-0 px-lg-0 px-3">
      <div class="mission-card col-lg-4 col-12 my-lg-1 my-3 text-center border-bottom-mission border-left border-right bg-light bg-light no-padding">
        <div class="img-container bg-white position-relative">
          <div class="mission-img-filter"></div>
          <img src="{{ url('import\assets\images\contents\CPSD.jpg') }}" class="w-100" alt="">
        </div>
        <div class="description p-3">
          <div class="row icon-container position-relative d-flex justify-content-center mt-4">
            <span class="material-symbols-outlined bg-light shadow rounded-circle text-068FD6 p-2">
              rocket
            </span>
          </div>
          <h4 class="font-netflix-md my-3">Mission</h4>
          <div class="px-3">
            <small class="font-netflix text-muted">Provide access to genuine socio-economic tools, cutting edge data analytics and relevant 
              capacity development for quality research to generate inputs for policy makers that can enhance people’s welfare.
            </small>
          </div>
        </div>
      </div>
      <div class="mission-card col-lg-4 col-12 my-lg-1 my-3 text-center border-bottom-vision border-left border-right bg-light no-padding">
        <div class="img-container bg-white position-relative">
          <div class="vision-img-filter"></div>
          <img src="{{ url('import\assets\images\contents\images.jpg') }}" class="w-100" alt="">
        </div>
        <div class="description p-3 ">
          <div class="row icon-container position-relative d-flex justify-content-center mt-4">
            <span class="material-symbols-outlined bg-light shadow rounded-circle text-B87D07 p-2">
              emoji_objects
            </span>
          </div>
          <h4 class="font-netflix-md my-3">Vision</h4>
          <div class="px-3">
            <small class="font-netflix text-muted">To become the leading center for socio-economic research and data analytics in Luzon.
            </small>
          </div>
        </div>
      </div>
      <div class="mission-card col-lg-4 col-12 my-lg-1 my-3 text-center border-bottom-goals border-left border-right bg-light bg-light no-padding">
        <div class="img-container bg-white position-relative">
          <div class="goals-img-filter"></div>
          <img src="{{ url('import\assets\images\contents\PR136image1.jpg') }}" class="w-100" alt="">
        </div>
        <div class="description p-3">
          <div class="row icon-container position-relative d-flex justify-content-center mt-4">
            <span class="material-symbols-outlined bg-light shadow rounded-circle text-960401 p-2">
              track_changes
            </span>
          </div>
          <h4 class="font-netflix-md my-3">Goals</h4>
          <div class="px-3">
            <small class="font-netflix text-muted">To enhance the capacity of socio-economic researchers in Luzon and tap the potential of the socio-economic R&D sector in providing technical assistance to the other research sectors (e.g. crops, livestock, forestry, and fishery).
            </small>
          </div>
        </div>
      </div>
      <div class="col-lg-12 rounded px-lg-4 px-3 py-3 bg-light border-bottom-objectives">
        <h4 class="font-netflix-md px-3 my-2">Objectives</h4>
        <div class="px-3 pb-3">
          <small class="text-muted font-netflix">The SERDAC-Luzon generally aims to enhance the capacity of socio-economic researchers in Luzon and tap the potential of the socio-economic R&D sector in providing technical assistance to the other research sectors (e.g. crops, livestock, forestry, and fishery). Specific objectives are to:</small>  
        </div>
        <div class="row m-0">
          <div class="col-lg-6 px-0">
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">1</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">establish a venue for excellence in socio-economic R&D,</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">2</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">enhance socio-economic researchers’ access to licensed software and relevant journals,</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">3</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">provide facilities equipped with appropriate equipment for research,</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">4</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">provide training, seminars and coaching on socio-economic analysis,</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">5</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">provide socio-economic technical assistance to the other R&D sectors,</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">6</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">provide assistance to PCAARRD on capacity building-related initiatives, and</small>
                </span>
              </div>
            </div>
            <div class="obj-card bg-white py-2 px-3 my-1 rounded border">
              <div class="d-flex align-items-center">
                <h3 class="m-0 font-netflix-md font-weight-bold">7</h3>
                <span class="d-flex align-items-center px-2">
                  <small class="font-netflix text-muted">serve as repository of socio-economic and demographic data in Luzon,</small>
                </span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <img src="{{ url('import\assets\images\contents\objective.png') }}" class="d-block w-75" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row m-0 mt-4">
  <div class="col-lg-12">
    <div class="partners-section-header text-center ">
      <p class="text-uppercase hr-uplines font-netflix-md">
        <small>Connections <i class="fa fa-connectdevelop pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">Our Partners</h2>
      <p class="text-center mx-lg-4 px-4 font-netflix">
        This project is funded by DOST-PCAARRD. Central Luzon State University and R&D Center is responsible for management. 
        And we also build partnership with the University of Southeastern Philippines (USP), Visayas State University(VSU) and University of the Philippines Los Baños(UPLB).
      </p>
    </div>
  </div>
  <div class="col-lg-12 d-inline p-2 text-center">
    <img src="{{ url('import\assets\images\logo\funder\pcaarrd-logo.png') }}" class="m-3" width="100" alt="">
    <img src="{{ url('import\assets\images\logo\management\clsu-logo.png') }}" class="m-3" width="100" alt="">
    <img src="{{ url('import\assets\images\logo\management\clsu-rc-logo.png') }}" class="m-3" width="100" alt="">
    <img src="{{ url('import\assets\images\logo\partnerships\usp-logo.png') }}" class="m-3" width="100" alt="">
    <img src="{{ url('import\assets\images\logo\partnerships\vsu-logo.png') }}" class="m-3" width="100" alt="">
    <img src="{{ url('import\assets\images\logo\partnerships\uplb-logo.png') }}" class="m-3" width="100" alt="">
  </div>
</div>
{{-- CONTACT-US SECTION --}}
<section id="contact-us"></section>
<div class="row m-0 mt-4 d-flex justify-content-center">
  <div class="col-lg-12">
    <div class="contact-us-section-header text-center">
      <p class="text-uppercase hr-uplines font-netflix-md">
        <small>Contact Us <i class="fa fa-phone-square pl-2" aria-hidden="true"></i></small>
      </p>
      <h2 class="hr-lines">Let's Get in Touch.</h2>
      <p class="text-center mx-lg-4 px-4 font-netflix">
        Ready to start your next project with us? That's great! 
        Give us a call or send us an email and we will get back to you as soon as possible!
      </p>
    </div>
  </div>
  <div class="row m-0 py-3 px-2">
    <div class="col-lg text-justify px-lg-5 py-2">
      <h4 class=" font-netflix-md">Where to Find us?</h4>
      <small class="font-netflix">
        The establishment of the Luzon Socio-economic Research and Data Analytics Center (SERDAC-Luzon) 
        is very important because this supports the research capability of the institution, faculty and staff in 
        the field of socio-economics. With this, researchers in the Luzon can now access to analytical tools that 
        will enhance the conduct of socio-economic research.
      </small>
      <div class="location-email py-3 font-netflix">
        <i class="fa fa-map-marker"></i><b> Location:</b>
        <small> 
          SERDAC, Seed Laboratory and ICT Building. Research Avenue, Central Luzon State University. Science City of Muñoz, Nueva Ecija 3120
        </small>
        <br>
        <i class="fa fa-envelope"></i><b> Email:</b>
        <small><a class="contact-email" href="mailto:serdac_luzon@clsu.edu.ph">serdac_luzon@clsu.edu.ph</a></small>
        <br>
        <i class="fa fa-phone"></i><b> Tel. No.:</b>
        <small> 044-456-0704</small>
      </div>
    </div>
    <div class="concerns col-lg text-justify px-lg-5 pt-2">
      <h4 class=" font-netflix-md">Any Concerns? </h4>
      @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show">
        <span>Concern submitted <strong>Successfully!</strong></span>
         <button type="button" class="close" data-dismiss="alert">
           <span> &times; </span>
         </button>
       </div>
      @endif  
      <form action="{{route('concern')}}" method="POST" autocomplete="off">
        @csrf
        <div class="form-row mt-2">
          <div class="form-group col-md-6">
            <input type="text" class="form-control" placeholder="Name" name="name" required autocomplete="name">
          </div>
          <div class="form-group col-md-6">
            <input type="email" class="form-control" placeholder="Email" name="email" required autocomplete="email">
          </div>
          <div class="form-group col-md-12">
            <input type="text" class="form-control" placeholder="Phone" name="phone" required autocomplete="cc-number">
          </div>
          <div class="form-group col-md-12">
            <textarea class="form-control" name="concern" placeholder="How can we help you?" style="height:150px;" required></textarea>
            {{-- <input type="submit" name="" id="" class="btn btn-success w-100 mt-2"> --}}
            <button type="submit" class="btn btn-success w-100 mt-2">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection