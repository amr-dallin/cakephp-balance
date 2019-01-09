<?php
$title = __('Earnings');

$this->assign('title', $title);

$this->start('breadcrumb');
$breadcrumbs[0]['title'] = $title;
echo $this->element('breadcrumb', array('breadcrumbs' => $breadcrumbs));
$this->end();

$this->start('sidebar');
$menu['earnings'][1] = true;
echo $this->element('sidebar', array('menu' => $menu));
$this->end();

$this->start('css');
echo $this->Html->css('Balance./vendors/DataTables/datatables.min');
$this->end();

$this->start('script');
echo $this->Html->script(array(
    'Balance./vendors/DataTables/datatables.min',
    'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js'
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


        <?php foreach($statistics as $statistic): ?>
        var verbs<?php echo $statistic['Currency']['id']; ?> = new Chart($('#revenueStatistics<?php echo $statistic['Currency']['id']; ?>'), {
            type: 'bar',
            data: {
                labels: <?php echo $statistic['Graph']['labels']; ?>,
                datasets: <?php echo $statistic['Graph']['datasets']; ?>
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
        <?php endforeach; ?>

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
                            <th class="text-align-right"><?php echo __('Amount'); ?></th>
                            <th data-class="expand"><?php echo __('Date earning'); ?></th>
                            <th data-hide="phone"><?php echo __('Notes'); ?></th>
                            <th style="background: none; cursor: inherit;"></th>
                            <th style="background: none; cursor: inherit;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($earnings as $key => $earning): ?>
                        <tr>
                            <td class="text-align-right">
                                <?php
                                echo $this->Price->currency(
                                    h($earning['Earning']['amount']), 
                                    h($earning['Currency']['symbol'])
                                );
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $this->Balance->dateFormat('d M Y', 
                                    h($earning['Earning']['date_earning'])
                                );
                                ?>
                            </td>
                            <td>
                                <?php echo h($earning['Earning']['notes']); ?>
                            </td>
                            <td class="text-center">
                                <?php
                                echo $this->Html->link(
                                    $this->Html->tag('i', '', array(
                                        'class' => 'fa fa-lg fa-pencil'
                                    )),
                                    array('action' => 'edit', 
                                        h($earning['Earning']['id'])
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
                                        h($earning['Earning']['id'])
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