$(document).ready(function(){
    $('.primary-image-trigger').click(function(e){
      e.preventDefault();
      // $('#primary-image').trigger('click')
      // $('#primary-image').change(function(e){
      //   console.log($('#primary-image')[0].files[0]['name'] );
      //   $('#primary-image-preview').attr('src',URL.createObjectURL(e.target.files[0]));
      // });
      // let img = $('<img/>',{
      //   src: '/images/AS.png',
      //   height: '150px'
      // });
      // let a = $('<a></a>',{
      //   href: '#'
      // });
      // let div = $('<div></div>',{
      //   class: 'col l3'
      // });
      // img.appendTo(a);
      // a.prependTo(div);
      // div.prependTo('.image-row');
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
        console.log(selected);
      });
     
      
    });
    $()




    $('.sidenav').sidenav();
    $('.carousel').carousel();
    $('select').formSelect();
    $('.pushpin').pushpin();
    $('.modal').modal();
    $(".dropdown-trigger").dropdown();
    $('.materialboxed').materialbox();
    $('.collapsible').collapsible();
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
      });
});
