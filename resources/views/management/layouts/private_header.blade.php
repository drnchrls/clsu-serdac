<header>
  <div class="row m-0 border-bottom shadow-sm bg-white">
    <div class="col-lg-12 pl-5">
      <div class="row m-0">
        <div class="col-md-6">
          <div class="private-user d-flex align-items-center justify-content-left p-2 mt-2 text-left">
            <div class="user-icon p-2">
              <span class="round d-flex align-items-center justify-content-center font-netflix-md" id="profile-initials"></span>
            </div>
            <div class="user-details">
              <small><b>{{ Auth::guard('staff')->user()->staff_email }}</b></small><br>
              <small class="text-muted" id="fname">{{ Auth::guard('staff')->user()->staff_fname }}</small>
            </div>
          </div>
        </div>
        <div class="local-time col-md-6 p-2 mt-2">
          <div class="row m-0 ">
            <div class="col-lg-12 text-right">
              <small><b>Philippine Standard Time</b></small>
            </div>
          </div>
          <div class="col-md-12 text-right">
            <small id='ct'></small>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    var element = document.getElementById('fname'); 
    var text = element.textContent;
    
    var firstLetter = text.charAt(0);
  
    $('#profile-initials').html(firstLetter);
  
  </script>
</header>