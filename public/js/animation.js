$(document).ready(function(){

    $('.addToCart').click(function(e){
        console.log($(this));
        e.preventDefault();
        let card = $(this).closest('.card');
        card.find('.card-image').find('img').clone().addClass('zoom').prependTo($('.shopping-cart'));
        setTimeout(function(){
            $('.zoom').remove();

        },1500);
        $(this).unbind('click').click();
    });
    $.fn.isInViewport = function() {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
    
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
    
        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    $(window).on('resize scroll load', function() {

        $('.show-on-scroll').each(function(index){
            if ($(this).isInViewport()) {
                // do something 
                setTimeout(function() {
					add($('.show-on-scroll')[index]);
				}, 200*index);
                
            } else {
                // do something else
                
            }
        });
    });
    function add(element){
            $(element).addClass('is-visible');
    }
    function remove(element){
        $(element).removeClass('is-visible');
    }
    setInterval(function () {
        let top = $(window).scroll().scrollTop();
        if(!$('.carousel:hover').length == 0 || top > 500){
            clearInterval();
        }else{
            $('.carousel').carousel('next');
        }
    },4000);
    //navbar animation
    setInterval(function () {
        let top = $(window).scroll().scrollTop();
        if(top > 150){
            $('#navbar-fixed').addClass('navbar-fixed');
            
        }else{
            $('#navbar-fixed').removeClass('navbar-fixed');
        }
    },100);

   
});

    


