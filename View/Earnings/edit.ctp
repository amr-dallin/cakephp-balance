<?php
$title = __('Edit Earning');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Earnings'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['earnings'][1] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css(array(
    'Balance./vendors/jquery-ui-1.12.1.custom/jquery-ui.min'
));
$this->end();

$this->start('script');
echo $this->Html->script(array(
    'Balance./vendors/jquery-ui-1.12.1.custom/jquery-ui.min'
));
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'dd M yy'
        });
    });
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <?php
            echo $this->Form->create('Earning', array(
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
                echo $this->Form->input('Earning.currency_id', array(
                    'type' => 'radio',
                    'class' => 'form-check-input',
                    'before' => '<div class="form-check form-check-inline mr-3">',
                    'separator' => '</div><div class="form-check form-check-inline mr-3">',
                    'after' => '</div>',
                    'label' => array('class' => 'form-check-label'),
                    'options' => Configure::read('Currencies'),
                    'default' => 1
                ));
                
                echo $this->Form->input('Earning.amount', array(
                    'placeholder' => __('Amount'),
                    'type' => 'text'
                ));
                
                echo $this->Form->input('Earning.date_earning', array(
                    'class' => 'form-control datepicker',
                    'placeholder' => __('Date Earning'),
                    'value' => $this->Balance->dateFormat('d M Y', $this->request->data['Earning']['date_earning']),
                    'type' => 'text'
                ));
                
                echo $this->Form->input('Earning.notes', array(
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