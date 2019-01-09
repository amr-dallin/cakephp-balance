<?php
$title = __('Expenses');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs[0]['title'] = $title;
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['expenses'][1] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css('Balance./vendors/DataTables/datatables.min');
$this->end();

$this->start('script');
echo $this->Html->script(array(
    'Balance./vendors/DataTables/datatables.min'
));
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_basic').DataTable({
            responsive: true,
            bSort: false
        });
    });
</script>
<?php $this->end(); ?>

<?php echo $this->element('statistics', array('statistics' => $statistics)); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> <?php echo $title; ?></div>
            <div class="card-body">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th data-hide="phone" style="width: 20%;"><?php echo __('Category'); ?></th>
                            <th style="width: 20%;" data-class="expand" class="text-align-right"><?php echo __('Amount'); ?></th>
                            <th data-hide="phone" style="width: 12%;"><?php echo __('Date Expense'); ?></th>
                            <th data-hide="phone,tablet"><?php echo __('Notes'); ?></th>
                            <th style="background: none; cursor: inherit;"></th>
                            <th style="background: none; cursor: inherit;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($expenses as $key => $expense): ?>
                        <tr>
                            <td>
                                <?php
                                echo $this->Html->link(
                                    h($expense['Category']['title']),
                                    array(
                                        'controller' => 'categories',
                                        'action' => 'view',
                                        h($expense['Category']['id'])
                                    )
                                );
                                ?>
                            </td>
                            <td class="text-align-right">
                                <?php
                                echo $this->Price->currency(
                                    $expense['Expense']['amount'],
                                    $expense['Currency']['symbol']
                                );
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo $this->Balance->dateFormat('d M Y',
                                    h($expense['Expense']['date_expense'])
                                );
                                ?>
                            </td>
                            <td>
                                <?php echo h($expense['Expense']['notes']); ?>
                            </td>
                            <td class="text-center">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-pencil'
                                    )),
                                    array('action' => 'edit', 
                                        h($expense['Expense']['id'])
                                    ),
                                    array('escape' => false)
                                );
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                echo $this->Form->postLink(
                                    $this->Html->tag('i', '', array(
                                       'class' => 'fa fa-lg fa-trash-o'
                                    )),
                                    array('action' => 'delete', 
                                        h($expense['Expense']['id'])
                                    ),
                                    array('escape' => false,
                                        'confirm' => __('Are you sure you want to delete?'), 
                                    )
                                );
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>