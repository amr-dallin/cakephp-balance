<?php
$title = __('Discrepancies');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs[0]['title'] = $title;
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['discrepancies'][1] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css('Balance./vendors/DataTables/datatables.min');
$this->end();

$this->start('script');
echo $this->Html->script('Balance./vendors/DataTables/datatables.min');
$this->end();
?>

<?php $this->start('script-code'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_basic').DataTable({
            responsive: true
        });
    });
</script>
<?php $this->end(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> <?php echo $title; ?></div>
            <div class="card-body">
                <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                        <tr>
                            <th data-class="expand" style="width: 25%;"><?php echo __('Currency'); ?></th>
                            <th data-hide="phone" class="text-right" style="width: 25%;"><?php echo __('Amount'); ?></th>
                            <th data-hide="phone" class="text-right" style="width: 25%;"><?php echo __('Balance'); ?></th>
                            <th class="text-right"><?php echo __('Difference'); ?></th>
                            <th data-hide="phone"><?php echo __('Created'); ?></th>
                            <th style="background: none; cursor: inherit;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($discrepancies as $key => $discrepancy): ?>
                        <tr>
                            <td>
                                <?php
                                echo h($discrepancy['Currency']['title']);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                echo $this->Price->currency(
                                    h($discrepancy['Discrepancy']['amount']), 
                                    h($discrepancy['Currency']['symbol'])
                                );
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                echo $this->Price->currency(
                                    h($discrepancy['Discrepancy']['balance']), 
                                    h($discrepancy['Currency']['symbol'])
                                );
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                echo $this->Price->difference(
                                    h($discrepancy['Discrepancy']['amount']),
                                    h($discrepancy['Discrepancy']['balance']),
                                    h($discrepancy['Currency']['symbol'])
                                );
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Balance->dateFormat('d M Y', 
                                    h($discrepancy['Discrepancy']['created'])
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
                                        h($discrepancy['Discrepancy']['id'])
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