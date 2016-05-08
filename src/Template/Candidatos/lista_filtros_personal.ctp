<?php $url = $this->Url->build(['action'=>'lista_filtros_personal']);?>


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
        
            <table class="table">

                <thead>
                    <tr>
                        <td>id</td>
                        <td>DNI</td>
                        <td>CANDIDATO</td>
                        <td>Conserjes</td>
                        <td>Barrenderos</td>
                        <td>Obra Pública</td>
                        <td>Nómina Marzo'16</td>
                        <td>PRE/91/2016</td>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php foreach ($listado as $candidato): ?> 
                        <?php $m++; ?>
                        <tr class="resaltada">
                            <td><?= $id++; ?></td>
                            <td><?= $candidato['dni']; ?></td>
                            <td><?= $candidato['nombre_completo']; ?></td>
                            <td>
                                <?php if($candidato['plaza']==='conserje'||$candidato['plaza2']==='conserje'||$candidato['plaza3']==='conserje'): ?> 
                                    <?= $this->Html->image('conserje.svg',['height'=>'15px','width'=>'15px']);?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($candidato['plaza']==='barrendero'||$candidato['plaza2']==='barrendero'||$candidato['plaza3']==='barrendero'): ?> 
                                    <?= $this->Html->image('barrendero.svg',['height'=>'15px','width'=>'15px']);?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($candidato['plaza']==='obra publica'||$candidato['plaza2']==='obra publica'||$candidato['plaza3']==='obra publica'): ?> 
                                    <?= $this->Html->image('obras.svg',['height'=>'15px','width'=>'15px']);?>
                                <?php endif; ?>
                            </td>
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

<?= $this->Html->script('valoraajax.js') ?>