$(function(){
    $('.main-carousel').owlCarousel({
        rtl:true,
        loop:true,
        margin:20,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
    $('.carousel-panels').owlCarousel({
        rtl:true,
        loop:true,
        mouseDrag:false,
        margin:20,
        nav:false,
        dots:false,
        URLhashListener:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
    


    $(".btn-cart").click(function(){
        $(this).toggleClass('bi-cart');
        $(this).toggleClass('bi-cart-fill');
        $(this).toggleClass('action');
      });

      $(".btn-heart").click(function(){
        $(this).toggleClass('bi-heart');
        $(this).toggleClass('bi-heart-fill');
        $(this).toggleClass('action');
      });

      $(".btn-open-menu , .btn-close-menu , .overlay-close").click(function(){
        $('.mobile-menu-body').toggleClass('show');
        $('.overlay-close').toggleClass('show');
      });

      
      $(".form-check.sort-by-range").click(function(){
        $(this).addClass('active').siblings('.form-check.sort-by-range').removeClass('active');
      });
      $(".hash-carousel .item").click(function(){
        $(this).addClass('active').siblings('.hash-carousel .item').removeClass('active');
      });
      $(".section-details-panel .radio-product-color").click(function(){
        $(this).addClass('active').siblings('.section-details-panel .radio-product-color').removeClass('active');
        let changes_color = $(this).data('product-color');
        $('.product-color').text(changes_color);
      });
      $(".form-check.radio-add-accessories").click(function(){
        $(this).addClass('active').siblings('.form-check.radio-add-accessories').removeClass('active');
      });
      $(".dropdown .dropdown-toggle").click(function(){
        $(this).siblings('.dropdown-menu').slideToggle();
      });
      $(".dropdown .dropdown-toggle").blur(function(){
        $(this).siblings('.dropdown-menu').slideUp();
      });
   
   


      $(".form-check.sort-by-keyword").click(function(){
        $(this).toggleClass('active');
      });
      $(".sort-by-keyword *").click(function(){
        $(this).parentsUntil(".sort-by-keyword").parent().click();
      });
    
  

      $('.quantity-of-product').on('click', '.bi-plus', function(e) {
        let $input = $(this).siblings('.btn-quantity-product');
        let val = parseInt($input.val());
        $input.val( val+1 ).change();
    });

    $('.quantity-of-product').on('click', '.bi-dash', 
        function(e) {
        let $input = $(this).siblings('.btn-quantity-product');
        var val = parseInt($input.val());
        if (val > 1) {
            $input.val( val-1 ).change();
        } 
    });
    $(".product-in-cart .bi-trash").click(function(){
        $(this).parentsUntil(".product-in-cart").parent().remove();
      });

      $(".btn-eye").click(function(){
        $(this).toggleClass('bi-eye');
        $(this).toggleClass('bi-eye-slash');
        let x = $(this).siblings();
        x.attr('type', x.attr('type') === 'password' ? 'text' : 'password');
      });


      
      $(document).ready(horizontalSteps);
      $(window).on('resize load',horizontalSteps);
      
      function horizontalSteps() {
          var horizontalSteps = document.getElementById('horizontal-steps'); // ol
          // var hswidth = horizontalSteps.clientWidth(); // ol width
          // var numberArray = Array.from(horizontalSteps.children).length-1; // ol.length
          //  $('.horizontal-steps-item span').css("width", ((hswidth - (60 * (numberArray+1))) / (numberArray))  + "px");
      }
      

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
});