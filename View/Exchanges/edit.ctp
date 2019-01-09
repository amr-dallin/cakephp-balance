<?php
$title = __('Edit Exchange');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Exchanges'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['exchanges'][0] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <?php
            echo $this->Form->create('Exchange', array(
                'autocomplete' => 'off',
                'inputDefaults' => array(
                    'div' => array('class' => 'form-group'),
                    'legend' => false,
                    'class' => 'form-control',
                    'label' => array('class' => 'sr-only'),
                    'error' => array(
                        'attributes' => array(
                            'class' => 'invalid-feedback'
                        )
                    )
                )
            ));
            ?>
            <div class="card-header"><?php echo $title; ?></div>
            <div class="card-body">
                <?php
                echo $this->Form->input('Exchange.currency_id', array(
                    'type' => 'radio',
                    'class' => 'form-check-input',
                    'before' => '<div class="form-check form-check-inline mr-3">',
                    'separator' => '</div><div class="form-check form-check-inline mr-3">',
                    'after' => '</div>',
                    'label' => array('class' => 'form-check-label'),
                    'options' => Configure::read('Currencies'),
                    'default' => 1
                ));
                
                echo $this->Form->input('Exchange.amount', array(
                    'type' => 'text',
                    'placeholder' => __('Amount')
                )) . '<hr/>';
                
                echo $this->Form->input('Exchange.currency2_id', array(
                    'type' => 'radio',
                    'class' => 'form-check-input',
                    'before' => '<div class="form-check form-check-inline mr-3">',
                    'separator' => '</div><div class="form-check form-check-inline mr-3">',
                    'after' => '</div>',
                    'label' => array('class' => 'form-check-label'),
                    'options' => Configure::read('Currencies'),
                    'default' => 1
                ));
                
                echo $this->Form->input('Exchange.amount2', array(
                    'type' => 'text',
                    'placeholder' => __('Amount')
                ));
                ?>
            </div>
            <div class="card-footer">
                <?php
                echo $this->Form->submit(__('Submit'), array(
                    'class' => 'btn btn-primary'
                ));
                ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>