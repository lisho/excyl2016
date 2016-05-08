<?php 

        

        // Codigo color de empleabilidad

            if ($val1 === 'Si' && $val2 === 'Si' && $val3 === 'Si'){
               $codigo_color= 'empleable'; 
               $codigo_color_dni = 'dni_empleable';
            } elseif ($val1 === 'No' && $val2 === 'No' && $val3 === 'No'){
                $codigo_color= 'inempleable'; 
                $codigo_color_dni = 'dni_inempleable';
            }elseif ($val1 === 'Sin valorar' || $val2 === 'Sin valorar' || $val3 === 'sin valorar'){
                $codigo_color= 'Sin_valorar'; 
                $codigo_color_dni = 'dni_Sin_valorar';
            }else {
                $codigo_color= 'dudoso'; 
                $codigo_color_dni = 'dni_dudoso';
            } 

?>

<div class="row">
    <div class="col-xs-6 ficha">
        <div type="button" class="btn btn-default btn-block mas_info" data-toggle="modal" data-target="#myModalval<?= $m;?>">
              <span class="glyphicon glyphicon-plus-sign"></span>
        </div>

    </div>

    <div class="col-xs-6 ficha text-center">
        <span class="ficha_clasificado">
        <?php
   
            if($clasificacion==='Estructural'){
                echo 'E';
            }elseif ($clasificacion==='Coyuntural') {
                echo 'C';
            }else {
                echo 'S/D';
            }
        ?>
        </span>
    </div>


    
<?php
    //echo '<p>Dificultades:'.$dificultades.'</p>';
    //echo '<p>Observaciones:'.$observaciones.'</p>';
?>
</div>




