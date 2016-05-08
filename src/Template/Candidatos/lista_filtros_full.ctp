<?php $url = $this->Url->build(['action'=>'lista_filtros_full']);?>


<script type="text/javascript">
    
    $(document).ready(function() {

        $('select[name=plaza]').change(function() {

                    var contenido1 = $('select[name=plaza]').val();
                    var url = '<?= $url; ?>'
                   
                    filtro(url,contenido1);
                });
    });

</script>


    <?php
   
        $plazas_opciones = [    $plaza_default => $plaza_default,
                                'todos los candidatos' => 'todos los candidatos',
                                'obra publica' =>  'obra publica',
                                'barrendero' => 'barrendero',
                                'conserje' => 'conserje'
                            ];

        if ($plaza_default === '') {
            $plaza_default = 'todos los candidatos';
        } 

        $m=0;
        $edu='';
   
    ?>
<hr>
<div class="content">
                  
        <div class="row"> 
            <div class="col-md-12">
            
                <div class="col-md-6 left">
                    <h2>Selección EXCYL 2016 <small>Ayuntamiento de León</small></h2>
                </div>
                    

                <div class="col-md-3">
                    <span><small>Filtrar por PLAZA</small></span>
                    <?= $this->Form->select('plaza', $plazas_opciones);?>
                </div>
                <div class="col-md-3 icono_plaza text-right">
                        
                        <?php   if($plaza_default === 'barrendero') {echo $this->Html->image('barrendero.svg',['height'=>'30px','width'=>'30px','class' => '']);}
                                elseif ($plaza_default  === 'conserje'){echo $this->Html->image('conserje.svg',['height'=>'30px','width'=>'30px']);} 
                                elseif ($plaza_default  === 'obra publica'){echo $this->Html->image('obras.svg',['height'=>'30px','width'=>'30px']);}
                                elseif ($plaza_default  === 'todos los candidatos'){echo $this->Html->image('barrendero.svg',['height'=>'30px','width'=>'30px']);
                                                                                    echo $this->Html->image('conserje.svg',['height'=>'30px','width'=>'30px']);
                                                                                    echo $this->Html->image('obras.svg',['height'=>'30px','width'=>'30px']);
                                                                                    }
                        ?>
                    
                </div>
                
            </div>
        </div>
<hr>
        
        <div class="col-md-12">
        
        <?php foreach ($listado as $candidato): ?>

            <?php

                switch ($candidato['estudios']) {
                    
                    case '':
                        $edu="<span class='glyphicon glyphicon-question-sign'></span> ";
                        break;
                    case 'ANALFABETOS          ':
                        $edu="<span class='glyphicon glyphicon-text-background'></span> ";
                        break;
                    case 'SIN ESTUDIOS         ':
                        $edu="<span class='glyphicon glyphicon-education'></span> ";
                        break;
                    case 'ESTUDIOS PRIMARIOS':
                        $edu="<span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span>";
                        break;
                    case 'EDUCACION SECUNDARIA OBLIGATORIA/GARANTIA SOCIAL':
                        $edu="<span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span>";
                        break;
                     case 'BACHILLER/FP GRADO MEDIO':
                        $edu="<span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span>";
                        break;
                    case 'UNIVERSITARIO/FP GRADO SUPERIOR':
                        $edu="<span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span><span class='glyphicon glyphicon-education'></span>";
                        break;
                    
                    default:
                        // code...
                        break;
                }

            ?>

            
            <?php if ($candidato['plaza']===$plaza_default||$candidato['plaza2']===$plaza_default||$candidato['plaza3']===$plaza_default||$plaza_default=== 'todos los candidatos'): ?>
                <?php $m++ ?>
                <div class="col-lg-3 col-md-6 ficha">
                   
                    <?php
                   // Codigo color de empleabilidad

                        if ($candidato['motivacion'] === 'Si' && $candidato['habilidades'] === 'Si' && $candidato['habitos'] === 'Si'){
                           $codigo_color= 'success'; 
                           $codigo_color_dni = 'dni_empleable';
                        } elseif ($candidato['motivacion'] === 'No' && $candidato['habilidades'] === 'No' && $candidato['habitos'] === 'No'){
                            $codigo_color= 'danger'; 
                            $codigo_color_dni = 'dni_inempleable';
                        }elseif ($candidato['motivacion'] === 'Sin valorar' || $candidato['habilidades'] === 'Sin valorar' || $candidato['habitos'] === 'sin valorar'){
                            $codigo_color= 'default'; 
                            $codigo_color_dni = 'dni_Sin_valorar';
                        }elseif ($candidato['motivacion']===''|| $candidato['habilidades']==='' || $candidato['habitos']==='' ){
                            $codigo_color= 'info'; 
                            $codigo_color_dni = 'dni_desconocido';
                        }else {
                            $codigo_color= 'warning'; 
                            $codigo_color_dni = 'dni_dudoso';
                        } 
                    ?>

                    <div class="panel panel-<?= $codigo_color; ?>">

                        <div class="panel-heading row">
                            
                            
                            <div class="col-xs-8"><?= $candidato['nombre_completo']; ?></div>
                                                        
                            <div class="col-xs-4 text-right">

                                    <?= $this->element('iconos_profesion',[
                                                                    'plaza1'=> $candidato['plaza'],
                                                                    'plaza2'=> $candidato['plaza2'],
                                                                    'plaza3'=> $candidato['plaza3']
                                                    ]); ?>
                            </div>

                        </div>

                        <div class="panel-body">
                            
                            <?php 
                                if(in_array($candidato['dni'], $nomina)){  
                                        echo '<span class="glyphicon glyphicon-ok-sign correcto"></span>';
                                } else {
                                        echo '<span class="glyphicon glyphicon-remove-sign incorrecto"></span>'; 
                                    }
                            ?>
                            <?php
                                
                                echo $this->element('iconos_valoracion', [
                                                                            'val1'=>$candidato['motivacion'], 
                                                                            'val2' => $candidato['habilidades'], 
                                                                            'val3' => $candidato['habitos'],
                                                                            'dificultades' => $candidato['dificultades'],
                                                                            'observaciones' => $candidato['observaciones'],
                                                                            'm' => $m,
                                                                            'clasificacion' => $candidato['clasificado']]);
                             ?>
                             
                        </div>

                        <div class="panel-footer">
                            <div type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal<?= $m;?>">
                                  <span class="glyphicon glyphicon-info-sign"></span>
                            </div>

                            <!-- Modal -->
                                <div class="modal fade" id="myModal<?= $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']."&nbsp&nbsp(".$candidato['edad']." años)"; ?></h4>
                                      </div>
                                      <div class="modal-body">
                                        
                                        <?php if ($candidato['clasificado']!='Coyuntural' && ($candidato['numrgc']==='' || $candidato['tedis']==='')):  ?>
                                            <h4>No tenemos datos de este expediente. Si en la ficha tiene un asterisco rojo, no está en nómina de RGC en León. Si aparece en nómina (check verde), la falta de datos se puede deber a que:</h4>
                                            <ul>
                                                <li>Venga de otro municipio y no lo haya cargado gerencia para valoración (por lo que no ha pasado comisión en León).</li>
                                                <li>Hay algún error en el DNI y/o en el número de expediente de RGC.</li>
                                                <li>Al cargarlo en nuestra base, el que lo hizo tenia dos manos izquierdas y estaba sentado sobre ellas...</li>
                                            </ul>
                                        <?php else: ?>
                                            <p>DNI/NIE: <strong><?= $candidato['dni']; ?></strong></p>
                                            <p>Expediente EDIS: <strong><?= $candidato['numedis']; ?></strong></p>
                                            <p>Expediente RGC: <strong><?= $candidato['expediente_gerencia']; ?></strong></p>
                                            <p>TEDIS: <strong><?= $candidato['tedis']; ?></strong></p>
                                            <p>CEAS de Referencia: <strong>
                                                <?php 
                                                    if($candidato['ceas']!=''){
                                                        echo $ceas[$candidato['ceas']]; 
                                                    }else{
                                                        echo "Se desconoce";
                                                    }
                                                ?></strong></p>
                                            
                                            <p class="dropdown-header">Contacto</p>

                                            <p>&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-phone-alt">&nbsp&nbsp</span><strong><?= $candidato['telefono']; ?></strong></p>
                                            
                                           
                                            <p class="dropdown-header">Formación Académica:</p>
                                            <p>&nbsp&nbsp&nbsp<strong><big><?= "&nbsp&nbsp".$edu; ?></big></strong></p>-->
                                          <?php endif ?>    
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div><!-- End Modal-->


                                 <!-- ModalVal -->
                                <div class="modal fade" id="myModalval<?= $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']."&nbsp&nbsp(".$candidato['edad']." años)"; ?>
                                        </h4>
                                        <h4><small>(<?= $candidato['clasificado'];?>)</small></h4>
                                      </div>
                                      <div class="modal-body">


                                        
                                            <div class="row text-center">
                                              <div class="col-xs-4">
                                                    <p class="dropdown-header">Motivación:</p>
                                                    <div class="indicador <?= $candidato['motivacion']; ?>"><?= $candidato['motivacion'];?></div>
                                              </div>
                                              <div class="col-xs-4">
                                                    <p class="dropdown-header">Hábitos:</p>
                                                    <div class="indicador <?= $candidato['habitos']; ?>"><?= $candidato['habitos'];?></div>
                                              </div>
                                              <div class="col-xs-4">
                                                    <p class="dropdown-header">Habilidades:</p>
                                                    <div class="indicador <?= $candidato['habilidades']; ?>"><?= $candidato['habilidades'];?></div>
                                              </div>
                                            </div>
                                                    <p class="dropdown-header">Dificultades:</p>
                                                    <span><?= $candidato['dificultades']; ?></span>        
                                                    <p class="dropdown-header">Observaciones:</p>
                                                    <span><?= $candidato['observaciones']; ?></span>

                                            
                                          
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div><!-- End Modal-->
                        
                        </div> <!-- End Panel Footer-->
                        

                    </div>
                        

                </div>
            
            <?php endif ?>

        <?php endforeach ?>

        </div>



</div> <!-- END DIV-CONTENT -->
            <div class="cuenta_candidatos">
                <span><?php echo $m; ?></span>
            </div>      
<div class="bloque_fin"></div>

<?= $this->Html->script('valoraajax.js') ?>