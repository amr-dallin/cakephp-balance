<?php
$title = __('Exchanges');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs[0]['title'] = $title;
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['exchanges'][1] = true;
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
                            <th style="width: 25%;" class="text-align-right"><?php echo __('Что поменяли'); ?></th>
                            <th style="width: 25%;" class="text-align-right"><?php echo __('На что поменяли'); ?></th>
                            <th data-hide="phone" style="width: 20%;"><?php echo __('Exchange Rate'); ?></th>
                            <th data-hide="phone,tablet"><?php echo __('Created'); ?></th>
                            <th style="background: none; cursor: inherit;"></th>
                            <th style="background: none; cursor: inherit;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($exchanges as $key => $exchange): ?>
                        <tr>
                            <td class="text-align-right">
                                <?php
                                echo $this->Price->currency(
                                    $exchange['Exchange']['amount'],
                                    $exchange['Currency']['symbol']
                                );
                                ?>
                            </td>
                            <td class="text-align-right">
                                <?php
                                echo $this->Price->currency(
                                    $exchange['Exchange']['amount2'],
                                    $exchange['Currency2']['symbol']
                                );
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Price->exchangeRate(
                                    $exchange['Exchange']['amount'],
                                    $exchange['Exchange']['amount2']
                                );
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo $this->Balance->dateFormat('d M Y',
                                    h($exchange['Exchange']['created'])
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
                                        h($exchange['Exchange']['id'])
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
                                        h($exchange['Exchange']['id'])
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