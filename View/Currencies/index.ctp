<?php
$title = __('Currencies');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs[0]['title'] = $title;
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['settings'][0][2] = true;
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
            responsive: true,
            bSort: false
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
                            <th data-class="expand" style="width: 20%;"><?php echo __('Title'); ?></th>
                            <th style="width: 12%;"><?php echo __('Symbol'); ?></th>
                            <th data-hide="phone" style="width: 12%;"><?php echo __('Code ISO'); ?></th>
                            <th data-hide="phone"><?php echo __('Notes'); ?></th>
                            <th data-hide="phone,tablet" style="width: 12%;"><?php echo __('Created'); ?></th>
                            <th style="background: none; cursor: inherit; width: 5%;"></th>
                            <th style="background: none; cursor: inherit; width: 5%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($currencies as $key => $currency): ?>
                        <tr>
                            <td><?php echo h($currency['Currency']['title']); ?></td>
                            <td><?php echo h($currency['Currency']['symbol']); ?></td>
                            <td><?php echo h($currency['Currency']['codeIso']); ?></td>
                            <td><?php echo h($currency['Currency']['notes']); ?></td>
                            <td>
                                <?php 
                                echo $this->Balance->dateFormat('d M Y',
                                    h($currency['Currency']['created'])
                                );
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-pencil'
                                    )),
                                    array('action' => 'edit', 
                                        h($currency['Currency']['id'])
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
                                        h($currency['Currency']['id'])
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