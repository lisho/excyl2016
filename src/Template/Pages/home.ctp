<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('mis_estilos.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <!-- <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <?= $this->Html->script('mi_js.js') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="home">
    <header>
        <div class="header-image">
            
            <h1>Plan de Empleo 2016 (RGC)</h1>
            <h1>Herramienta de Gestión de Candidatos</h1>
            <h2>Equipo de Inclusión Social (E.D.I.S.)</h2>
            <?= $this->Html->image('escudo.svg',["class"=>"escudo"]) ?>

            <h3>Ayuntamiento de León</h3>
            <p>(Versión BETA 0.1)</p>
            <a href="#content" class="efecto1">
                <?= $this->Html->image('arrow.svg.png',["width"=> "100px"]) ?>
            </a>
            
        </div>
    </header>

    <div id="content">
        <div class=" col-xl-12">
           <div class="row">
                    <div class="col-lg-4 col-xs-12 text-center padding wow fadeIn animated">
                        <a href="candidatos/valoracion" class="efecto1">
                            <div class="btn btn-primary boton_home">
                                <span class="glyphicon glyphicon-ok icono_grande"></span>
                                <p><strong>Herramienta de valoración de empleabilidad.</strong></p>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-xs-12 text-center padding wow fadeIn animated">
                        
                        <div class="btn btn-primary boton_home" id="listados">
                            <span class="glyphicon glyphicon-list icono_grande" ></span>
                            <p><strong> Listados de Candidatos. </strong></p>

                            <div class="col-lg-12 botonera_pequeña" id="botonera_pequeña">
                               
                                <a href="candidatos/view-con-tedis" class="">
                                    <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>TODOS</p></div>
                                </a>

                                <a href="candidatos/view-filtro" class="">
                                  <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>FILTROS</p></div>
                                </a>
                                
                                
                               
                            </div>
                        </div>
                         
                    </div>
                    <div class="col-lg-4 col-xs-12 text-center padding wow fadeIn animated">
                         
                            <div class="btn btn-primary boton_home" id="excyl16">
                                <span class="glyphicon glyphicon-ok icono_grande"></span>
                                <p><strong>EXCYL2016.</strong></p>
                                    <div class="col-lg-12 botonera_pequeña" id="botonera_pequeña2">

                                        <a href="candidatos/valoracion2016" class="">
                                            <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>VALORAR</p></div>
                                        </a>

                                        <a href="candidatos/lista-filtros-full" class="">
                                          <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>INFO EDIS</p></div>
                                        </a>

                                        <a href="candidatos/lista-filtros-personal" class="">
                                          <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>INFO RRHH</p></div>
                                        </a> 

                                        <a href="candidatos/resultados_tribunales" class="">
                                          <div class="col-xs-6 btn btn-primary"><span class="glyphicon glyphicon-filter"></span><p>TRIBUNALES</p></div>
                                        </a>                                                
                                       
                                    </div>



                            </div>
                        
                        
                    </div>
                    
            </div>
           
        </div>
    </div>


<script type="text/javascript">
      $(document).ready(function() {
        $('.icono_grande').hide('2');

        $('#listados').click(function() {
            $('#botonera_pequeña').show('slow');   
            });
        $('#excyl16').click(function() {
            $('#botonera_pequeña2').show('slow');   
            });
    });
  
</script>

</body>
</html>
