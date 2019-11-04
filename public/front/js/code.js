$(window).on('load', function () {
    
    $(".loading-overlay .spinner").fadeOut(1500,function(){
        $("body").css("overflow-y","auto");
        $(".loading-overlay").fadeOut(1000);
        
    }); 
});


function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $(".sidenav .nav-link").show();
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $(".sidenav .nav-link").hide();
    }

    
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });

    // scroll up //
    
    $(function () {  
      var scrollButton = $('#scroll-top');
      $(window).scroll(function() {
        $(this).scrollTop() >= 500 ? scrollButton.show() : scrollButton.hide();
      });
      scrollButton.click(function() {
        $('html,body').animate({ 
          scrollTop : 0 
        });
      });
    });
    

/// validation ////
//$(function (){
//   'use strict';
//    
//        /// fuction Error
//    var emailError = true,
//        passError = true;
//    
//    function checkError(){
//        if (emailError === true || passError === true ){
//             console.log("Error");
//        }else{
//            console.log("NO Error");
//        }
//    }
//    
//        
//            //validate-email
//    $(".email").blur(function(){
//       if ($(this).val().length === 0) {
//           
////           $(this).css("border","1px solid #f00");
//           $('#validate-email').fadeIn(200);
//           
//           emailError = true;
//           
//       } else{
////           $(this).css("border","1px solid #0f0");
//           $('#validate-email').fadeOut(200);
//           
//           emailError = false;
//       }
//        
//        checkError();
//    });
//    
//    
//    $(".password").blur(function(){
//       if ($(this).val().length === 0) {
//           
////           $(this).css("border","1px solid #f00");
//           $('#validate-pass').fadeIn(200);
//           
//           passError = true;
//           
//       } else{
////           $(this).css("border","1px solid #0f0");
//           $('#validate-pass').fadeOut(200);
//           
//           passError = false;
//       }
//        checkError();
//        
//    });
//});

$(document).ready(function() {
    
     function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        $(".sidenav .nav-link").show();
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $(".sidenav .nav-link").hide();
    }
    
    $(function(){
        'use strict';
        var winH = $(window).height(),
            navH = $(".navbar").innerHeight();
        $(".carousel , .carousel-item").height(winH-navH);
    })
    
    $("#hv-down , .dropdown-menu").mouseenter(function(){
        $(".dropdown-menu").addClass("show");
    });
    $("#hv-down , .dropdown-menu").mouseleave(function(){
        $(".dropdown-menu").removeClass("show");
    });
    
    
    $("#normal-btn").click(function(){
        $("#normal-btn").addClass("active");
        $("#quick-btn").removeClass("active");
    });
    
    $("#quick-btn").click(function(){
        $("#normal-btn").removeClass("active");
        $("#quick-btn").addClass("active");
    });
    
    
    
    
    var owl = $(".cir-shop .owl-carousel");
    owl.owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:4,
                nav:false
            },
            1000:{
                items:6,
                nav:true,
                loop:false
            },
            1200:{
                items:7,
                nav:true,
                loop:false
            },
            1400:{
                items:10,
                nav:true,
                loop:false
            }
        }
    });
    
    
     var owl = $(".testmonials .owl-carousel");
     owl.owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:3,
                nav:true,
                loop:false
            }
        }
    });
    
    
    var owl = $(".owl-carousel");
    owl.owlCarousel({
        loop:true,
        margin:10,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
//                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            },
            1400:{
                items:6,
                nav:true,
                loop:false
            }
        }
    });
    
    $(function () {
 
  $("#rateYo").rateYo({
        rating: 3.2,
        rtl: true
      });

    });
    
    
});