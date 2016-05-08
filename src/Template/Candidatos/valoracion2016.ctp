<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Candidato'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clasificados'), ['controller' => 'Clasificados', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Clasificado'), ['controller' => 'Clasificados', 'action' => 'add']) ?></li>
    </ul>
</nav>
-->

<?php $url = $this->Url->build(['action'=>'valoracion2016']);?>


<script type="text/javascript">
    
    $(document).ready(function() {

        $('select[name=plaza]').change(function() {

                    var contenido1 = $('select[name=plaza]').val();
                    var contenido2 = $('select[name=tedis]').val(); // val obtiene el valor del elemento seleccionado....
                    var contenido3 = $('select[name=ceas]').val();
                   

                    var url = '<?= $url; ?>'
                   
                    filtro(url,contenido1,contenido2,contenido3);
                });


        $('select[name=tedis]').change(function() {

                    var contenido1 = $('select[name=plaza]').val();
                    var contenido2 = $('select[name=tedis]').val(); // val obtiene el valor del elemento seleccionado....
                    var contenido3 = $('select[name=ceas]').val();
                   

                    var url = '<?= $url; ?>'
                   
                    filtro(url,contenido1,contenido2,contenido3);
                });

        $('select[name=ceas]').change(function() {
                 
                    var contenido1 = $('select[name=plaza]').val();
                    var contenido2 = $('select[name=tedis]').val(); // val obtiene el valor del elemento seleccionado....
                    var contenido3 = $('select[name=ceas]').val();
                      
                    var url = '<?= $url; ?>'
                    
                    filtro(url,contenido1,contenido2,contenido3);
                });

    });

</script>

<div class="content">
        <p><strong></strong> 
             <strong></strong> </p>
             <div class="center"><h2>Valoración EXCYL 2016</h2></div>

        <div class="row"> 
            <div class="col-md-12">
            
                <div class="col-md-3">
                    <?= $this->Html->link(__('Ver todos sin filtros...'), ['action' => 'valoracion2016'], ['class'=>'btn btn-primary btn-lg margen_boton']); ?>
                </div>
                    <?php
                   
                    $plazas_opciones = [    $plaza_default => $plaza_default,
                                            'todos los candidatos' => 'todos los candidatos',
                                            'obra publica' =>  'obra publica',
                                            'barrendero' => 'barrendero',
                                            'conserje' => 'conserje'
                                        ];

                    $tedis_opciones = [ $tedis_default => $tedis_default,
                                    'todos los TEDIS' => 'todos los TEDIS',
                                    'LUIS ALBERTO GONZALEZ'=>'LUIS ALBERTO GONZALEZ',
                                    'MERCEDES MARNE'=>'MERCEDES MARNE',
                                    'ROSAURA SANCHEZ'=>'ROSAURA SANCHEZ',
                                    'HELENA MARSA NAVARRO'=>'HELENA MARSA NAVARRO',
                                    'MARIA PAZ BRAVO'=>'MARIA PAZ BRAVO',
                                    'MARIA ANGELES ARIAS'=>'MARIA ANGELES ARIAS',
                                    'NO DERIVADO'=>'NO DERIVADO',
                                    'PENDIENTE DE ASIGNAR'=>'PENDIENTE DE ASIGNAR'];
                    if ($ceas_default){

                         array_unshift($ceas, $ceas[$ceas_default]);
                    } else {
                        array_unshift($ceas, '');
                    }

                    ?>

                <div class="col-md-3">
                    <span><small>Filtrar por PLAZA</small></span>
                    <?= $this->Form->select('plaza', $plazas_opciones);?>
                </div>
                <div class="col-md-3">
                    <span><small>Filtrar por TEDIS</small></span>
                    <?= $this->Form->select('tedis', $tedis_opciones);?>
                </div>
                <div class="col-md-3">
                    <span><small>Filtrar por CEAS</small></span>
                    <?= $this->Form->select('ceas', $ceas);?>
                </div>
            </div>
        </div>

        <?php $m=0; ?>
        
          <div class="panel-warning">
            <div class="panel-heading" role="tab" id="headingOne">
              <h3 class="">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <span class="glyphicon glyphicon-list"></span>  Candidatos Estructurales - <?=  $tedis_default.' '; ?> 
                  <small><? if ($ceas_default){ echo 'en el CEAS de '.$ceas[$ceas_default];}; ?></small>
                </a>
              </h3>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
     
                <table class="table table-hover table-flow">
                    <thead>
                        <tr>
                            <td></td>
                            <td>dni</td>
                            <td>nombre</td>
                            <td>apellidos</td>
                            <td>+ datos</td>
                            <td>motivacion</td>
                            <td>habitos</td>
                            <td>habilidades</td>
                            <td>especialidad</td>
                            <td class="crecer_cuadro1">dificultades</td>
                            <td class="crecer_cuadro2">observaciones</td>

                        </tr>
                    </thead>

                    <tbody>
                        
                        <?php foreach ($lista_full as $candidato): ?>
                            
<?php if ($candidato['clasificado'] === 'Estructural'): ?>
                                       
                                              
                            <?php 
                                
                                $m++;
                                $edu='';
                               
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
                              

                                    if ($candidato['edad']>59) {
                                        $etiqueta = "label label-warning";
                                    }else {
                                        $etiqueta = "";
                                    }
                            
                            // Codigo color de empleabilidad

                                if ($candidato['motivacion'] === 'Si' && $candidato['habitos'] === 'Si' && $candidato['habilidades'] === 'Si'){
                                   $codigo_color= 'empleable'; 
                                   $codigo_color_dni = 'dni_empleable';
                                } elseif ($candidato['motivacion'] === 'No' && $candidato['habitos'] === 'No' && $candidato['habilidades'] === 'No'){
                                    $codigo_color= 'inempleable'; 
                                    $codigo_color_dni = 'dni_inempleable';
                                }elseif ($candidato['motivacion'] === 'Sin valorar' || $candidato['habitos'] === 'Sin valorar' || $candidato['habilidades'] === 'sin valorar'){
                                    $codigo_color= 'Sin_valorar'; 
                                    $codigo_color_dni = 'dni_Sin_valorar';
                                }else {
                                    $codigo_color= 'dudoso'; 
                                    $codigo_color_dni = 'dni_dudoso';
                                } 
                                
                            ?>   
            
                        <tr >
                            <td><span class="glyphicon glyphicon-tag asterisco <?= $codigo_color; ?>"></span><p><small>
                                <?php 

                                if ($candidato ['plaza']){
                                    switch ($candidato ['plaza']) {
                                        case 'obra publica':
                                            echo 'O ';
                                            break;

                                        case 'barrendero':
                                            echo 'B ';
                                            break;

                                        case 'conserje':
                                            echo 'C ';
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                }

                                if (isset($candidato ['plaza2'])){
                                    switch ($candidato ['plaza2']) {
                                        case 'obra publica':
                                            echo '-O ';
                                            break;

                                        case 'barrendero':
                                            echo '-B ';
                                            break;

                                        case 'conserje':
                                            echo '-C ';
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                }

                                if (isset($candidato ['plaza3'])){
                                    switch ($candidato ['plaza3']) {
                                        case 'obra publica':
                                            echo '-O ';
                                            break;

                                        case 'barrendero':
                                            echo '-B ';
                                            break;

                                        case 'conserje':
                                            echo '-C ';
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                }

                                 ?>

                            </small></p></td>
                            <td><span class='<?= $codigo_color_dni; ?>'><?= $candidato['dni']; ?></span></td>
                            <td><strong><?= $candidato['nombre']; ?></strong></td>
                            <td><strong><?= $candidato['apellidos']; ?></strong></td>
                           
                            <td>
                                
                                
                                  
                                
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal<?= $m;?>">
                                  <span class="glyphicon glyphicon-info-sign"></span>&nbsp<span class="caret"></span>
                                </button>


                                <!-- Modal -->
                                <div class="modal fade" id="myModal<?= $m;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']."&nbsp&nbsp(".$candidato['edad']." años)"; ?></h4>
                                      </div>
                                      <div class="modal-body">

                                        
                                        <p>Expediente EDIS: <strong><?= $candidato['numedis']; ?></strong></p>
                                        <p>Expediente RGC: <strong><?= $candidato['expediente']; ?></strong></p>
                                        <p>TEDIS: <strong><?= $candidato['tedis']; ?></strong></p>
                                        <p>CEAS de Referencia: <strong><?= $ceas[$candidato['ceas']]; ?></strong></p>
                                        
                                        
                                        <p class="dropdown-header">Contacto</p>

                                        <p>&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-phone-alt">&nbsp&nbsp</span><strong><?= $candidato['telefono']; ?></strong></p>
                                        
                                       
                                        <p class="dropdown-header">Formación Académica:</p>
                                        <p>&nbsp&nbsp&nbsp<strong><big><?= "&nbsp&nbsp".$edu; ?></big></strong></p>-->
                                          
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>






                            </td>
                            

                            <td><?= $this->Form->select('',[$candidato ['motivacion'] => $candidato ['motivacion'],
                                                            'Si' => 'Si',
                                                            'No' => 'No',
                                                            'Se desconoce' => 'Se desconoce',
                                                            'Sin valorar' => 'Sin valorar',],
                                                            ['data-id'=>$candidato ['id'], 
                                                            'class' => 'motivacion']); ?></td>

                            <td><?= $this->Form->select('',[$candidato ['habitos'] => $candidato ['habitos'],
                                                            'Si' => 'Si',
                                                            'No' => 'No',
                                                            'Se desconoce' => 'Se desconoce',
                                                            'Sin valorar' => 'Sin valorar',],
                                                            ['data-id'=>$candidato ['id'], 
                                                            'class' => 'habitos']); ?></td>

                            <td><?= $this->Form->select('',[$candidato ['habilidades'] => $candidato ['habilidades'],
                                                            'Si' => 'Si',
                                                            'No' => 'No',
                                                            'Se desconoce' => 'Se desconoce',
                                                            'Sin valorar' => 'Sin valorar',],
                                                            ['data-id'=>$candidato ['id'], 
                                                            'class'=> 'habilidades']); ?></td>

                            <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id'],
                                                            'value'=>$candidato ['especialidad'],
                                                            'class'=> 'especialidad']); ?></td>

                            <td><?= $this->Form->textarea('',[  'data-id'=>$candidato ['id'], 
                                                                'value'=>$candidato ['dificultades'], 
                                                                'rows'=> "1", 
                                                                'class'=>'crecer_campo1 dificultades']); ?></td>

                            <td><?= $this->Form->textarea('',[  'data-id'=>$candidato ['id'], 
                                                                'value'=>$candidato ['observaciones'], 
                                                                'rows'=> "1", 
                                                                'class'=>'crecer_campo2 observaciones']); ?></td>
                                                              
                        </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        
                    </tbody>
                 </table>
<?php ?>
              </div>
            </div>
          </div>
      


    
<br>

<span>TOTAL: <?php echo $m; ?></span>




      
    <div class="bloque_fin"></div>
   
</div>

<?= $this->Html->script('valoraajax.js') ?>