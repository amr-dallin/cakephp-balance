<?php
$title = __('Edit «%s»', $this->request->data['Currency']['title']);

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Currencies'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['settings'][0][2] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <?php
            echo $this->Form->create('Currency', array(
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
                echo $this->Form->input('Currency.title', array(
                    'placeholder' => __('Title')
                ));
                
                echo $this->Form->input('Currency.symbol', array(
                    'placeholder' => __('Symbol')
                ));
                
                echo $this->Form->input('Currency.codeIso', array(
                    'placeholder' => __('Code ISO')
                ));
                
                echo $this->Form->input('Currency.notes', array(
                    'placeholder' => __('Notes')
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