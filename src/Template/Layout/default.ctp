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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?= $this->Html->css('base.css') ?>
    <!--<?= $this->Html->css('cake.css') ?> -->
    <?= $this->Html->css('mis_estilos.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <!--<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar navbar-fixed-top top-bar " data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href="/rgc_cake/"><span class="glyphicon glyphicon-home"></span>  Plan Empleo RGC - 2016</a></h1>
            </li>
        </ul>
        <div class="top-bar-section ">
            
            <ul class="right">
                
                <li><a target="_blank" href=""></a></li>
                <li><a target="_blank" href=""></a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
   
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        

    </footer>

    <?= $this->Html->script('mi_js.js') ?>
    <?= $this->fetch('script') ?>

</body>
</html>
