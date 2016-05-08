

$(document).ready(function() {
  
  $('.nota1').change(function(event) {
    var nota = $(this).val();

    nota_ajax($(this).attr("data-id"), nota);
  });

  $('.nota2').change(function(event) {
    var nota = $(this).val();

    nota_ajax($(this).attr("data-id"), nota);
  });

  $('.nota3').change(function(event) {
    var nota = $(this).val();

    nota_ajax($(this).attr("data-id"), nota);
  });



  $('.corrector1').change(function(event) {
    var corrector = $(this).val();

    corrector_ajax($(this).attr("data-id"), corrector);
  });

  $('.corrector2').change(function(event) {
    var corrector = $(this).val();

    corrector_ajax($(this).attr("data-id"), corrector);
  });

  $('.corrector3').change(function(event) {
    var corrector = $(this).val();

    corrector_ajax($(this).attr("data-id"), corrector);
  });  



  $('.check1').change(function(event) {
    var renuncia = $(this).val();

    if (renuncia==1) {renuncia=0; }
    else {renuncia=1; }

    renuncia_ajax($(this).attr("data-id"), renuncia);
  });

  $('.check2').change(function(event) {
    var renuncia = $(this).val();

    if (renuncia==1) {renuncia=0; }
    else {renuncia=1; }

    renuncia_ajax($(this).attr("data-id"), renuncia);
  });

  $('.check3').change(function(event) {
    var renuncia = $(this).val();

    if (renuncia==1) {renuncia=0; }
    else {renuncia=1; }

    renuncia_ajax($(this).attr("data-id"), renuncia);
  });  

});


function nota_ajax (id,nota) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/excyl2016/calificacion_update/",
      data:{
        id: id,
        nota: nota
      },

      dataType: "json",

    });

}

function corrector_ajax (id,corrector) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/excyl2016/calificacion_update/",
      data:{
        id: id,
        corrector: corrector
      },

      dataType: "json",

    });

}

function renuncia_ajax (id,renuncia) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/excyl2016/calificacion_update/",
      data:{
        id: id,
        renuncia: renuncia
      },

      dataType: "json",

    });

}

