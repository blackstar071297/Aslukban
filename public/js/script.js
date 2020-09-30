$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('select').formSelect();
    $('.pushpin').pushpin();
    $('.modal').modal();
    $(".dropdown-trigger").dropdown();
    $('.materialboxed').materialbox();
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
      });
});
