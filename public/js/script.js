$(document).ready(function(){
    // custom input group
    $('.input-number-increment').click(function() {
      var $input = $(this).parents('.input-number-group').find('.input-number');
      var val = parseInt($input.val(), 10);
      
      if($('.input-number-group > .input-number').val() < 100 ){
        $input.val(val + 1);
      }
      
    });
    
    $('.input-number-decrement').click(function() {
      var $input = $(this).parents('.input-number-group').find('.input-number');
      var val = parseInt($input.val(), 10);
      
      if($('.input-number-group > .input-number').val() > 1 ){
        $input.val(val - 1);
      }
    })
    
    
    $('.primary-image-trigger').click(function(e){
      e.preventDefault();

      $('#product_images').trigger('click');
      $('#product_images').change(function(e){
              
        $('.image-row').empty();
        let selected = [];
        
        for(let i=0;i<$('#product_images')[0].files.length;i++){
          selected.push($('#product_images')[0].files[i]);
        }
        for(let j = 0;j<selected.length;j++){
          let img = $('<img/>',{
            src: URL.createObjectURL(selected[j]),
            height: '150px',
            width: '150px'
          })
          let a = $('<a></a>',{
            href: '#',
            class: 'delete-image',
            id: j
          })
          let div = $('<div></div>',{
            class: 'col l3 mb-1'
          })
          img.appendTo(a)
          a.prependTo(div)
          div.prependTo('.image-row');  
        }
      });
     
      
    });

    //For cart page
    $('#allCheckbox').click(function(){
      if($(this).prop('checked')==true){
        
        $('.checkout-product').each(function(){
          $(this).prop('checked',true);
          
        });
      }else if($(this).prop("checked") == false){
        
        $('.checkout-product').each(function(){
          $(this).prop('checked',false)
          
        });
      }
    });
    $('#product-carousel').carousel({
      dist: 0,
      noWrap: true,
      indicators: true
    });
    $('.materialboxed').materialbox();
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('select').formSelect();
    $('.pushpin').pushpin();
    $('.modal').modal();
    $(".dropdown-trigger").dropdown();
    $('.materialboxed').materialbox();
    $('.collapsible').collapsible();
    let carouselHeight = $(".carousel.carousel-slider >.carousel-item.active img").height();
    console.log(carouselHeight);
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true,
      }).height(carouselHeight);
    $('.tabs').tabs();
    $('.tabs').tabs('select','profile_tab');
    $('.datepicker').datepicker();
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
    $('.tooltipped').tooltip();
    $('.collapsible').collapsible();
    $('.fixed-action-btn').floatingActionButton();
    $('.parallax').parallax();
    $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
          $('.scrollToTop').fadeIn();
      } else {
          $('.scrollToTop').fadeOut();
      }
  });
  
  //Click event to scroll to top
  $('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
  });

  $('#reset_btn').click(function(e){
    e.preventDefault();
    $('input:checkbox').attr('checked',false);
    $('input:checkbox').each(function(){
      console.log($(this).val());
      $(this).prop('checked',false);
      $('#query').val(null);
    });
    $(this).unbind('click').click();
  })
});
