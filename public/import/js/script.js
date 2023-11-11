
    const navLinkEls = document.querySelectorAll('.nav-link');
    const sectionEls = document.querySelectorAll('section');
    let currentSection = 'home';
    window.addEventListener('scroll',() =>{
        sectionEls.forEach(sectionEl =>{
            if (window.scrollY >= sectionEl.offsetTop - 100){
                currentSection = sectionEl.id;
            }
        });
        navLinkEls.forEach(navLinkEl => {
            if(navLinkEl.href.includes(currentSection)){
                document.querySelector('.current').classList.remove('current');
                navLinkEl.classList.add('current');
            }
        });
    });

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const collapsibleDiv = document.getElementById('collapsible-div');
    const navbarOffset = navbar.offsetTop;
  
    function toggleDivDisplay() {
      if (window.pageYOffset >= navbarOffset) {
        collapsibleDiv.classList.add('my-div-show');
      } else {
        collapsibleDiv.classList.remove('my-div-show');
      }
  
      if (window.pageYOffset >= navbarOffset) {
        navbar.classList.add('navbar-scroll'); 
      } else {
        navbar.classList.remove('navbar-scroll');
      }
    }
  
    toggleDivDisplay();
    window.addEventListener('scroll', toggleDivDisplay);
  });

  $(document).ready(function () {


    $(document).on("click", function (e) {

        if (!$(e.target).is('.navbar, .navbar *')) {
            $('.navbar-collapse').removeClass('show');
        }
        
    });

    $('#galleryCarousel').owlCarousel({
        loop:true,
        lazyLoad:true,
        center:true,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:4000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1.2,
                margin:5,
                nav:false
            },
            600:{
                items:2,
                margin:5,
                loop:true
            },
            800:{

                items: 2.5,
                margin:5,
                loop:true
            },
            1000:{
                items: 3,
                margin:5,
                loop:true
            }
            
        }
    });
    

    $('#announcementCarousel').owlCarousel({
        loop:true,
        lazyLoad:true,
        center:true,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1.3,
                nav:false,
                loop:true
            },
            1000:{
                items:2.5,
                nav:false,
                loop:true
            },
            1400:{
                items:3,
                nav:false,
                loop:true
            }
            
        }
    });
 
});

    lightbox.option({
        'resizeDuration':300,
        'wrapAround':true,
        'showImageNumberLabel':false,
        'disableScrolling':true
    })
    
    
    // function disableCtrlScroll(event) {
    //     if (event.ctrlKey && (event.deltaY || event.detail || event.wheelDelta)) {
    //         event.preventDefault();
    //     }
    // }
    // if (window.addEventListener) {
    //     window.addEventListener('DOMMouseScroll', disableCtrlScroll, { passive: false }); // Firefox
    //     window.addEventListener('mousewheel', disableCtrlScroll, { passive: false }); // Chrome, Safari, IE, Edge
    // }
  
  