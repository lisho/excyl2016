

$(document).ready(function() {
  
  $('.motivacion').change(function(event) {
    var motivacion = $(this).val();

    motivacion_ajax($(this).attr("data-id"), motivacion);
  });

  $('.habilidades').change(function(event) {
    var habilidades = $(this).val();

    habilidades_ajax($(this).attr("data-id"), habilidades);
  });

  $('.habitos').change(function(event) {
    var habitos = $(this).val();

    habitos_ajax($(this).attr("data-id"), habitos);
  });

  $('.especialidad').change(function(event) {
    var especialidad = $(this).val();

    especialidad_ajax($(this).attr("data-id"), especialidad);
  });

  $('.dificultades').change(function(event) {
    var dificultades = $(this).val();

    dificultades_ajax($(this).attr("data-id"), dificultades);
  });

  $('.observaciones').change(function(event) {
    var observaciones = $(this).val();

    observaciones_ajax($(this).attr("data-id"), observaciones);
  });



});

function motivacion_ajax (id,motivacion) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        motivacion: motivacion
      },

      dataType: "json",

    });

}

function habilidades_ajax (id,habilidades) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        habilidades: habilidades
      },

      dataType: "json",

    });

}

function habitos_ajax (id,habitos) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        habitos: habitos
      },

      dataType: "json",

    });

}

function especialidad_ajax (id,especialidad) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        especialidad: especialidad
      },

      dataType: "json",

    });

}

function dificultades_ajax (id,dificultades) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        dificultades: dificultades
      },

      dataType: "json",

    });

}

function observaciones_ajax (id,observaciones) {

    $.ajax({
      type: "POST",
      //url: "<?= Router::url(['controller=>Candidatos','action'=>'valoracion_update']); ?>",
      url: "/rgc_cake/candidatos/valoracion_update/",
      data:{
        id: id,
        observaciones: observaciones
      },

      dataType: "json",

    });

}
