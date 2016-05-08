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

<?php $url = $this->Url->build(['action'=>'valoracion']);?>


<script type="text/javascript">
    
    $(document).ready(function() {

        $('select[name=tedis]').change(function() {

                    var contenido1 = $('select[name=tedis]').val(); // val obtiene el valor del elemento seleccionado....
                    var contenido2 = $('select[name=ceas]').val();
                    var url = '<?= $url; ?>'
                   
                    filtro(url,contenido1,contenido2);
                });

        $('select[name=ceas]').change(function() {

                    var contenido1 = $('select[name=tedis]').val(); // val obtiene el valor del elemento seleccionado....
                    var contenido2 = $('select[name=ceas]').val();
                    var url = '<?= $url; ?>'
                    
                    filtro(url,contenido1,contenido2);
                });

    });

</script>

<div class="content">
        <p>Número total de candidatos estructurales: <strong> <?= $cuenta_estructurales; ?></strong>; 
            Número total de candidatos estructurales: <strong> <?= $cuenta_estructurales; ?></strong>; </p>

        <div class="row"> 
            <div class="col-md-12">
            
                <div class="col-md-3">
                    <?= $this->Html->link(__('Ver todos sin filtros...'), ['action' => 'valoracion'], ['class'=>'btn btn-primary btn-lg margen_boton']); ?>
                </div>
                    <?php
                    $tedis_opciones = [ $tedis_default => $tedis_default,
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

                <div class="col-md-4">
                    <span><small>Filtrar por TEDIS</small></span>
                    <?= $this->Form->select('tedis', $tedis_opciones);?>
                </div>
                <div class="col-md-5">
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
                  <span class="glyphicon glyphicon-list"></span>  Candidatos Estructurales - <?=  $tedis_default.' '; ?> (<?= $num_extruc_conocidos; ?>)
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
                            
                        <?php foreach ($candidatos_conocidos as $candidato): ?>

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

                             ?>

                        <tr>
                            <td><span class="glyphicon glyphicon-tag asterisco"></span></td>
                            <td><?= $candidato['dni']; ?></td>
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

                                        
                                        <p class="dropdown-header">Perfil de empleabilidad:</p>
                                        <ul>
                                                <li><?=$perfiles[$candidato['dni']]['e1']; ?></li>

                                            <?php if ($perfiles[$candidato['dni']]['e2']): ?>
                                                 <li><?=$perfiles[$candidato['dni']]['e2']; ?></li>
                                             <?php endif ?> 
                                            
                                            <?php if ($perfiles[$candidato['dni']]['e3']): ?>
                                                <li><?=$perfiles[$candidato['dni']]['e3']; ?></li>
                                            <?php endif ?>
                                            
                                            <?php if ($perfiles[$candidato['dni']]['e4']): ?>
                                                <li><?=$perfiles[$candidato['dni']]['e4']; ?></li>                             
                                            <?php endif ?>                             
                                           
                                            <?php if ($perfiles[$candidato['dni']]['e5']): ?>
                                                <li><?=$perfiles[$candidato['dni']]['e5']; ?></li>
                                            <?php endif ?>
                                                
                                            <?php if ($perfiles[$candidato['dni']]['e6']): ?>
                                                <li><?=$perfiles[$candidato['dni']]['e6']; ?></li>
                                            <?php endif ?>

                                        </ul>
                                          
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>





                                <!-- 

                                <div class="dropdown">

                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu<?= $m;?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="glyphicon glyphicon-info-sign"></span>&nbsp<span class="caret"></span>
                                  </button>

                                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu<?= $m;?>">
                                    <li class="dropdown-header">
                                        <?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']."&nbsp&nbsp(".$candidato['edad']." años)"; ?>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>Expediente EDIS: <strong><?= $candidato['numedis']; ?></strong></li>
                                    <li>Expediente RGC: <strong><?= $candidato['expediente']; ?></strong></li>
                                    <li>TEDIS: <strong><?= $candidato['tedis']; ?></strong></li>
                                    <li>CEAS de Referencia: <strong><?= $ceas[$candidato['ceas']]; ?></strong></li>
                                    
                                    <li role="separator" class="divider"></li>  
                                    <li class="dropdown-header">Contacto</li>                              
                                    <li>&nbsp&nbsp&nbsp<span class="glyphicon glyphicon-phone-alt">&nbsp&nbsp</span><strong><?= $candidato['telefono']; ?></strong></li>
                                    
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Formación</li>
                                    <li>Formación Académica:&nbsp&nbsp&nbsp<strong><big><?= "&nbsp&nbsp".$edu; ?></big></strong></li>

                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Perfil de empleabilidad:</li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e1']; ?></li>
                                    <?php if ($perfiles[$candidato['dni']]['e2']): ?>
                                         <li><?=$perfiles[$candidato['dni']]['e2']; ?></li>
                                     <?php endif ?> 
                                    
                                    <?php if ($perfiles[$candidato['dni']]['e3']): ?>
                                        <li><?=$perfiles[$candidato['dni']]['e3']; ?></li>
                                    <?php endif ?>
                                    
                                    <?php if ($perfiles[$candidato['dni']]['e4']): ?>
                                        <li><?=$perfiles[$candidato['dni']]['e4']; ?></li>                             
                                    <?php endif ?>                             
                                   
                                    <?php if ($perfiles[$candidato['dni']]['e5']): ?>
                                        <li><?=$perfiles[$candidato['dni']]['e5']; ?></li>
                                    <?php endif ?>
                                        
                                    <?php if ($perfiles[$candidato['dni']]['e6']): ?>
                                        <li><?=$perfiles[$candidato['dni']]['e6']; ?></li>
                                    <?php endif ?>
                                    
                                  </ul>
                                
                                </div>
                                -->

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

                        <?php endforeach; ?>

                    </tbody>
                 </table>

              </div>
            </div>
          </div>
      

    
<br>

<?php if ($tedis_default==null): ?>
    

        <!--<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"> -->
          <div class="panel-warning">
            <div class="panel-heading" role="tab" id="headingOne">
              <h3 class="">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapseOne">
                  <span class="glyphicon glyphicon-list"></span>  Candidatos Estructurales Desconocidos (<?= $cuenta_estructurales-$num_extruc_conocidos; ?>)
                </a>
              </h3>
            </div>
            <div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <table cellpadding="0" cellspacing="0" class="table table-hover">
                    <thead>
                        <tr>
                            <td>dni</td>
                            <td>nombre</td>
                            <td>apellidos</td>
                            <td>expediente</td>
                            <td>estudios</td>
                            <td>teléfono</td>
                            <td>CEAS</td>
                            <td>edad</td>
                            <td></td>
                            <td>perfil</td>
                            
                            
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($candidatos_desconocidos as $candidato): ?>

                            <?php 

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

                             ?>
                        <tr>
                            <td><?= $candidato['dni']; ?></td>
                            <td><strong><?= $candidato['nombre']; ?></strong></td>
                            <td><strong><?= $candidato['apellidos']; ?></strong></td>
                            <td><?= $candidato['expediente']; ?></td>
                            <td><?= $edu; ?></td>
                            <td><?= $candidato['telefono']; ?></td>
                            <td><?= $ceas[$candidato['ceas']]; ?></td>
                            <td class="<?=$etiqueta?>"><?= $candidato['edad']; ?></td>
                            
                            <td>
                                
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu<?= $m;?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span>Más datos </span><span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu<?= $m;?>">
                                    <li class="dropdown-header">
                                        <?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']; ?>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e1']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e2']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e3']; ?></li>
                                    <li role="separator" class="divider"></li>                                
                                    <li><?=$perfiles[$candidato['dni']]['e4']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e5']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e6']; ?></li>
                                  </ul>
                                </div>

                            </td>

                            <td>
                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu<?= $m;?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu<?= $m;?>">
                                    <li class="dropdown-header">
                                        <?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']; ?>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e1']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e2']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e3']; ?></li>
                                    <li role="separator" class="divider"></li>                                
                                    <li><?=$perfiles[$candidato['dni']]['e4']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e5']; ?></li>
                                    <li role="separator" class="divider"></li>
                                    <li><?=$perfiles[$candidato['dni']]['e6']; ?></li>
                                  </ul>
                                </div>
                            </td>
                            
                        </tr>

                        <?php endforeach; ?>

                    </tbody>
                 </table>
              </div>
            </div>
          </div>
      <!--  </div> -->
<?php endif ?>
      
    <div class="bloque_fin"></div>
   
</div>

<?= $this->Html->script('valoraajax.js') ?>