<?php
$title = __('Add Discrepancy');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Discrepancies'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['discrepancies'][0] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <?php
            echo $this->Form->create('Discrepancy', array(
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
                echo $this->Form->input('Discrepancy.currency_id', array(
                    'type' => 'radio',
                    'class' => 'form-check-input',
                    'before' => '<div class="form-check form-check-inline mr-3">',
                    'separator' => '</div><div class="form-check form-check-inline mr-3">',
                    'after' => '</div>',
                    'label' => array('class' => 'form-check-label'),
                    'options' => Configure::read('Currencies'),
                    'default' => 1
                ));
                
                echo $this->Form->input('Discrepancy.amount', array(
                    'placeholder' => __('Amount'),
                    'type' => 'text'
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