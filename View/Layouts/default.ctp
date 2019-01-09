<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>

<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.10
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
    <head>
        <base href="./">
        <?php echo $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title><?php echo $this->fetch('title') ?></title>
        <!-- Icons-->
        <?php
        echo $this->Html->css(array(
            'Balance./node_modules/@coreui/icons/css/coreui-icons.min', 
            'Balance./node_modules/flag-icon-css/css/flag-icon.min',
            'Balance./node_modules/font-awesome/css/font-awesome.min',
            'Balance./node_modules/simple-line-icons/css/simple-line-icons'
        ));
        ?>

        <!-- Main styles for this application-->
        <?php
        echo $this->Html->css(array(
            'Balance.style.min', 
            'Balance./vendors/pace-progress/css/pace.min'
        ));
        
        echo $this->fetch('css');
        ?>
    </head>
    <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
        <?php echo $this->element('header'); ?>
        <div class="app-body">
            <?php echo $this->fetch('sidebar'); ?>

            <main class="main">
                <!-- Breadcrumb-->
                <?php echo $this->fetch('breadcrumb'); ?>
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        <?php
                        echo $this->element('balance');
                        echo $this->Flash->render();
                        echo $this->fetch('content');
                        ?>
                    </div>
                </div>
            </main>
            <?php //echo $this->element('aside'); ?>
        </div>

        <?php echo $this->element('footer'); ?>

        <?php
        echo $this->Html->script(array(
            'Balance./node_modules/jquery/dist/jquery.min',
            'Balance./node_modules/popper.js/dist/umd/popper.min',
            'Balance./node_modules/bootstrap/dist/js/bootstrap.min',
            'Balance./node_modules/pace-progress/pace.min',
            'Balance./node_modules/perfect-scrollbar/dist/perfect-scrollbar.min',
            'Balance./node_modules/@coreui/coreui/dist/js/coreui.min'
        ));
        echo $this->fetch('script');
        echo $this->fetch('script-code');
        ?>
    </body>
</html>