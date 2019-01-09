<?php
$count = $this->Balance->countFieldset();

$title = __('Add %s Expense(s)', $count);

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Expenses'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['expenses'][0] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css(array(
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css',
    'Balance./vendors/jquery-ui-1.12.1.custom/jquery-ui.min'
));
$this->end();

$this->start('script');
echo $this->Html->script(array(
    'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js',
    'Balance./vendors/jquery-ui-1.12.1.custom/jquery-ui.min'
));
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $('.datepicker').datepicker({
            dateFormat: 'dd M yy'
        });
    });
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <?php
            echo $this->Form->create('Expense', array(
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
                <?php for($i = 0; $i < $count; $i++): ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                        echo $this->Form->input($i . '.Expense.currency_id', array(
                            'type' => 'radio',
                            'class' => 'form-check-input',
                            'before' => '<div class="form-check form-check-inline mr-3">',
                            'separator' => '</div><div class="form-check form-check-inline mr-3">',
                            'after' => '</div>',
                            'label' => array('class' => 'form-check-label'),
                            'options' => Configure::read('Currencies'),
                            'default' => 1
                        ));
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        echo $this->Form->input($i . '.Expense.excess', array(
                            'type' => 'checkbox',
                            'class' => 'form-check-input',
                            'before' => '<div class="form-check form-check-inline mr-1">',
                            'separator' => '</div><div class="form-check form-check-inline mr-1">',
                            'after' => '</div>',
                            'label' => array('class' => 'form-check-label'),
                        ));
                        ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-3">
                        <?php
                        echo $this->Form->input($i . '.Expense.category_id', array(
                            'type' => 'select',
                            'class' => 'form-control select2',
                            'style' => 'width: 100%',
                            'empty' => __('Select category'),
                        ));
                        ?>
                    </div>
                    <div class="col-12 col-md-3">
                        <?php
                        echo $this->Form->input($i . '.Expense.count', array(
                            'type' => 'text',
                            'placeholder' => __('Count')
                        ));
                        ?>
                    </div>
                    <div class="col-12 col-md-3">
                        <?php
                        echo $this->Form->input($i . '.Expense.price', array(
                            'type' => 'text',
                            'placeholder' => __('Price')
                        ));
                        ?>
                    </div>

                    <div class="col-12 col-md-3">
                        <?php
                        echo $this->Form->input($i . '.Expense.amount', array(
                            'type' => 'text',
                            'placeholder' => __('Amount')
                        ));
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-3">
                        <?php
                        echo $this->Form->input($i . '.Expense.date_expense', array(
                            'class' => 'form-control datepicker',
                            'type' => 'text',
                            'placeholder' => __('Date expense'),
                        ));
                        ?>
                    </div>

                    <div class="col-12 col-md-9">
                        <?php
                        echo $this->Form->input($i . '.Expense.notes', array(
                            'placeholder' => __('Notes'),
                            'rows' => 2
                        ));
                        ?>
                    </div>
                </div>
                <hr/><br/>
                <?php endfor; ?>
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