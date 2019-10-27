
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


//
//    function add_file(){
//      var new_chq_no = parseInt($('#total_chq').val())+1;
////      var new_input="<input class='new_input input_style' type='text' id='new_"+new_chq_no+"'>";
//    
//      var new_input="<div class='mt-5px custom-file'><input type='file' class='custom-file-input' id='new_"+new_chq_no+" customFile'><label class='custom-file-label' for=''customFile>Choose file</label></div>";
//        
//      $('#new_style').append(new_input);
//      $('#total_chq').val(new_chq_no);
//
//    }
//
//    function remove_file(){
//      var last_chq_no = $('#total_chq').val();
//      if(last_chq_no>1){
//        $('#new_'+last_chq_no).remove();
//        $('#total_chq').val(last_chq_no-1);
//        
//         
//      }
//    }
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