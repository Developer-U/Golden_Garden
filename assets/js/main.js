window.addEventListener('DOMContentLoaded', function(){
    const more_info_btn = document.querySelector('.product-more-photo');

    if(more_info_btn) {
        more_info_btn.addEventListener('click', function(e){       

            const element = document.querySelector('#tab-title-tab_object_gallery a');        
            if (element) { 
                element.click();
              }
        });
    }    

    const availableScreenWidth = window.screen.availWidth;   
      
    // Открытие бургерного меню
    var menu = document.querySelector('.popup-menu')
    ,burger_open = document.querySelector('.burger')  
    ,burger_close = document.querySelector('.popup-close'); 

    burger_open.addEventListener('click', function(){         
        if( menu.classList.contains('opened') === false ) {
            menu.classList.add('opened');
            document.querySelector('body').classList.add('closed');
        } 

        // Скрытие меню при нажатии на один из пунктов меню

        document.querySelectorAll('.popup-menu__menu li a').forEach(function(oneItem){
            oneItem.addEventListener('click', function(){         
            menu.classList.remove('opened');
            document.querySelector('body').classList.remove('closed'); 
            });
        });
                
        menu.addEventListener('click', function(event) {            
            if( this == event.target) {
                console.log('это дальний слой');
                menu.classList.remove('opened');
                document.querySelector('body').classList.remove('closed');                   
              
            } else {
                console.log('это не дальний слой');
            }
        });
        
    });
    burger_close.addEventListener('click', function(){    
        if( menu.classList.contains('opened') === true ) {
            menu.classList.remove('opened');
            document.querySelector('body').classList.remove('closed');
        } 
    });

    /*Inputmask*/

    var selectors = document.querySelectorAll('input[type="tel"]');

    selectors.forEach(function(selector){
      var im = new Inputmask("+7(999)-999-9999");
      im.mask(selector);
    });

    var hero_swiper = new Swiper(".hero-slider", {
        slidesPerView: 1,    
        loop: true,     
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
    });

    var reviews_swiper = new Swiper(".reviews-slider", {
        slidesPerView: 1, 
        spaceBetween: 10,              
        navigation: {
          nextEl: ".up-button-next",
          prevEl: ".up-button-prev",
        },
        breakpoints: {
            // when window width is >= 768px
            768: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            1160: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1500: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
        }
    });

    Fancybox.bind("[data-fancybox]", {
        hideScrollbar: false,
      });
      

    jQuery(document).ready(function($) {
        var map_close_btn = $('.header-central .popup__close');
        var map_more_btn = $('.header-central .map-link');

      // Открытие / закрытие попапов
        //----- OPEN
       
        $('[data-popup-open]').on('click', function(e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);         

            e.preventDefault();  
            console.log(map_close_btn);          

            if( availableScreenWidth > 992) {
                map_close_btn.addClass('active');
                map_more_btn.addClass('active');
            }           
           
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function(e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();

            if( availableScreenWidth > 992) {
                map_close_btn.removeClass('active');
                map_more_btn.removeClass('active');
            }
        });

        $('.popup__wrapper').on('click', function(event) {
            if( this == event.target) {
            $('.popup').fadeOut(350);
            }
        });


        if( availableScreenWidth >= 992) {
            $('[data-popup-map-open]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-map-open');
                $('[data-popup-map="' + targeted_popup_class + '"]').fadeIn(350);         

                e.preventDefault();  
                console.log(map_close_btn);          

                
                    map_close_btn.addClass('active');
                    map_more_btn.addClass('active');
                          
            
            });

            //----- CLOSE
            $('[data-popup-map-close]').on('click', function(e) {
                var targeted_popup_class = jQuery(this).attr('data-popup-map-close');
                $('[data-popup-map="' + targeted_popup_class + '"]').fadeOut(350);

                e.preventDefault();

        
                    map_close_btn.removeClass('active');
                    map_more_btn.removeClass('active');
                
            });

        }
    });

    
});