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

<ol class="breadcrumb">
    <?php
    if (
        $this->request->param('controller') == 'pages' && 
        $this->request->param('action') == 'display'
    ) {
        echo $this->Html->tag('li', __('Dashboard'), array(
            'class' => 'breadcrumb-item active'
        ));
    } else {
        echo $this->Html->tag('li',
            $this->Html->link(__('Dashboard'), array(
                'controller' => 'pages', 'action' => 'display'
            )),
            array('class' => 'breadcrumb-item')
        );
    }
 
    if (isset($breadcrumbs) && !empty($breadcrumbs)) {
        foreach($breadcrumbs as $breadcrumb) {
            if (empty($breadcrumb['url'])) {
                echo $this->Html->tag('li', $breadcrumb['title'], array(
                    'class' => 'breadcrumb-item active'
                ));
            } else {
                echo $this->Html->tag('li',
                    $this->Html->link($breadcrumb['title'], $breadcrumb['url']),
                    array('class' => 'breadcrumb-item')
                );
            }
        }
    }
    ?>
</ol>