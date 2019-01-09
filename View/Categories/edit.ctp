<?php
$title = __('Edit «%s»', $this->request->data['Category']['title']);

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs = array(
    array('title' => __('Categories'), 'url' => array('action' => 'index')),
    array('title' => $title)
);
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['settings'][1][2] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('script');
echo $this->Html->script(array(
    'plugin/jquery-form/jquery-form.min',
    'plugin/select2/select2.min'
));
$this->end();
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <?php
            echo $this->Form->create('Category', array(
                'autocomplete' => 'off',
                'inputDefaults' => array(
                    'div' => array('class' => 'form-group'),
                    'legend' => false,
                    'class' => 'form-control',
                    'label' => array('class' => 'sr-only'),
                    'error' => array(
                        'attributes' => array(
                            'class' => 'note note-error'
                        )
                    )
                )
            ));
            ?>
            <div class="card-header">
                <?php echo __('Edit Form'); ?>
            </div>
            <div class="card-body">
                <?php
                echo $this->Form->input('Category.parent_id', array(
                    'class' => 'form-control select2',
                    'style' => 'width: 100%',
                    'empty' => __('Select parent')
                ));
                
                echo $this->Form->input('Category.title', array(
                    'placeholder' => __('Title')
                ));
                
                echo $this->Form->input('Category.notes', array(
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