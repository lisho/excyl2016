 
$(function(){

    $('#loadbar').fadeOut(1000);

    $('a[href].efecto1').click(function() {

     if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
         && location.hostname == this.hostname) {

             var $target = $(this.hash);

             $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

             if ($target.length) {

                 var targetOffset = $target.offset().top;

                $('html,body').animate({scrollTop: targetOffset}, 1000);

    			$('.icono_grande').fadeIn(2500);

					return false;
            }
       }

   	});
    
    $('.crecer_campo1').focusin(function(event) {
        $('.crecer_cuadro1').width(400);  
      });
    $('.crecer_campo1').focusout(function(event) {
        $('.crecer_cuadro1').width('auto');
      });
    $('.crecer_campo2').focusin(function(event) {
        $('.crecer_cuadro2').width(400);  
      });
    $('.crecer_campo2').focusout(function(event) {
        $('.crecer_cuadro2').width('auto');
      });
   

});


function filtro(url,contenido1,contenido2,contenido3) {

		if (contenido2 && contenido3) { window.location.href = url+'/'+contenido1+'/'+contenido2+'/'+contenido3; }

    else { window.location.href = url+'/'+contenido1; }


   
   	};

