<?php $url = $this->Url->build(['action'=>'resultados_tribunales']);?>
 <?= $this->element('progressbar'); ?>

<script type="text/javascript">
    
    $(document).ready(function() {

        $('select[name=plaza]').change(function() {

                var contenido1 = $('select[name=plaza]').val();
                var url = '<?= $url; ?>'
               
                filtro(url,contenido1);
            });
        $('.actualiza').click(function(event) {
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

        $id=1;
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

                        <?php   if($plaza_default === 'barrendero') {echo $this->Html->image('barrendero.svg',['height'=>'30px','width'=>'30px','class' => '']).' (43)';;}
                                elseif ($plaza_default  === 'conserje'){echo $this->Html->image('conserje.svg',['height'=>'30px','width'=>'30px']).' (29)';} 
                                elseif ($plaza_default  === 'obra publica'){echo $this->Html->image('obras.svg',['height'=>'30px','width'=>'30px']).' (34)';;}
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
        
            <table class="table">

                <thead>
                    <tr>
                        <td>id</td>
                        <td>DNI</td>
                        <td>CANDIDATO</td>
                        <td>Conserjes</td>
                        <td>Barrenderos</td>
                        <td>Obra Pública</td>
                        <td>Observaciones del tribunal</td>
                        <td>N. Mz'16</td>
                        <td>PRE/91/2016</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                        $t_c='';
                        $t_b='';
                        $t_o='';

                     ?>
                    <?php foreach ($listado as $candidato): ?> 
                        <?php $m++; ?>

                        <?php 
                            if (in_array($candidato['dni'], array_keys($titulares_conserjes))) {
                                $t_c = 'titular';
                            } else {$t_c = '';}

                            if (in_array($candidato['dni'], array_keys($titulares_barrenderos))){
                                $t_b = 'titular';
                            } else {$t_b = '';}

                            if (in_array($candidato['dni'], array_keys($titulares_obras))){
                                $t_o = 'titular';
                            } else {$t_o = '';}

                        ?>

                        <?php 
                            
                            $r_c = '';
                            $r_b = '';
                            $r_o = '';
                         ?>
                         
                            <?php if($candidato['plaza']==='conserje' && $candidato['plaza_renuncia']===1) {$r_c = 'renuncia';} ?>
                            <?php if($candidato['plaza2']==='conserje' && $candidato['plaza2_renuncia']===1) {$r_c = 'renuncia';} ?>
                            <?php if($candidato['plaza3']==='conserje' && $candidato['plaza3_renuncia']===1) {$r_c = 'renuncia';} ?>

                            <?php if($candidato['plaza']==='barrendero' && $candidato['plaza_renuncia']===1) {$r_b = 'renuncia';} ?>
                            <?php if($candidato['plaza2']==='barrendero' && $candidato['plaza2_renuncia']===1) {$r_b = 'renuncia';} ?>
                            <?php if($candidato['plaza3']==='barrendero' && $candidato['plaza3_renuncia']===1) {$r_b = 'renuncia';} ?>

                            <?php if($candidato['plaza']==='obra publica' && $candidato['plaza_renuncia']===1) {$r_o = 'renuncia';} ?>
                            <?php if($candidato['plaza2']==='obra publica' && $candidato['plaza2_renuncia']===1) {$r_o = 'renuncia';} ?>
                            <?php if($candidato['plaza3']==='obra publica' && $candidato['plaza3_renuncia']===1) {$r_o = 'renuncia';} ?>
                            
                       


                        <tr id="<?= $candidato['dni']; ?>" class="resaltada">
                            <td><?= $id++; ?></td>
                            <td><?= $candidato['dni']; ?></td>
                            <td><?= $candidato['nombre_completo']; ?></td>
                            <td id="conserje<?= $candidato['dni']; ?>" class="<?= $t_c.' '.$r_c; ?>" data-id="<?= $candidato['id']; ?>">
                                <?php if($candidato['plaza']==='conserje'||$candidato['plaza2']==='conserje'||$candidato['plaza3']==='conserje'): ?> 
                                    <?= $this->Html->image('conserje.svg',['height'=>'15px','width'=>'15px']);?>
                                    
                                    <?php if($candidato['plaza']==='conserje') {echo $candidato['plaza_nota'];} ?>
                                    <?php if($candidato['plaza2']==='conserje') {echo $candidato['plaza2_nota'];} ?>
                                    <?php if($candidato['plaza3']==='conserje') {echo $candidato['plaza3_nota'];} ?>
                                
                                <?php endif; ?>
                            </td>
                            <td id="barrendero<?= $candidato['dni']; ?>" class="<?= $t_b.' '.$r_b; ?>" data-id="<?= $candidato['id']; ?>">
                                <?php if($candidato['plaza']==='barrendero'||$candidato['plaza2']==='barrendero'||$candidato['plaza3']==='barrendero'): ?> 
                                    <?= $this->Html->image('barrendero.svg',['height'=>'15px','width'=>'15px']);?>

                                    <?php if($candidato['plaza']==='barrendero') {echo $candidato['plaza_nota'];} ?>
                                    <?php if($candidato['plaza2']==='barrendero') {echo $candidato['plaza2_nota'];} ?>
                                    <?php if($candidato['plaza3']==='barrendero') {echo $candidato['plaza3_nota'];} ?>
                                
                                <?php endif; ?>
                            </td>
                            <td id="obra<?= $candidato['dni']; ?>" class="<?= $t_o.' '.$r_o; ?>" data-id="<?= $candidato['id']; ?>">
                                <?php if($candidato['plaza']==='obra publica'||$candidato['plaza2']==='obra publica'||$candidato['plaza3']==='obra publica'): ?> 
                                    <?= $this->Html->image('obras.svg',['height'=>'15px','width'=>'15px']);?>

                                    <?php if($candidato['plaza']==='obra publica') {echo $candidato['plaza_nota'];} ?>
                                    <?php if($candidato['plaza2']==='obra publica') {echo $candidato['plaza2_nota'];} ?>
                                    <?php if($candidato['plaza3']==='obra publica') {echo $candidato['plaza3_nota'];} ?>
                                
                                <?php endif; ?>
                            </td>
                            <td><?= $candidato['apuntes']; ?></td>
                            <td>
                                <?php 
                                    if(in_array($candidato['dni'], $nomina)){  
                                            echo '<span class="glyphicon glyphicon-ok-sign correcto"></span>';
                                    } else {
                                            echo '<span class="glyphicon glyphicon-remove-sign incorrecto"></span>'; 
                                        }
                                ?>
                            </td>

                            <td>
                                <?php 
                                    if(in_array($candidato['dni'], $pre_dni)){ echo $pre[$candidato['dni']];} 
                                ?>
                            </td>
                            <td>
                                <div type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal<?= $candidato['dni'];?>">
                                  <span class="glyphicon glyphicon-edit"></span>
                                </div>
                                
                                <!-- Modal -->
                                
                                <div class="modal fade" id="myModal<?= $candidato['dni'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><?= '<span class="glyphicon glyphicon-user"></span>'.'    '.$candidato['nombre'].' '.$candidato['apellidos']."&nbsp&nbsp(".$candidato['edad']." años)"; ?></h4>
                                      </div>
                                      <div class="modal-body">
                                        

                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Plaza</th>
                                                    <th>Nota</th>
                                                    <th>Corrector</th>
                                                    <th>Renuncia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?= $candidato['plaza'];?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza'],
                                                            'value'=>$candidato ['plaza_nota'],
                                                            'class'=> 'nota1',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza'],
                                                            'value'=>$candidato ['plaza_corrector'],
                                                            'class'=> 'corrector1',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td class="text-center">
                                                            <?php 
                                                                $checked = '';
                                                                if($candidato['plaza_renuncia']===1){$checked='checked';}
                                                                if($candidato ['plaza']==='obra publica'){$candidato ['plaza']='obra';} 
                                                            ?>
                                                            <?= $this->Form->input('',['data-id'=>$candidato ['id_plaza'],
                                                            'type' => 'checkbox',
                                                            'value'=>$candidato ['plaza_renuncia'],
                                                            'checked' => $checked,
                                                            'class' => 'check1',
                                                            'id-check' => $candidato ['plaza'].$candidato['dni']
                                                            ]);?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?= $candidato['plaza2'];?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza2'],
                                                            'value'=>$candidato ['plaza2_nota'],
                                                            'class'=> 'nota2',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza2'],
                                                            'value'=>$candidato ['plaza2_corrector'],
                                                            'class'=> 'corrector2',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td class="text-center">
                                                            <?php 
                                                                $checked = '';
                                                                if($candidato['plaza2_renuncia']===1){$checked='checked';} 
                                                                if($candidato ['plaza2']==='obra publica'){$candidato ['plaza2']='obra';} 
                                                            ?>
                                                            <?= $this->Form->input('',['data-id'=>$candidato ['id_plaza2'],
                                                            'type' => 'checkbox',
                                                            'value'=>$candidato ['plaza2_renuncia'],
                                                            'checked' => $checked,
                                                            'class' => 'check2',
                                                            'id-check' => $candidato ['plaza2'].$candidato['dni']
                                                            ]);?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><?= $candidato['plaza3'];?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza3'],
                                                            'value'=>$candidato ['plaza3_nota'],
                                                            'class'=> 'nota3',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td><?= $this->Form->input('',[ 'data-id'=>$candidato ['id_plaza3'],
                                                            'value'=>$candidato ['plaza3_corrector'],
                                                            'class'=> 'corrector3',
                                                            'type' => 'number',
                                                            'step' => '0.01']); ?></td>
                                                    <td class="text-center">
                                                            <?php 
                                                                $checked = '';
                                                                if($candidato['plaza3_renuncia']===1){$checked='checked';} 
                                                                if($candidato ['plaza3']==='obra publica'){$candidato ['plaza3']='obra';} 
                                                            ?>
                                                            <?= $this->Form->input('',['data-id'=>$candidato ['id_plaza3'],
                                                            'type' => 'checkbox',
                                                            'value'=>$candidato ['plaza3_renuncia'],
                                                            'checked' => $checked,
                                                            'class' => 'check3',
                                                            'id-check' => $candidato ['plaza3'].$candidato['dni']
                                                            ]);?>

                                                    </td>
                                                </tr>

                                            </tbody>                                           

                                        </table>  
                                            <button type="button" class="btn btn-success actualiza" data-dismiss="modal"> Actualizar datos y salir </button>                                     
                                        
                                      </div>
                                    </div>
                                  </div>
                                </div><!-- End Modal-->

                            </td>

<?php //debug($candidato['dni']);debug($nomina);exit(); ?>
                        </tr>                        

                    <?php endforeach ?>

                </tbody>
                


            </table>

        </div>



</div> <!-- END DIV-CONTENT -->
            <div class="cuenta_candidatos">
                <span><?php echo $m; ?></span>
            </div>      
<div class="bloque_fin"></div>

<?= $this->Html->script('calificaajax.js') ?>